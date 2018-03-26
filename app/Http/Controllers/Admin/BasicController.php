<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis as Redis;
use Illuminate\support\facades\route;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use DB;
use Redirect;

use App\Http\Models\Admin\User\UserMaster; #用户主表
use App\Http\Models\Admin\User\UserOps; #登录记录表

class BasicController extends Controller
{

    /**
     * 登录页
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __construct()
    {
        $session_id = session()->getId();

        $user_name = Redis::get('MF_ADMIN_USER_ID' . $session_id);   // 获取当前用户名

        // 根据当前用户名查询有效时间
        $date=DB::table('user_master')->select('expire_date','permissions')->where('userName',$user_name)->first();
        // $a=Route::currentRouteName();
        // $a=\Request::route()->getName();
        // $a=  \Request::getRequestUri();
             // $a=url()->current();
        // DB::table('luyou')->insert(['luyou'=>$a]);
        if($date->permissions==2){
            
            $expire_date=$date->expire_date;
            $expire_date_time=strtotime($expire_date);
            $time=time();
            if($time>=$expire_date_time){
                Redirect::to('/mf/login')->send();

            }else{
                // 权限判断
                $path= explode('/',  url()->current());
                unset($path[0]);
                unset($path[1]);
                unset($path[2]);
                $path=implode('/',$path );
               
                
            }
        }
   
    }

   

}
