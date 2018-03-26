<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use DB;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Models\Admin\User\UserMaster;
use App\Http\Models\Admin\User\SetUserRouter;
use App\Http\Models\Admin\User\SetUserServer;
use App\Http\Models\Admin\Router\RouterMac;
use App\Http\Models\Admin\Server\ServerList;




class UserController extends \App\Http\Controllers\Admin\BasicController
{   
    public function __construct(){
        parent::__construct();
        
    }

    public function userIndex()
    {
        return '开发中......';
    }


    public function Index()
    {
        return  view('admin/user/userList');
    }

    public function search( Request $request )
    {
        $where = [];

        if ( $permissions=$request->input('permissions_select') ) {
        	if($permissions=='超级管理员'){

            	$where[] = ['permissions', 1 ];
        	}else{
            	$where[] = ['permissions', 2];

        	}
        }
          
        $mac_obj = UserMaster::where($where)
            ->orderBy($request->input('sort'), $request->input('order'))
            ->paginate($request->input('limit'))
            ->toArray();
        //返回数组
        $return_data = array(
            'total' => $mac_obj['total'],
            'rows' => array()
        );


        if ( $mac_obj['data'] ) {

            foreach ( $mac_obj['data'] as $item ) {
                $operating = '';

                $operating .= '<a class="btn btn-success btn-xs btns" href="javascript: void(0);" onclick="user.edit(' . $item['id'] .')" >修改</a>';
                $operating .= '<a class="btn btn-warning btn-xs btns" href="javascript: void(0);" onclick="user.delOne(' . $item['id'] .')" >删除</a>';

                if ( $item['useFlag'] == 0 ) {
                    $useFlag = '<a  href="javascript: void(0);" onclick="user.change(' . $item['id'] .', 1,\''.$item['userName'].'\')" >未启用</a>';
                } elseif( $item['useFlag'] == 1 ) {
                    $useFlag = '<a  href="javascript: void(0);" onclick="user.change(' . $item['id'] .', 0,\''.$item['userName'].'\')" >已启用</a>';
                }
                if($item['permissions']==1){
                	$permissions='超级管理员';
                }else{
                	$permissions='普通管理员';
                	$operating .= '<a class="btn btn-warning btn-xs btns" href="javascript: void(0);" onclick="user.showSetRouter(' . $item['id'] .')" >设置路由</a>';
                	$operating .= '<a class="btn btn-warning btn-xs btns" href="javascript: void(0);" onclick="user.showSetServer(' . $item['id'] .')" >设置服务器</a>';

                }
               
                $return_data['rows'][] = array(
                    'id' => $item['id'],
                    'creator' => $item['creator'],
                    'username' => $item['userName'],
                    'created_at' => $item['created_at'],
                    'expire_date' => $item['expire_date'],
                    'permissions' => $permissions,
                    'useFlag' => $useFlag,
                    'operating' => $operating,
                );

            }

        }

        return $return_data;

    }


