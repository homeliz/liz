<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis as Redis;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;

use App\Http\Models\Admin\User\UserMaster; #用户主表
use App\Http\Models\Admin\User\UserOps; #登录记录表

class LoginController extends Controller
{

    /**
     * 登录页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login( Request $request )
    {
        $redirect_url = $request->input('redirect_url');
        if ( empty($redirect_url) ) {
            $redirect_url = '/mf';
        }

        Redis::setex('MF_G_LOGIN_REDIRECT', 1800, $redirect_url);
       $a= Redis::get('MF_G_LOGIN_REDIRECT');
      // error_log(var_except($a,true));

        return view('admin/login_2');
    }

    /**
     *登录验证
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginDo( Request $request )
    {
        $useName = $request->input('login_name');   #用户名
        $password = $request->input('password');     #密码
        $yzm = $request->input('yzm');      #验证码
        #验证信息
        if( empty($useName) ) {
            return response()->json([ 'code' => 100001, 'message' => '请输入用户名' ]);
        }

        if ( empty($password) ) {
            return response()->json([ 'code' => 100002, 'message' => '请输入密码' ]);
        }

/*        if ( empty($yzm) ) {
            return response()->json([ 'code' => 100003, 'message' => '请输入验证码' ]);
        }

        #获取验证码
        $yzm_data = Redis::get('laravel_yzm'.session()->getId());
        if ($yzm_data != $yzm ) {
            return response()->json([ 'code' => 100004, 'message' => '验证码不正确']);
        }*/

        #验证用户名是否存在
        $user_data = UserMaster::where('userName',$useName)
            ->orWhere('phone', $useName)
            ->first();

        if ( !$user_data ) {
            return response()->json([ 'code' => 100005, 'message' => '用户名不存在' ]);
        }

        #用户状态
        if( $user_data->useFlag == 0 ) {
            return response()->json([ 'code' => 100006, 'message' => '您已被禁用,请联系管理员' ]);
        }

         // 查询是否过期
        if($user_data->permissions==2){
            $expire_date=$user_data->expire_date;
            $expire_date_time=strtotime($expire_date);
            $time=time();
            if($time>=$expire_date_time){
                return response()->json([ 'code' => 100008, 'message' => '您的账号已过期' ]);
               
            }
        }
        #验证密码是否正确
        if (!Hash::check($password, $user_data->password)) {
            return response()->json([ 'code' => 100007, 'message' => '密码错误请重新输入' ]);
        }

        // 将用户状态保存在session、
        session(['permissions'=>$user_data->permissions]);
        session(['userid'=>$user_data->id]);

        //将用户登录信息加入到redis
        $session_id = session()->getId();

        Redis::setex('MF_ADMIN_USER_ID' . $session_id, 86400, $user_data->userName);
        $redirect_url = '/mf';
        

        //添加登录日志
        $user_login = new UserOps;
        $user_login->user_name = $useName;
        $user_login->ip = ip2long($request->ip());
        $user_login->op = 1;
        $user_login->extend_json = json_encode([
            'redirect_url' => $redirect_url,
            'session_id' => $session_id
        ]);
        $user_login->save();
        return response()->json(array(
            'code' => 200,
            'message' => '登录成功',
            'data' => [
                'redirect_url' => $redirect_url
            ]
        ));

    }

    public function logout( Request $request )
    {
        $session_id = session()->getId();

        $user_name = Redis::get('MF_ADMIN_USER_ID' . $session_id);   // 获取当前用户名

        $redirect_url = $request->input('redirect_url');

        if ($user_name) {
            //添加退出日志
            $user_login = new UserOps;
            $user_login->user_name = $user_name;
            $user_login->ip = ip2long($request->ip());
            $user_login->op = 2;
            $user_login->extend_json = json_encode([
                'redirect_url' => $redirect_url,
                'session_id' => $session_id
            ]);
            $user_login->save();
        }

        Redis::del('MF_ADMIN_USER_ID' . session()->getId());

        return redirect('mf/login');
        // return redirect('mf/login?redirect_url='.urlencode($redirect_url));

    }

    // 个人设置
    public function set(Request $request)
    {

        $params=$request->input();

        $session_id = session()->getId();

        $user_name = Redis::get('MF_ADMIN_USER_ID' . $session_id);   // 获取当前用户名
        // 根据redis中保存的username查询信息
        $user_data = UserMaster::where('userName',$user_name)
            ->first();
        // 判断原密码是否一致
        if(!Hash::check($params['oldpwd'], $user_data['password'])){
            return response()->json([ 'code' => 100007, 'message' => '密码错误请重新输入' ]);
        }
        // 判断新密码是否一致
        if($params['newpwd']!==$params['renewpwd']){
            return response()->json([ 'code' => 100008, 'message' => '两次密码不一致请重新输入' ]);
        }else{
            $user_data->password=Hash::make($params['newpwd']);
        }
        $user_data->userName=$params['userName'];
        $user_data->save();
        if($user_data){
            return response()->json([ 'code' => 200, 'message' => '设置成功' ]);

        }
        
    }



}
