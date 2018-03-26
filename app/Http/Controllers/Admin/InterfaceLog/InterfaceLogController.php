<?php

namespace App\Http\Controllers\Admin\InterfaceLog;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Admin\Router\ConfigMaster;#配置表
use App\Http\Models\Admin\Router\InterfaceLog;#配置表


class InterfaceLogController extends \App\Http\Controllers\Admin\BasicController
{
    public function __construct(){
        parent::__construct();
        
    }
    public function index()
    {
        return view('admin/interface/interfaceLog');

    }

    public function search( Request $request)
    {
        
        $where = [];
        if ( $request->input('mac_address') ) {
            $where[] = ['mac', trim($request->input('mac_address')) ];
        }
         $permissions=session('permissions');
        if($permissions==2){
             $interface_obj = interfaceLog::where($where)
                ->join('router_mac','router_mac.mac','=','interface_log.mac')
                ->join('set_user_router','set_user_router.rid','=','router_mac.mac_id')
                ->where('set_user_router.uid',session('userid'))
                ->orderBy($request->input('sort'), $request->input('order'))
                ->paginate($request->input('limit'))
                ->toArray();
        }else{

            $interface_obj = interfaceLog::where($where)
                    ->orderBy($request->input('sort'), $request->input('order'))
                    ->paginate($request->input('limit'))
                    ->toArray();
        }
            
        

        //返回数组
        $return_data = array(
            'total' => $interface_obj['total'],
            'rows' => array()
        );

        if ( $interface_obj['data'] ) {
            foreach ( $interface_obj['data'] as $item ) {

                // 根据用户ip得到地理位置
                $location= @convertip(long2ip($item['user_ip']));

                $operating = '';

                $operating .= '<a class="btn btn-success btn-xs btns" href="javascript: void(0);" onclick="interface.edit(' . $item['id'] .')" >修改</a>';
                $operating .= '<a class="btn btn-warning btn-xs btns" href="javascript: void(0);" onclick="interface.delOne(' . $item['id'] .')" >删除</a>';

                $return_data['rows'][] = array(
                    'id' => $item['id'],
                    'visit_time' => $item['visit_time'],
                    'mac' => $item['mac'],
                    'ssid' => $item['ssid'],
                    'net' => $item['net'],
                    'count' => $item['count'],
                    'user_ip' =>long2ip($item['user_ip']).'('.$location.')',
                    'operating' => $operating,
                );

            }

        }
        return $return_data;

    }

    // 根据mac搜索一条日志记录
    public function searchOne($mac){
        $data['mac']=$mac;
        return view('admin/interface/oneLog',$data);
    }

    public function searchOneData(Request $request)
    {
        $where = [];
        if ( $request->input('mac') ) {
            $where[] = ['mac', trim($request->input('mac')) ];
        }
        $interface_obj = interfaceLog::where($where)
                ->orderBy($request->input('sort'), $request->input('order'))
                ->paginate($request->input('limit'))
                ->toArray();
            
        
        //返回数组
        $return_data = array(
            'total' => $interface_obj['total'],
            'rows' => array()
        );

        if ( $interface_obj['data'] ) {

            foreach ( $interface_obj['data'] as $item ) {
                // 根据用户ip得到地理位置
                $location= @convertip(long2ip($item['user_ip']));

                $operating = '';

                $operating .= '<a class="btn btn-warning btn-xs btns" href="javascript: void(0);" onclick="interface.delOne(' . $item['id'] .')" >删除</a>';

                $return_data['rows'][] = array(
                    'id' => $item['id'],
                    'visit_time' => $item['visit_time'],
                    'mac' => $item['mac'],
                    'ssid' => $item['ssid'],
                    'net' => $item['net'],
                    'count' => $item['count'],
                    'user_ip' => long2ip($item['user_ip']).'('.$location.')',
                    'operating' => $operating,
                );

            }

        }

        return $return_data;
    }

    // 得到某个id的日志信息
    public function getLog($id)
    {
        // 查询interfaceLog
        $log_obj=InterfaceLog::find($id);
        if (!$log_obj) {
            return response()->json(['code' => 100001, 'message' => '未查到该MAC信息']);
        }
        $log_obj['user_ip']=long2ip($log_obj['user_ip']);
        return response()->json(['code' => 200, 'message' => 'ok', 'data' => $log_obj]);

    }

    public function edit( Request $request )
    {
        $dt = $request->input();
        if ( empty($dt['id']) ) {
            return response()->json([ 'code' => 100001, 'message' => '缺少参数:id' ]);
        }

        if ( empty($dt['mac']) ) {
            return response()->json([ 'code' => 100002, 'message' => '请输入MAC地址' ]);
        }

        if ( empty($dt['ssid']) ) {
            return response()->json([ 'code' => 100003, 'message' => '请输入SSID名称' ]);
        }

        if ( empty($dt['visit_time']) ) {
            return response()->json([ 'code' => 100004, 'message' => '请选择访问时间' ]);
        }

        if ( empty($dt['user_ip']) ) {
            return response()->json([ 'code' => 100005, 'message' => '请输入用户IP' ]);
        }

        $interface_obj = InterfaceLog::find($dt['id']);
        if (!$interface_obj) {
            return response()->json(['code' => 100006, 'message' => '未查到该日志信息']);
        }

        $interface_obj->ssid = $dt['ssid'];
        $interface_obj->visit_time = $dt['visit_time'];
        $interface_obj->user_ip = ip2long($dt['user_ip']);
        $interface_obj->net = $dt['net'];
        $interface_obj->count = $dt['count'];

        $interface_obj->save();

        $data['mac'] = $interface_obj->mac;
        $data['ssid'] = $interface_obj->ssid;
        $data['ip'] = $request->ip();
        $data['content'] = array('内容' => '修改接口日志', '操作人' =>'');
        addLog($data);   #保存操作日志

        return response()->json([ 'code' => 200, 'message' => '修改成功' ]);

    }


    public function del( Request $request )
    {
        $del_data = $request->input('del_data');
        if ( count($del_data) == 0 ) {
            return response()->json([ 'code' => 100001, 'message' => '请选择要删除的日志' ]);
        }
        foreach ( $del_data as $id ) {
           $interface_obj = InterfaceLog::find($id);

           if ( $interface_obj ) {
               $data['mac'] = $interface_obj->mac;
               $data['ssid'] = $interface_obj->ssid;
               $data['ip'] = $request->ip();
               $data['content'] = array('内容' => '删除接口日志', '操作人' =>'');

               addLog($data);   #保存操作日志

               $interface_obj->delete();

           }

        }

        return response()->json([ 'code' => 200, 'message' => '删除成功' ]);

    }

}
