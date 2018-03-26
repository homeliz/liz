<?php

namespace App\Http\Controllers\Admin\Router;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Admin\Router\ConfigMaster;#配置表
use App\Http\Models\Admin\Router\RouterMac;
use App\Http\Models\Admin\Router\GlobalSetting;
use App\Http\Models\Admin\Router\Wan;
use App\Http\Models\Admin\Router\Lan;
use App\Http\Models\Admin\Router\SetWifi;
use App\Http\Models\Admin\Server\SetServer;

use DB;
use App\Http\Models\Admin\Server\ServerList;

class RouteController extends \App\Http\Controllers\Admin\BasicController
{
    public function __construct(){
        parent::__construct();
        
    }
    public function index()
    {
       // return @convertip('183.160.239.206');
        $data = [];

        #获取路由器接收配置信息
        $config_obj = ConfigMaster::find(1);

        if ( !$config_obj ) {
            return response()->json([ 'code' => 100001, 'message' => '读取配置信息失败' ]);
        }

        $data['config'] = $config_obj->useFlag;
        $data['permissions']=session('permissions');

        return view('admin/router/router', $data );

    }

    public function search( Request $request )
    {
        $where = [];

        if ( $request->input('mac_address') ) {
            $where[] = ['mac', trim($request->input('mac_address')) ];
        }
        $permissions=session('permissions');
        if($permissions==2){
            $mac_obj = RouterMac::where($where)
                ->join('set_user_router','set_user_router.rid','=','router_mac.mac_id')
                ->where('set_user_router.uid',session('userid'))
                ->orderBy($request->input('sort'), $request->input('order'))
                ->paginate($request->input('limit'))
                ->toArray();
        }else{

            $mac_obj = RouterMac::where($where)
                ->orderBy($request->input('sort'), $request->input('order'))
                ->paginate($request->input('limit'))
                ->toArray();
        }

        //返回数组
        $return_data = array(
            'total' => $mac_obj['total'],
            'rows' => array()
        );

        // 得到当前时间的年月日
        $day=Carbon::now();
        $day=explode(' ',$day);
        $day1=$day[0];

        if ( $mac_obj['data'] ) {

            foreach ( $mac_obj['data'] as $item ) {
                // 得到到期时间的年月日
                $expire_date=explode(' ',$item['expire_date']);
                $day2=$expire_date[0];
                $diffdays = diffBetweenTwoDays($day1,$day2);
                
                if($item['proxy']==1){
                        $moshi1='正常';
                    }
                    if($item['proxy']==0){
                        $moshi1='不通';
                    }
                    if($item['ipsec']==0){
                        $moshi='未连接';
                    }
                    if($item['ipsec']==1){
                        $moshi='已连接';
                    } 


                $operating = '';

                $operating .= '<a class="btn btn-success btn-xs btns" href="javascript: void(0);" onclick="mac.edit(' . $item['mac_id'] .')" >修改</a>';
                if(session('permissions')==1){

                    $operating .= '<a class="btn btn-warning btn-xs btns" href="javascript: void(0);" onclick="mac.delOne(' . $item['mac_id'] .')" >删除</a>';
                }
                if($item['product_type']==1){

                    $operating.='<div class="form-group col-sm-4"><label for="app_name" class=" control-label"><strong><span class="red"></span></strong></label><div class="col-sm-12"><select class="form-control" name="product_type" id="product_type" onchange="changetype('.$item['mac_id'].',this.value)"><option value="0">关闭链路功能</option><option value="1" selected>生活</option><option value="2">工作</option><option value="3">隐云</option></select></div></div>';
                    
                }else if($item['product_type']==2){
                    $operating.='<div class="form-group col-sm-4"><label for="app_name" class=" control-label"><strong><span class="red"></span></strong></label><div class="col-sm-12"><select class="form-control" name="product_type" id="product_type" onchange="changetype('.$item['mac_id'].',this.value)"><option value="0">关闭链路功能</option><option value="1" >生活</option><option value="2" selected>工作</option><option value="3">隐云</option></select></div></div>';
                   
                }else if($item['product_type']==3){
                    $operating.='<div class="form-group col-sm-4"><label for="app_name" class=" control-label"><strong><span class="red"></span></strong></label><div class="col-sm-12"><select class="form-control" name="product_type" id="product_type" onchange="changetype('.$item['mac_id'].',this.value)"><option value="0">关闭链路功能</option><option value="1" >生活</option><option value="2">工作</option><option value="3"  selected>隐云</option></select></div></div>';
                 
                }else{
                    $operating.='<div class="form-group col-sm-4"><label for="app_name" class=" control-label"><strong><span class="red"></span></strong></label><div class="col-sm-12"><select class="form-control" name="product_type" id="product_type" onchange="changetype('.$item['mac_id'].',this.value)"><option value="0"  selected>关闭链路功能</option><option value="1" >生活</option><option value="2">工作</option><option value="3" >隐云</option></select></div></div>';
                   
                }
                $operating .= '<a class="btn btn-info btn-xs btns" href="javascript: void(0);" onclick="mac.setServer(' . $item['mac_id'].','.$item['product_type'] .')" >设置服务器</a>';
                $operating .= '<a class="btn btn-info btn-xs btns" href="javascript: void(0);" onclick="mac.globalSetting(' . $item['mac_id'].','.$item['product_type'] .')" >全局设置</a>';
                $operating .= '<a class="btn btn-info btn-xs btns" href="javascript: void(0);" onclick="mac.showSetWifi(' . $item['mac_id'] .',\''.$item['ssid'].'\')" >wifi设置</a>';
                if ( $item['useFlag'] == 0 ) {
                    $useFlag = '<a  href="javascript: void(0);" onclick="mac.change(' . $item['mac_id'] .', 1)" >未审核</a>';
                } elseif( $item['useFlag'] == 1 ) {
                    $useFlag = '<a  href="javascript: void(0);" onclick="mac.change(' . $item['mac_id'] .', 0)" >已审核</a>';
                }
                // 若到期时间小于30天
                if($diffdays<30){
                    if(!empty($item['expire_date'])){

                        $end_expire_date= $item['expire_date'].'(<span style="color:#f0ad4e;">'.$diffdays.'</span>)';
                    }else{
                        $end_expire_date= '-';

                    }
                }else{
                    $end_expire_date= $item['expire_date'].'('.$diffdays.')';
                }

                if(session('permissions')==1){

                    $return_data['rows'][] = array(
                        'id' => $item['mac_id'],
                        'created_at' => $item['created_at'],
                        'mac' => '<a href="/mf/interface/searchOne/'.$item['mac'].'" style="cursor:pointer">'.$item['mac'].'</a>',
                        'ssid' => $item['ssid'],
                        'expire_date' => $end_expire_date,
                        'moshi' => $moshi,
                        'moshi1' => $moshi1,
                        'useFlag' => $useFlag,
                        'remark_info' => $item['remark_info'],
                        'operating' => $operating,
                    );
                }else{
                     $return_data['rows'][] = array(
                        'id' => $item['mac_id'],
                        'created_at' => $item['created_at'],
                        'mac' => '<a href="/mf/interface/searchOne/'.$item['mac'].'" style="cursor:pointer">'.$item['mac'].'</a>',
                        'ssid' => $item['ssid'],
                        'expire_date' => $end_expire_date,
                        'moshi' => $moshi,
                        'moshi1' => $moshi1,
                        'remark_info' => $item['remark_info'],
                        'operating' => $operating,
                    );
                }


            }

        }

        return $return_data;

    }