     /**
     * 审核撤销审核
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function change( Request $request )
    {

        $mag = '启用成功';
        $mac_id = $request->input('id');
        $useFlag = $request->input('useFlag');

        if ( empty($mac_id) ) {
            return response()->json([ 'code' => 100001, 'message' => '缺少参数:id' ]);
        }

        if ( is_array( $mac_id ) ) {

            #循环判断
            foreach ( $mac_id as $id ) {

                #验证mac_id
                $mac_obj = UserMaster::find($id);

                if ( !$mac_obj ) {
                    continue;
                }

                if( $mac_obj->useFlag == 1 ) {
                    continue;
                }

                $mac_obj->creator = userID();
                $mac_obj->useFlag = 1;
                $mac_obj->save();

            }

        } else {

            if ( $useFlag == null || !in_array( $useFlag, array( '0', '1' ) ) ) {
                return response()->json([ 'code' => 100002, 'message' => '缺少参数:useFlag' ]);
            }

            #验证mac_id
            $mac_obj = UserMaster::find($mac_id);
            if ( !$mac_obj ) {
                return response()->json([ 'code' => 100003, 'message' => '未查询到用户信息' ]);
            }


            if( $useFlag == 0 ) {
                $mag = '禁用成功';
            }


            if( $useFlag == 1 ) {
                $mag = '启用成功';

            } 

            $mac_obj->creator = userID();
            $mac_obj->useFlag = $useFlag;
            $mac_obj->save();

        }

        return response()->json([ 'code' => 200, 'message' => $mag ]);

    }

     public function del( Request $request )
    {
        $del_data = $request->input('del_data');
        if ( count($del_data) == 0 ) {
            return response()->json([ 'code' => 100001, 'message' => '请选择要删除的用户' ]);
        }
        foreach ( $del_data as $mac_id ) {
           $mac_obj = UserMaster::find($mac_id);
           if ( $mac_obj ) {
                // 查询此用户是否绑定路由
                // $server=SetServer::where('rid',$mac_id)->get();
           		DB::table('set_user_router')->where('uid', $mac_id)->delete();
           		DB::table('set_user_server')->where('uid', $mac_id)->delete();
                // if(!empty($server)){
                //     // 查询此MAC有设置过服务器
                //     $del_set_server=SetServer::where('rid',$mac_id)->delete();
                //     // 查询此mac下是否全局设置过
                //     $global_id=GlobalSetting::where('mac_id',$mac_id)->first(['id']);
                //     if(!empty($global_id)){
                        
                //         // 如果在此路由下不设置任何的服务器，则之前在此路由下已设置过的全局设置相关信息也删除
                //         GlobalSetting::where('mac_id',$mac_id)->delete();
                //         Wan::where('global_id',$global_id['id'])->delete();
                //         Lan::where('global_id',$global_id['id'])->delete();
                //     }
                // }
             
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
    public function getUser( $id )
    {

        $mac_obj = UserMaster::find($id);
        if (!$mac_obj) {
            return response()->json(['code' => 100001, 'message' => '未查到该MAC信息']);
        }

        return response()->json(['code' => 200, 'message' => 'ok', 'data' => $mac_obj]);

    }


    public function edit( Request $request )
    {
        $dt = $request->input();
        $keys=array_keys($dt);
        if(in_array('expire_date',$keys)){
	        // 得到当前时间戳
	        $day1=time();
	        // 得到数据库到期时间戳
	        $day2=$request->input('expire_date');
	        $day2=strtotime($day2);
	        if(($day2-$day1)<=0){
	            return response()->json([ 'code' => 100005, 'message' => '请填写正确的到期时间' ]);
	        }

        }else{
        	$dt['expire_date']=Null;
        }

        if ( empty($dt['id']) ) {
            return response()->json([ 'code' => 100001, 'message' => '缺少参数:id' ]);
        }

        if ( empty($dt['userName']) ) {
            return response()->json([ 'code' => 100002, 'message' => '请输入用户名' ]);
        }

        if ( empty($dt['password']) ) {
            return response()->json([ 'code' => 100003, 'message' => '请输入密码' ]);
        }
        if($dt['permissions']==2){

	        if ( empty($dt['expire_date']) ) {
	            return response()->json([ 'code' => 100005, 'message' => '请选择到期时间' ]);
	        }
        }


        $mac_obj = UserMaster::find($dt['id']);
        $user_obj = UserMaster::where('userName','!=',$dt['userName'])->get()->pluck('userName')->toArray();
        if (!$mac_obj) {
            return response()->json(['code' => 100006, 'message' => '未查到该MAC信息']);
        }
        if(in_array($dt['userName'], $user_obj)){
            return response()->json(['code' => 100007, 'message' => '该用户名已存在']);

        }

        $mac_obj->creator = userID();
        $mac_obj->userName = $dt['userName'];
        $mac_obj->password = Hash::make($dt['password']);
        $mac_obj->expire_date = $dt['expire_date'];
        $mac_obj->permissions = $dt['permissions'];

        $mac_obj->save();
        return response()->json([ 'code' => 200, 'message' => '修改成功' ]);

    }
    
    public function add( Request $request )
    {
        $dt = $request->input();
        $keys=array_keys($dt);
        if(in_array('expire_date',$keys)){
	        // 得到当前时间戳
	        $day1=time();
	        // 得到数据库到期时间戳
	        $day2=$request->input('expire_date');
	        $day2=strtotime($day2);
	        if(($day2-$day1)<=0){
	            return response()->json([ 'code' => 100005, 'message' => '请填写正确的到期时间' ]);
	        }

        }else{
        	$dt['expire_date']=Null;
        }


        if ( empty($dt['userName']) ) {
            return response()->json([ 'code' => 100002, 'message' => '请输入用户名' ]);
        }

        if ( empty($dt['password']) ) {
            return response()->json([ 'code' => 100003, 'message' => '请输入密码' ]);
        }
        if($dt['permissions']==2){

	        if ( empty($dt['expire_date']) ) {
	            return response()->json([ 'code' => 100005, 'message' => '请选择到期时间' ]);
	        }
        }


        $mac_obj = UserMaster::where('userName',$dt['userName'])->first();
        $user_obj = new UserMaster;
        if ($mac_obj) {
            return response()->json(['code' => 100007, 'message' => '该用户名已存在']);

        }else{
	        $user_obj->creator = userID();
	        $user_obj->userName = $dt['userName'];
	        $user_obj->password = Hash::make($dt['password']);
	        $user_obj->expire_date = $dt['expire_date'];
	        $user_obj->permissions = $dt['permissions'];

	        $user_obj->save();
	        return response()->json([ 'code' => 200, 'message' => '添加成功' ]);

        }
       

    }

    /**
     * 设置路由  加载展示所有路由信息列表的页面
     * @param  $mac_id [路由列表的id]
     */
    public function showSetRouter($id)
    {   
        // 接收传过来的路由器ID
        $data['uid']=$id;
        // 查询服务器的ID
        $sids = DB::table('router_mac')->select('mac_id')->get();
        $data['sids']=json_encode($sids);
        return view('admin/user/showSetRouter',$data);
    }
     /**
     * 设置路由  加载展示所有路由信息列表的页面
     * @param  $mac_id [路由列表的id]
     */
    public function showSetServer($id)
    {   
        // 接收传过来的路由器ID
        $data['mac_id']=$id;
        // 查询服务器的ID
        $sids = DB::table('server_list')->select('id')->get();
        $data['sids']=json_encode($sids);
        return view('admin/user/showSetServer',$data);
    }

