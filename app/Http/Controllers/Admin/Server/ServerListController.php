<?php

namespace App\Http\Controllers\Admin\Server;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Admin\Server\ServerList;

class ServerListController extends \App\Http\Controllers\Admin\BasicController
{
    public function __construct(){
        parent::__construct();
        
    }
    public function index()
    {
        return view('admin/server/serverList');
    }

    public function search( Request $request )
    {
        $where = [];

        if ( $request->input('server') ) {
            $where[] = [ 'server', 'like' , '%'.$request->input('server').'%' ];
        }

        $permissions=session('permissions');
        if($permissions==2){
            $server_obj = ServerList::where($where)
                ->join('set_user_server','set_user_server.sid','=','server_list.id')
                ->where('set_user_server.uid',session('userid'))
                ->orderBy($request->input('sort'), $request->input('order'))
                ->paginate($request->input('limit'))
                ->toArray();
        }else{

            $server_obj = ServerList::where($where)
                ->orderBy($request->input('sort'), $request->input('order'))
                ->paginate($request->input('limit'))
                ->toArray();
        }

        //返回数组
        $return_data = array(
            'total' => $server_obj['total'],
            'rows' => array()
        );
        if ( $server_obj['data'] ) {
            foreach ( $server_obj['data'] as $item ) {
               if($item['product_type']==0){

                    $product_type='关闭链路模式';

                }elseif($item['product_type']==1){
                    $product_type='生活';

                }elseif($item['product_type']==2){
                    $product_type='工作';

                }else{
                    $product_type='隐云';

                }
                if(!$item['obfs']){
                    $obfs='-';
                }else{
                    $obfs=obfs($item['obfs']);
                }
                 if(!$item['protocol']){
                    $protocol='-';
                }else{
                    $protocol=protocol($item['protocol']);
                }
                 if(!$item['encrypt_method']){
                    $encrypt_method='-';
                }else{
                    $encrypt_method=encrypt_method($item['encrypt_method']);
                }
                $operating = '<a class="btn btn-success btn-xs btns" href="javascript: void(0);" onclick="server.edit(' . $item['id'] .')" >修改</a>';
                $operating .= '<a class="btn btn-warning btn-xs btns" href="javascript: void(0);" onclick="server.del(' . $item['id'] .')" >删除</a>';

                $return_data['rows'][] = array(
                    'id' => $item['id'],
                    'created_at' => $item['created_at'],
                    'alias' => empty($item['alias']) ? '空' : $item['alias'],
                    'server' => $item['server'],
                    'username' => $item['username'],
                    'server_port' => $item['server_port'],
                    'encrypt_method' => $encrypt_method,
                    'protocol' => $protocol,
                    'obfs' => $obfs,
                    'kcp_enable' => $item['kcp_enable'],
                    'switch_enable' => $item['switch_enable'],
                    'product_type' => $product_type,
                    'operating' => $operating,
                );

            }
        }

        return $return_data;

    }