    /**
     * 改变路由器接收配置
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function config( Request $request )
    {


        $config_id = (int)$request->input('config_id');  #配置ID


        $op = $request->input('op');  #状态 1开启 0关闭

        $config_obj = ConfigMaster::find($config_id);

        if ( !$config_obj ) {
            return response()->json([ 'code' => 100001, 'message' => '读取配置信息失败' ]);
        }

        if ( !in_array( $op, [ '0', '1' ] ) ) {
            return response()->json([ 'code' => 100002, 'message' => '参数错误' ]);
        }

        $config_obj->useFlag = $op;

        $config_obj->save();

        return response()->json([ 'code' => 200, 'message' => '改变成功' ]);

    }

    /**
     * 审核撤销审核
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function change( Request $request )
    {

        $mag = '已通过审核';
        $mac_id = $request->input('mac_id');
        $useFlag = $request->input('useFlag');

        if ( empty($mac_id) ) {
            return response()->json([ 'code' => 100001, 'message' => '缺少参数:mac_id' ]);
        }

        if ( is_array( $mac_id ) ) {

            #循环判断
            foreach ( $mac_id as $id ) {

                #验证mac_id
                $mac_obj = RouterMac::find($id);

                if ( !$mac_obj ) {
                    continue;
                }

                if( $mac_obj->useFlag == 1 ) {
                    continue;
                }

                $mac_obj->creator = userID();
                $mac_obj->useFlag = 1;
                $mac_obj->expire_date = $this->setTime();
                $mac_obj->save();

                $data['mac'] = $mac_obj->mac;
                $data['ssid'] = $mac_obj->ssid;
                $data['ip'] = $request->ip();
                $data['content'] = array('内容' => $mag, '操作人' => userID());
                addLog($data);   #保存操作日志

            }

        } else {

            if ( $useFlag == null || !in_array( $useFlag, array( '0', '1' ) ) ) {
                return response()->json([ 'code' => 100002, 'message' => '缺少参数:useFlag' ]);
            }

            #验证mac_id
            $mac_obj = RouterMac::find($mac_id);

            if ( !$mac_obj ) {
                return response()->json([ 'code' => 100003, 'message' => '未查询到mac信息' ]);
            }

            if( $mac_obj->useFlag == $useFlag ) {

                if( $useFlag == 0 ) {
                    $mag = '已撤销审核';
                }
                return response()->json([ 'code' => 200, 'message' => $mag ]);

            }

            if( $useFlag == 0 ) {
                $mag = '已撤销审核';
                $expire_date = null;
            } else {
                $expire_date = $this->setTime();
            }


            $mac_obj->creator = userID();
            $mac_obj->useFlag = $useFlag;
            $mac_obj->expire_date = $expire_date;
            $mac_obj->save();

            $data['mac'] = $mac_obj->mac;
            $data['ssid'] = $mac_obj->ssid;
            $data['ip'] = $request->ip();
            $data['content'] = array('内容' => $mag, '操作人' => userID());

            addLog($data);   #保存操作日志

        }

        return response()->json([ 'code' => 200, 'message' => $mag ]);

    }

    public function del( Request $request )
    {
        $del_data = $request->input('del_data');
        if ( count($del_data) == 0 ) {
            return response()->json([ 'code' => 100001, 'message' => '请选择要删除的MAC' ]);
        }
        foreach ( $del_data as $mac_id ) {
           $mac_obj = RouterMac::find($mac_id);

           if ( $mac_obj ) {
                // 删除用户绑定的路由
                $set_user_router=DB::table('set_user_router')->where('rid',$mac_id)->delete();
                // 查询此MAC是否设置过服务器
                $server=SetServer::where('rid',$mac_id)->get();
                if(!empty($server)){
                    // 查询此MAC有设置过服务器
                    $del_set_server=SetServer::where('rid',$mac_id)->delete();
                    // 查询此mac下是否全局设置过
                    $global_id=GlobalSetting::where('mac_id',$mac_id)->first(['id']);
                    if(!empty($global_id)){
                        
                        // 如果在此路由下不设置任何的服务器，则之前在此路由下已设置过的全局设置相关信息也删除
                        GlobalSetting::where('mac_id',$mac_id)->delete();
                        Wan::where('global_id',$global_id['id'])->delete();
                        Lan::where('global_id',$global_id['id'])->delete();
                    }
                }
               $data['mac'] = $mac_obj->mac;
               $data['ssid'] = $mac_obj->ssid;
               $data['ip'] = $request->ip();
               $data['content'] = array('内容' => '删除MAC', '操作人' => userID());

               addLog($data);   #保存操作日志

               $mac_obj->delete();

           }

        }

        return response()->json([ 'code' => 200, 'message' => '删除成功' ]);

    }

    /**
     * 通过主键mac_id 获取mac信息
     * @param $mac_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getMac( $mac_id )
    {

        $mac_obj = RouterMac::find($mac_id);
        if (!$mac_obj) {
            return response()->json(['code' => 100001, 'message' => '未查到该MAC信息']);
        }

        return response()->json(['code' => 200, 'message' => 'ok', 'data' => $mac_obj]);

    }

    public function edit( Request $request )
    {
        $dt = $request->input();
        // 得到当前时间戳
        $day1=time();
        // 得到数据库到期时间戳
        $day2=$request->input('expire_date');
        $day2=strtotime($day2);
        if(($day2-$day1)<=0){
            return response()->json([ 'code' => 100005, 'message' => '请填写正确的到期时间' ]);
        }

        if ( empty($dt['mac_id']) ) {
            return response()->json([ 'code' => 100001, 'message' => '缺少参数:mac_id' ]);
        }

        if ( empty($dt['mac']) ) {
            return response()->json([ 'code' => 100002, 'message' => '请输入MAC地址' ]);
        }

        if ( empty($dt['ssid']) ) {
            return response()->json([ 'code' => 100003, 'message' => '请输入SSID名称' ]);
        }

        if ( empty($dt['registration_time']) ) {
            return response()->json([ 'code' => 100004, 'message' => '请选择注册时间' ]);
        }

        if ( empty($dt['expire_date']) ) {
            return response()->json([ 'code' => 100005, 'message' => '请选择到期时间' ]);
        }

        $mac_obj = RouterMac::find($dt['mac_id']);
        if (!$mac_obj) {
            return response()->json(['code' => 100006, 'message' => '未查到该MAC信息']);
        }

        $mac_obj->creator = userID();
        $mac_obj->ssid = $dt['ssid'];
        $mac_obj->registration_time = $dt['registration_time'];
        $mac_obj->expire_date = $dt['expire_date'];
        $mac_obj->remark_info = $dt['remark_info'];

        $mac_obj->save();

        $data['mac'] = $mac_obj->mac;
        $data['ssid'] = $mac_obj->ssid;
        $data['ip'] = $request->ip();
        $data['content'] = array('内容' => '修改MAC', '操作人' => userID());
        addLog($data);   #保存操作日志

        return response()->json([ 'code' => 200, 'message' => '修改成功' ]);

    }

    /**
     * 过期时间
     * @return static
     */
    public function setTime()
    {
        return Carbon::now()->addYear(1)->toDateString().' 23:59:59';
    }