    /**
     * 设置路由  加载展示所有路由信息列表的页面
     * @param  $mac_id [路由列表的id]
     */
 
    public function aa(Request $request){
        // var_dump( $request->input());
    	 $pageIndex = $request->input('page', 1);     //分页 当前页面
        $pageSize = $request->input('limit', 10);   //取条数

        $where = [];

        // 如果根据IP搜索
        if ( $request->input('mac') ) {
            $where[] = [ 'mac', $request->input('mac') ];
        }
        
        // 如果根据别名搜索
        if ( $request->input('ssid') ) {
            $where[] = [ 'ssid', $request->input('ssid') ];
        }
        // 查询服务器信息
        $server_data = RouterMac::where($where)
            ->orderBy($request->input('sort'), $request->input('order'))
            ->paginate($pageSize)
            ->toArray();
        // 查询set_server表
        $set_server=DB::table('set_user_router')->select('rid')->where('uid', $request->input('uid'))->orderBy('rid','desc')->pluck('rid');
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
                    'mac_id' => $item['mac_id'],
                    'mac' => $item['mac'],
                    'ssid' => $item['ssid'],
                    'expire_date' => $item['expire_date'],
                    'useFlag' => $item['useFlag'],
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
    public function doSetRouter(Request $request)
    {
        $uid=$request->input('mac_id');
        $select_sid=$request->input('select_sid');
        // 删除所有mac_id关联的所有服务器
        $del_info=DB::table('set_user_router')->where('uid', $uid)->delete();
        // 重新插入关联的服务器
        if(!empty($select_sid)){
            foreach ($select_sid as $v) {
                if(!empty($v)){

                    DB::table('set_user_router')->insert(['uid' => $uid, 'rid' => $v]);
                }
            }
        }else{
            // 如果在此路由下不设置任何的服务器，则之前在此路由下已设置过的全局设置相关信息也删除
            // $global_id=GlobalSetting::where('mac_id',$mac_id)->first(['id']);
            // GlobalSetting::where('mac_id',$mac_id)->delete();
            // $wan=Wan::where('global_id',$global_id['id'])->delete();
            // Lan::where('global_id',$global_id['id'])->delete();
        }
        return response()->json([ 'code' => 200, 'message' => '设置成功' ]);
        
    }

    /**
     * 设置服务器  加载展示所有服务器信息列表的页面
     * @param  $mac_id [路由列表的id]
     */
    public function setServer(Request $request)
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
        $server_data = ServerList::where($where)
            ->orderBy($request->input('sort'), $request->input('order'))
            ->paginate($pageSize)
            ->toArray();
        // 查询set_server表
        $set_server=DB::table('set_user_server')->select('sid')->where('uid', $request->input('rid'))->pluck('sid');
        // return $set_server;
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
        $uid=$request->input('mac_id');
        $select_sid=$request->input('select_sid');
        // return $select_sid;
        // return $uid;
        // 删除所有mac_id关联的所有服务器
        $del_info=DB::table('set_user_server')->where('uid', $uid)->delete();
        // 重新插入关联的服务器
        if(!empty($select_sid)){
            foreach ($select_sid as $v) {
                if(!empty($v)){

                    DB::table('set_user_server')->insert(['uid' => $uid, 'sid' => $v]);
                }
            }
        }else{
            // 如果在此路由下不设置任何的服务器，则之前在此路由下已设置过的全局设置相关信息也删除
            // $global_id=GlobalSetting::where('mac_id',$mac_id)->first(['id']);
            // GlobalSetting::where('mac_id',$mac_id)->delete();
            // $wan=Wan::where('global_id',$global_id['id'])->delete();
            // Lan::where('global_id',$global_id['id'])->delete();
        }
        return response()->json([ 'code' => 200, 'message' => '设置成功' ]);
        
    }


}