    /**
     * 添加编辑页
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addIndex( $id,Request $request )
    {
        $data = [];
        $data['title'] = '添加服务器';

        if( $id > 0 ) {
            $data['title'] = '修改服务器';

            $server_obj = ServerList::find($id);

            if ( !$server_obj ) {
                return response()->json([ 'code' => 100001, 'message' => '未查询到该服务器信息' ]);
            }

            $data = $data +$server_obj->toArray();

        }

        $data['id'] = $id;

        $data['encrypt_method_data'] = encrypt_method();   #加密方式
        $data['protocol_data'] = protocol();   #传输协议
        $data['obfs_data'] = obfs();   #混淆插件
        // $data['product_type'] = product_type();   #混淆插件

        return view('admin/server/serverAdd', $data );

    }

    public function edit( Request $request )
    {
        $dt=$request->input('dt');
        $product_type=$request->input('product_type');
        $id = $dt['id'];

        $alias = $dt['alias'];
        $auth_enable = isset($dt['auth_enable'][0]) ? 1 : 0 ;   #一次验证
        $switch_enable = isset($dt['switch_enable'][0]) ? 1 :0;  #自动切换
        $server = $dt['server'];  #服务器地址
        $server_port = $dt['server_port'];  #服务器端口
        $local_port = $dt['local_port'];  #本地端口
        $timeout = $dt['timeout'];  #连接超时
        $password = $dt['password'];  #密码
        $encrypt_method = $dt['encrypt_method'];  #加密方式
        $protocol = $dt['protocol'];  #传输协议
        $obfs = $dt['obfs'];  #混淆插件
        $obfs_param = $dt['obfs_param']; #混淆参数
        $fast_open = isset($dt['fast_open'][0]) ? 1 :0;  #TCP快速打开
        $kcp_enable = isset($dt['kcp_enable'][0]) ? 1 :0;  #KcpTun 启用
        $kcp_port = $dt['kcp_port'];  #KcpTun 端口
        $kcp_password = $dt['kcp_password'];  #KcpTun 密码
        $kcp_param = $dt['kcp_param'];  #KcpTun 参数

        #验证参数
        if( empty($server) ) {
            return response()->json([ 'code' => 100001, 'message' => '请输入服务器地址' ]);
        }

        if( empty($server_port) ) {
            return response()->json([ 'code' => 100002, 'message' => '请输入服务器端口' ]);
        }

        if( empty($timeout) ) {
            return response()->json([ 'code' => 100003, 'message' => '请输入超时时间' ]);
        }

        if( empty($password) ) {
            return response()->json([ 'code' => 100004, 'message' => '请输入连接密码' ]);
        }

        if( is_array(encrypt_method($encrypt_method)) ) {
            return response()->json([ 'code' => 100006, 'message' => '请选择加密方式' ]);
        }

        if( is_array(protocol($protocol)) ) {
            return response()->json([ 'code' => 100007, 'message' => '请选择传输协议' ]);
        }

        if( is_array(obfs($obfs)) ) {
            return response()->json([ 'code' => 100008, 'message' => '请选择混淆插件' ]);
        }

        if( empty($local_port) ) {
            return response()->json([ 'code' => 100009, 'message' => '请输入本地端口' ]);
        }

        if ( $id == 0 ) {  #新增

            #查询是否已存在
          $res = ServerList::where('server',$server)->where('server_port',$server_port)->first();

          if ( $res ) {
              return response()->json([ 'code' => 100012, 'message' => $server . '下' . $server_port . '端口信息已存在请确认后再保存' ]);
          }

            $server_obj = new ServerList();

        } else {  #修改

            $server_obj = ServerList::find($id);
            if ( !$server_obj ) {
                return response()->json([ 'code' => 100010, 'message' => '未查询到该服务器信息' ]);
            }

            if( $server_obj->server != $server || $server_obj->server_port != $server_port ) {
                #查询是否已存在
                $res = ServerList::where('server',$server)->where('server_port',$server_port)->first();

                if ( $res ) {
                    return response()->json([ 'code' => 100013, 'message' => $server . '下' . $server_port . '端口信息已存在请确认后再保存' ]);
                }
            }

            $server_obj->username = '';

        }

        $server_obj->uuid = makeUuid();
        $server_obj->creator = userID();
        $server_obj->alias = $alias;
        $server_obj->auth_enable =$auth_enable;
        $server_obj->switch_enable = $switch_enable;
        $server_obj->server = $server;
        $server_obj->server_port = $server_port;
        $server_obj->local_port = $local_port;
        $server_obj->timeout = $timeout;
        $server_obj->password = $password;
        $server_obj->encrypt_method = $encrypt_method;
        $server_obj->protocol = $protocol;
        $server_obj->obfs = $obfs;
        $server_obj->obfs_param = $obfs_param;
        $server_obj->fast_open = $fast_open;
        $server_obj->kcp_enable = $kcp_enable;
        $server_obj->kcp_port = $kcp_port;
        $server_obj->kcp_password = $kcp_password;
        $server_obj->kcp_param = $kcp_param;
        $server_obj->product_type = $product_type;

        $server_obj->save();
        return response()->json([ 'code' => 200, 'message' => '保存成功' ]);

    }

     public function edit3( Request $request )
    {
         $dt=$request->input('dt');
        $product_type=$request->input('product_type');
        $id = $dt['id'];

        $server = $dt['server3'];
        $username = $dt['username'];   #一次验证
        $alias = $dt['alias'];   #一次验证
        $password = $dt['password'];  #自动切换

        #验证参数
        if( empty($server) ) {
            return response()->json([ 'code' => 100001, 'message' => '请输入服务器地址' ]);
        }

        if( empty($username) ) {
            return response()->json([ 'code' => 100002, 'message' => '请输入用户名' ]);
        }

        if( empty($password) ) {
            return response()->json([ 'code' => 100003, 'message' => '请输入密码' ]);
        }

        if ( $id == 0 ) {  #新增

                #查询是否已存在
              $res = ServerList::where('server',$server)->first();
              if ( $res ) {
                  return response()->json([ 'code' => 100012, 'message' => $server  . '服务器已存在请确认后再保存' ]);
              }

                $server_obj = new ServerList();

        } else {  #修改

            $server_obj = ServerList::find($id);
            if ( !$server_obj ) {
                return response()->json([ 'code' => 100010, 'message' => '未查询到该服务器信息' ]);
            }
             $server_obj->auth_enable = 0;
             $server_obj->switch_enable = 0;
             $server_obj->server_port = '';
             $server_obj->local_port = '';
             $server_obj->timeout = '';
             $server_obj->encrypt_method = '';
             $server_obj->protocol = '';
             $server_obj->obfs = '';
             $server_obj->obfs_param = '';
             $server_obj->fast_open = 0;
             $server_obj->kcp_enable = 0;
             $server_obj->kcp_port = '';
             $server_obj->fast_open = '';
             $server_obj->kcp_param = '';
        }

        $server_obj->uuid = makeUuid();
        $server_obj->creator = userID();
        $server_obj->server = $server;
        $server_obj->username = $username;
        $server_obj->alias = $alias;
        $server_obj->password = $password;
        $server_obj->product_type = $product_type;

        $server_obj->save();
        return response()->json([ 'code' => 200, 'message' => '保存成功' ]);

    }

    public function delete( $id ) {
        $server_obj = ServerList::find($id);
        $set_user_server=DB::table('set_user_server')->where('sid',$id)->delete();
        $set_server=DB::table('set_server')->where('sid',$id)->orwhere('sid',0)->delete();

        if ( !$server_obj ) {
            return response()->json([ 'code' => 200 , 'message' => '删除成功' ]);
        }

        $server_obj->delete();

        return response()->json([ 'code' => 200 , 'message' => '删除成功' ]);

    }
}