    /**
     * 设置服务器  加载展示所有服务器信息列表的页面
     * @param  $mac_id [路由列表的id]
     */
    public function showSetServer($mac_id,$product_type)
    {   
        // 接收传过来的路由器ID
        $data['mac_id']=$mac_id;
        $data['product_type']=$product_type;
       
        // 查询服务器的ID
        $sids = DB::table('server_list')->select('id')->get();
        $data['sids']=json_encode($sids);
        return view('admin/router/showSetServer',$data);
    }

    /**
     * 设置服务器  加载展示所有服务器信息列表的页面
     * @param  $mac_id [路由列表的id]
     */
    public function setServer($product_type,Request $request)
    { 
        $pageIndex = $request->input('page', 1);     //分页 当前页面
        $pageSize = $request->input('limit', 10);   //取条数
        $where = [];

        // 如果根据IP搜索
        if ( $request->input('server') ) {
            $where[] = [ 'server', $request->input('server') ];
        }
        
        // 如果根据别名搜索
        if ( $request->input('alias') ) {
            $where[] = [ 'alias', $request->input('alias') ];
        }
        // 查询服务器信息
        if(session('permissions')==2){
            $server_data = ServerList::where($where)
                ->join('set_user_server','set_user_server.sid','=','server_list.id')
                ->where('set_user_server.uid','=',session('userid'))
                ->where('product_type',$product_type)
                ->orderBy($request->input('sort'), $request->input('order'))
                ->paginate($pageSize)
                ->toArray();

        }else{
            $server_data = ServerList::where($where)
                ->where('product_type',$product_type)
                ->orderBy($request->input('sort'), $request->input('order'))
                ->paginate($pageSize)
                ->toArray();
        }
        // 查询set_server表
        $permissions=session('permissions');

        if($permissions==2){
            $set_server=DB::table('set_server')->select('sid')->where('rid', $request->input('rid'))->where('uid','=',session('userid'))->pluck('sid');

        }else{

            $set_server=DB::table('set_server')->select('sid')->where('rid', $request->input('rid'))->where('uid','=',session('userid'))->pluck('sid');
        }
        // 分页机制
        $page_link = '';
        // 如果有服务器存在(即total为真)
        if ($server_data['total']) {
            $page_link = page($pageIndex, $server_data['total'], $pageSize, 'javascript:void(0)', 'admin.page');
        }

        //返回数组
        $return_data = array(
            'link' => (string)$page_link,
            'total' => $server_data['total'],
            'rid' =>$set_server,
            'rows' => array()
        );
        if( $server_data['data'] )
        {
            foreach ( $server_data['data'] as $item )
            {
                $return_data['rows'][] = array(
                    'id' => $item['id'],
                    'server' => $item['server'],
                    'alias' => $item['alias'],
                    'server_port' => $item['server_port'],
                    'local_port' => $item['local_port'],
                    'protocol' => $item['protocol'],
                );
            }
        }

        return $return_data;

    }
    /**
     * 提交已经设置的服务器  加载展示所有服务器信息列表的页面
     * @param  $mac_id [路由列表的id]
     * @param  $select_sid [给对应的路由(mac_id)选择的服务器ID]
     */
    public function doSetServer(Request $request)
    {
        $mac_id=$request->input('mac_id');
        $select_sid=$request->input('select_sid');
        $product_type=$request->input('product_type');
        $permissions=session('permissions');
        if($permissions==2){

          // 查询set_server表
            $set_server=DB::table('set_server')->select('sid')->where('rid', $mac_id)->where('uid','=',session('userid'))->pluck('sid');

        }else{
            $set_server=DB::table('set_server')->select('sid')->where('rid', $mac_id)->where('uid','=',session('userid'))->pluck('sid');
        }
        if(!empty($select_sid)){

            $set_server_need=array_diff($select_sid,$set_server);
            $set_server_delete= array_diff($set_server, $select_sid);
        }else{
            // 如果一个也没有选中
             $del_info=DB::table('set_server')->where('rid', $mac_id)->where('product_type',$product_type)->where('uid','=',session('userid'))->delete();

        }
        // return $set_server_delete;
        // 重新插入关联的服务器
        if(!empty($set_server_need)){
            foreach ($set_server_need as $v) {
                if($v){
                    // 排除全选$v为空的情况
                     DB::table('set_server')->insert(['rid' => $mac_id, 'sid' => $v,'uid'=>session('userid'),'product_type'=>$product_type]);
                }
            }
        }
        if(!empty($set_server_delete)){
            foreach ($set_server_delete as $v) {
                if($v){
                    // 排除全选$v为空的情况
                     $del_info=DB::table('set_server')->where('rid', $mac_id)->where('sid',$v)->where('product_type',$product_type)->where('uid','=',session('userid'))->delete();
                }
            }
        }
 
        return response()->json([ 'code' => 200, 'message' => '设置成功' ]);
        
    }

    // 请先设置服务器
    /**
     * 根据mac_id  全局设置  
     * @param  $mac_id [路由列表的id]
     */
    public function globalSetting($mac_id,$product_type)
    {
        $data['mac_id']=$mac_id;
       
        //  查询该mac_id下已经选择的服务器
        $server_selected = DB::table('server_list')
            ->join('set_server', 'server_list.id', '=', 'set_server.sid')
            ->where('set_server.rid','=',$mac_id)
            ->where('set_server.product_type','=',$product_type)
            ->where('set_server.uid','=',session('userid'))
            ->select('server_list.server', 'server_list.server_port')
            ->get();
   
       
        // 如果之前没有设置过服务器
        if(empty($server_selected)){

            return view('admin/router/globalSetting', ['title' => '全局设置','mac_id'=>$mac_id]);
        }else{
            // 如果之前有设置过服务器
            $arr=[];
            $arr1=[];
            foreach ($server_selected as $v) {
                $arr[0] =$v->server;
                $arr[1] =$v->server_port;
                $arr2=implode(":",$arr);
                array_push($arr1,$arr2);
            }
            // 查询此mac_id下是否已全局设置过
            // 若全局设置过
            $set_server=GlobalSetting::where('mac_id',$mac_id)->where('product_type',$product_type)->first();
            if(!empty($set_server)){
                $set_server=$set_server->toArray();
                // 查询wan和lan表
                $wan=Wan::where('global_id',$set_server['id'])->where('product_type',$product_type)->first();
                // 若wan表设置过
                if(!empty($wan)){
                    $wan=$wan->toArray();
                }
                $lan=Lan::where('global_id',$set_server['id'])->where('product_type',$product_type)->first();
                // 若wan表设置过
                if(!empty($lan)){
                    $lan=$lan->toArray();
                }
                
                // 此路由全局设置过
                return view('admin/router/globalSetting', ['title' => '全局设置','server_selected' => $arr1,'set_server'=>$set_server,'wan'=>$wan,'lan'=>$lan,'mac_id'=>$mac_id,'product_type'=>$product_type]);
            }else{

                // 此路由设置过服务器未全局设置过

                return view('admin/router/globalSetting', ['title' => '全局设置','mac_id'=>$mac_id,'server_selected' => $arr1,'product_type'=>$product_type]);
            }
        }

    }

    // 全局设置提交
    public function doGlobalSetting(Request $request)
    {   
        // 查询该mac_id下已经选择的服务器
        $data = $request->input();
        // return $data;
        $server_selected = DB::table('server_list')
            ->join('set_server', 'server_list.id', '=', 'set_server.sid')
            ->where('set_server.rid','=',$data['mac_id'])
            ->where('set_server.product_type',$data['product_type'])
            ->select('server_list.server', 'server_list.server_port')
            ->get();
        
        // 如果之前没有设置过服务器
        if(empty($server_selected)){
            return response()->json([ 'code' => 100009, 'message' => '请先设置服务器' ]);

        }
        $wan_info=[];
        $wan_info['wan_bp_list']=$data['wan_bp_list'];
        $wan_info['extra_ignore_ip']=$data['extra_ignore_ip'];
        $wan_info['force_ip']=$data['force_ip'];
        $lan_info=[];
        $lan_info['router_proxy']=$data['router_proxy'];
        $lan_info['lan_ac_mode']=$data['lan_ac_mode'];
        $lan_info['in_online_host']=$data['in_online_host'];
        // 如果之前在此mac_id下就设置过，则更新
        if(!empty($data['global_id']) ){

            $global_setting = GlobalSetting::find($data['global_id']);
            $wan_info['global_id']=$data['global_id'];
            $wan_info['product_type']=$data['product_type'];
            $lan_info['global_id']=$data['global_id'];
            $lan_info['product_type']=$data['product_type'];

            if ( !isset($data['monitor_enable']) ) {
                $global_setting->monitor_enable = 0;
                
            }else{
                $global_setting->monitor_enable = $data['monitor_enable'][0];
            }
            if ( !isset($data['tunnel_enable']) ) {
                $global_setting->tunnel_enable = 0;
                
            }else{
                $global_setting->tunnel_enable = $data['tunnel_enable'][0];
            }
            
            if ( !isset($data['enable_switch']) ) {
                $global_setting->enable_switch=0;
                $global_setting->switch_time = ' ';
                $global_setting->switch_timeout=' ';

            }else{
                $global_setting->enable_switch = $data['enable_switch'][0];
                $global_setting->switch_time = $data['switch_time'];
                $global_setting->switch_timeout = $data['switch_timeout'];

            }
            
            $global_setting->gfw_enable = $data['gfw_enable'];

            if(empty($data['tunnel_forward'])){
                $global_setting->tunnel_forward=' ';
            }else{
                $global_setting->tunnel_forward = $data['tunnel_forward'];

            }
            if(empty($data['global_server'])){
                $global_setting->global_server=' ';
            }else{
                $global_setting->global_server = $data['global_server'];

            }
            if(empty($data['tunnel_port'])){
                $global_setting->tunnel_port=' ';
            }else{
                $global_setting->tunnel_port = $data['tunnel_port'];

            }
            if(empty($data['udp_relay_server'])){
                $global_setting->udp_relay_server=' ';
            }else{
                $global_setting->udp_relay_server = $data['udp_relay_server'];

            }
            // if($data['server']=='停用'){
            //     $global_setting->server='nil';
            // }else{
                $global_setting->server = $data['server'];

            // }
            if(empty($data['local_port'])){
                $global_setting->local_port=' ';
            }else{
                $global_setting->local_port = $data['local_port'];

            }
            $global_setting->save();
            if($global_setting){
                $wan=$this->wan($wan_info);
                $lan=$this->lan($lan_info);
                if($wan&&$lan){
                    return response()->json([ 'code' => 200, 'message' => '更新成功' ]);
                }
            }
        }else{
            // 插入
             $insert = new GlobalSetting;
             $insert->product_type=$data['product_type'];
            if ( !isset($data['monitor_enable']) ) {
                $insert->monitor_enable = 0;
            }else{
                $insert->monitor_enable = $data['monitor_enable'][0];
            }
            
            if ( !isset($data['enable_switch']) ) {
                $insert->enable_switch=0;
                $insert->switch_time = ' ';
                $insert->switch_timeout=' ';

            }else{
                $insert->enable_switch = $data['enable_switch'][0];
                $insert->switch_time = $data['switch_time'];
                $insert->switch_timeout = $data['switch_timeout'];

            }
            if(empty($data['tunnel_port'])){
                $insert->tunnel_port=' ';
            }else{
                $insert->tunnel_port = $data['tunnel_port'];

            }
            if ( !isset($data['tunnel_enable']) ) {
                $insert->tunnel_enable = 0;
                
            }else{
                $insert->tunnel_enable = $data['tunnel_enable'][0];
            }
            if(empty($data['gfw_enable'])){
                $insert->gfw_enable=' ';
            }else{
                $insert->gfw_enable = $data['gfw_enable'];

            }
            if(empty($data['tunnel_forward'])){
                $insert->tunnel_forward=' ';
            }else{
                $insert->tunnel_forward = $data['tunnel_forward'];

            }
            if(empty($data['global_server'])){
                $insert->global_server=' ';
            }else{
                $insert->global_server = $data['global_server'];

            }
            if(empty($data['udp_relay_server'])){
                $insert->udp_relay_server=' ';
            }else{
                $insert->udp_relay_server = $data['udp_relay_server'];

            }
           
            $insert->server = $data['server'];

            if(empty($data['local_port'])){
                $insert->local_port=' ';
            }else{
                $insert->local_port = $data['local_port'];

            }
            $insert->mac_id=$data['mac_id'];
            $insert->save();
            if($insert){
                $global_id = $insert->id;
                $wan=$this->wan($data,$global_id);
                $lan=$this->lan($data,$global_id);
                if($wan&&$lan){
                    return response()->json([ 'code' => 200, 'message' => '保存成功' ]);  
                    
                }
            }
        }
        
        
    }
    // 对wan表的更新
    public function wan($data,$global_id=null)
    {   
        if(!empty($global_id)){
            $data['global_id']=$global_id;
        }

        // 根据得到的$global_id查询wan表
        $wan_info=Wan::where('global_id',$data['global_id'])->first();
        if(!empty($wan_info)){
            // 更新
           
            $wan_info->wan_bp_list = $data['wan_bp_list'];

            
            if ( empty($data['extra_ignore_ip']) ) {
                $wan_info->extra_ignore_ip = ' ';
            }else{
                $wan_info->extra_ignore_ip = $data['extra_ignore_ip'];
            }
            if ( empty($data['force_ip']) ) {
                $wan_info->force_ip = ' ';
            }else{
                $wan_info->force_ip = $data['force_ip'];

            }
            return $wan_info->save();

        }else{
            // 插入
            $insert = new Wan;
            
            $insert->wan_bp_list = $data['wan_bp_list'];
            $insert->product_type = $data['product_type'];

            if ( empty($data['extra_ignore_ip']) ) {
                $insert->extra_ignore_ip = ' ';
            }else{
                $insert->extra_ignore_ip = $data['extra_ignore_ip'];

            }
            if ( empty($data['force_ip']) ) {
                $insert->force_ip = ' ';
            }else{
                $insert->force_ip = $data['force_ip'];

            }
            $insert->global_id=$data['global_id'];
            return $insert->save();


        }
    }

    // 对wan表的更新
    public function lan($data,$global_id=null)
    {   
        if(!empty($global_id)){
            $data['global_id']=$global_id;
        }
        // 根据得到的$global_id查询wan表
        $lan_info=Lan::where('global_id',$data['global_id'])->first();
        if(!empty($lan_info)){
            // 更新
            
            $lan_info->router_proxy = $data['router_proxy'];

            $lan_info->lan_ac_mode = $data['lan_ac_mode'];

            if ( empty($data['in_online_host']) ) {
                $lan_info->in_online_host = ' ';
            }else{
                $lan_info->in_online_host = $data['in_online_host'];
            }
            return $lan_info->save();
        }else{
            // 插入
            $insert = new Lan;
           
            $insert->router_proxy = $data['router_proxy'];
            $insert->product_type = $data['product_type'];

            $insert->lan_ac_mode = $data['lan_ac_mode'];

            if ( empty($data['in_online_host']) ) {
                $insert->in_online_host = ' ';
            }else{
                $insert->in_online_host = $data['in_online_host'];

            }
            
            $insert->global_id=$data['global_id'];
            return $insert->save();


        }
    }

    // wifi设置
    public function doSetWifi(Request $request)
    {
        $data = $request->input();
        $update_data=[];
        // 将得到的值保存到set_wifi表中
        if(!empty($data['needset'])){

            $data['needset']=1;
            
        }else{
            $data['needset']=0;
        }
        // 首先根据mac_id查询是否wifi设置过
        $get_wifi=SetWifi::where('rid',$data['rid'])->first();
        if(!empty($get_wifi)){
            // 更新
            $update_data['ssid']=$data['ssid'];
            $update_data['key']=$data['key'];
            $update_data['encryption']=$data['encryption'];
            $update_data['needset']=$data['needset'];
            $update=SetWifi::where('rid',$data['rid'])->update($update_data);
            return response()->json([ 'code' => 200, 'message' => '更新成功' ]);
            
        }else{
            // 插入
            $wifi = new SetWifi;

            $wifi->ssid = $data['ssid'];
            $wifi->key = $data['key'];
            $wifi->encryption = $data['encryption'];
            $wifi->rid = $data['rid'];
            $wifi->needset = $data['needset'];
            $wifi->save();
            return response()->json([ 'code' => 200, 'message' => '保存成功' ]);

        }
    }

    // 得到wifi设置信息
    public function getWifi($mac_id)
    {
        $wifi_obj=SetWifi::where('rid',$mac_id)->first();
        if (!$wifi_obj) {
            return response()->json(['code' => 100001, 'message' => '未查到wifi设置信息']);
        }

        return response()->json(['code' => 200, 'message' => 'ok', 'data' => $wifi_obj]);
    }

    public function product_type(Request $request)
    {
        $product_type=$request->input('product_type');
        $mac_id=$request->input('mac_id');
        $mac_obj=RouterMac::find($mac_id);
        $mac_obj->product_type=$product_type;
        $mac_obj->save();
       
       $data['mac'] = $mac_obj->mac;
       $data['ssid'] = $mac_obj->ssid;
       $data['ip'] = $request->ip();
       $data['content'] = array('内容' => '修改MAC工作模式', '操作人' => userID());

       addLog($data);   #保存操作日志

        // 如果改为隐云状态删除全局设置

        return response()->json(['code' => 200, 'message' => '更新成功']);
    }


}
