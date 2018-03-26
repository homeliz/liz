<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Models\Admin\Router\ConfigMaster;#配置表
use App\Http\Models\Admin\Router\MacLog; #日志表
use App\Http\Models\Admin\Router\RouterMac;
use App\Http\Models\Admin\Router\GlobalSetting;
use App\Http\Models\Admin\Router\Wan;
use App\Http\Models\Admin\Router\Lan;
use App\Http\Models\Admin\Router\InterfaceLog;
use App\Http\Models\Admin\Router\SetWifi;
use App\Http\Models\Admin\Server\SetServer;
use App\Http\Models\Admin\Server\ServerList;
use DB;
class ApiWorkController extends Controller
{
    public function index( Request $request ) {
          #获取客户端ip地址信息
        $ip = $request->ip();
        $mac = $request->input('mac');
        $ssid = $request->input('ssid');
        $net = $request->input('net');
        $count = $request->input('count');
        $sign = $request->input('sign');
        $first = $request->input('first');
        $ipsec = $request->input('ipsec');
        $proxy = $request->input('proxy');

       #添加接口日志
        $interface_data = [];
        $interface_data['user_ip'] = $ip;
        $interface_data['mac'] = $mac;
        $interface_data['ssid'] = $ssid;
        $interface_data['net'] = $net;
        $interface_data['count'] = $count;
        $interface_data['visit_time'] = Carbon::now();
        #验证参数
        if ( empty($mac) || empty($ssid) ) {
            return response()->json([ 'code' => 100001, 'message' => 'MAC地址或SSID不能为空' ]);
        }

        if ($sign !== md5( $mac.$ssid.'kytess74521459h'.$first.$count))
        {
            return response()->json([ 'code' => 100004, 'message' => '请填入合法数据' ]);
        }
        // 添加interface_log日志
        addInterfaceLog($interface_data);

        #查看配置信息
        $config = ConfigMaster::find(1);

        if( !$config ) {
            return response()->json([ 'code' => 100002, 'message' => '未读取到配置信息请联系管理员' ]);
        }

        $useFlag = $config->useFlag;

        #查询MAC是否已存在
        $mac_obj = RouterMac::where('mac',$mac)->first();
        #添加日志
        $log_data = [];
        $log_data['ip'] = $ip;
        $log_data['mac'] = $mac;
        $log_data['ssid'] = $ssid;

        if( $useFlag == 1 ) {   #路由器接收开启状态
          return $this->getinfo($mac_obj,$ssid,$mac,$log_data,$useFlag,$first,$ipsec,$proxy);
          

        } else {   #返回固定信息
          return $this->getinfo($mac_obj,$ssid,$mac,$log_data,$useFlag,$first,$ipsec,$proxy);
        }

    }


    public function getinfo($mac_obj,$ssid,$mac,$log_data,$useFlag,$first,$ipsec,$proxy){
      // 查询
           if ( $mac_obj ) {
              // 传过来的路由存在
               if ($mac_obj->useFlag == 0 ) {
                   return response()->json([ 'code' => 100003, 'message' => '当前MAC未审核,请联系管理员' ]);
               }

               if( $mac_obj->expire_date < Carbon::now() ) {
                   return response()->json([ 'code' => 100007, 'message' => 'MAC已过期,请联系管理员' ]);
               }

                if ( $mac_obj->ipsec != $ipsec) {
                   $mac_obj->ipsec = $ipsec;
                   $mac_obj->registration_time = $mac_obj['registration_time'];
                   $mac_obj->save();

                   $msg = '修改成功';

               }
                if ( $mac_obj->proxy != $proxy) {
                   $mac_obj->proxy = $proxy;
                   $mac_obj->registration_time = $mac_obj['registration_time'];
                   $mac_obj->save();

                   $msg = '修改成功';

               }

               if ( $mac_obj->ssid != $ssid) {
                   $mac_obj->ssid = $ssid;
                   $mac_obj->registration_time = $mac_obj['registration_time'];
                   $mac_obj->save();

                   $msg = '修改成功';

                   $log_data['content'] = array('内容' => '修改MAC信息');
                   addLog($log_data);
               }
               

                $wifi_info=SetWifi::where('rid',$mac_obj['mac_id'])->select(['ssid','key','encryption','needset'])->first();
                if($mac_obj->product_type==0){
                     return response()->json([ 'code' => 200, 'product_type'=>0]);

                }
                // 查询此MAC下是否设置服务器
              $set_server=DB::table('server_list')
                          ->join('set_server','server_list.id', '=' ,'set_server.sid')
                          ->where('set_server.rid',$mac_obj['mac_id'])
                          ->where('server_list.product_type',$mac_obj->product_type)
                          ->get();
              $set_serverd=[];

              if($set_server){
                 if($mac_obj->product_type==3){
                  // 查询该路由绑定的服务器列表（product_type=3）的信息值
                    $ikev_info=[];
                     foreach ($set_server as $key => $value) {
                        $ikev_info1['name']=$value->username;
                        $ikev_info1['auth']=$value->password;
                        $ikev_info1['ip']=$value->server;
                        $ikev_info[]=$ikev_info1;
                      }
                      if($first==1){
                        if(!empty($wifi_info)){
                          // 改变needset的值为0
                          
                          $wifi_info['needset']=1;
                          SetWifi::where('rid',$mac_obj['mac_id'])->update(['needset'=>0]);
                          return response()->json([ 'code' => 200, 'message' => '信息获取成功','data'=>array('ikev_info'=>$ikev_info[0],'wifi_info'=>$wifi_info),'product_type'=>$mac_obj->product_type] );
                          
                        }else{
                           $wifi_info['needset']=0;
                          return response()->json([ 'code' => 200, 'message' => '信息获取成功','data'=>array('ikev_info'=>$ikev_info[0],'wifi_info'=>$wifi_info),'product_type'=>$mac_obj->product_type] );

                        }
                      }else{
                        // 查询后台needset信息
                        if($wifi_info['needset']==1){
                          // 改变needset的值为0
                          SetWifi::where('rid',$mac_obj['mac_id'])->update(['needset'=>0]);
                          $wifi_info['encryption']=encryption($wifi_info['encryption']);
                          return response()->json([ 'code' => 200, 'message' => '信息获取成功','data'=>array('ikev_info'=>$ikev_info[0],'wifi_info'=>$wifi_info),'product_type'=>$mac_obj->product_type] );

                        }else{
                          $wifi_info_first['needset']=0;
                          return response()->json([ 'code' => 200, 'message' => '信息获取成功','data'=>array('ikev_info'=>$ikev_info[0],'wifi_info'=>$wifi_info_first),'product_type'=>$mac_obj->product_type] );

                        }
                      }
                  }else{
                  foreach ($set_server as $v) {
                    foreach ($v as $key => $value) {
                      if($key=='created_at' || $key=='updated_at' || $key=='sid'){
                        unset($v->$key);
                      }
                      if($key=='password'){
                       $v->password=mdpassword($v->password);
                      }
                      if($key=='encrypt_method'){
                        $v->encrypt_method=encrypt_method($value);
                       
                      }
                      if($key=='protocol'){
                        $v->protocol=protocol($value);
                      }
                      if($key=='obfs'){
                        $v->obfs=obfs($value);
                      }
                    }
                  }
                }
                 // 如果全部信息都通过，则查询此路由下全局设置信息是否存在（$mac_id）
                $info=DB::table('global_setting')
                ->join('wan', 'global_setting.id', '=', 'wan.global_id')
                ->join('lan', 'global_setting.id', '=', 'lan.global_id')
                ->where('global_setting.mac_id','=',$mac_obj['mac_id'])
                ->where('global_setting.product_type','=',$mac_obj['product_type'])
                ->first();
                if(!$info){

                    return response()->json([ 'code' => 100009, 'message' => '此MAC未进行全局设置' ]);

                }else{

                  foreach ($info as $key => $value) {
                    if($key=='created_at' || $key=='updated_at' || $key == 'id'){
                      unset($info->$key);
                    }
                  }
                  if($first==1){
                    if(!empty($wifi_info)){
                      // 改变needset的值为0
                      
                      $wifi_info['needset']=1;
                      SetWifi::where('rid',$mac_obj['mac_id'])->update(['needset'=>0]);
                      return response()->json([ 'code' => 200, 'message' => '信息获取成功','data'=>array('server_info'=>$set_server,'global_info'=>$info,'wifi_info'=>$wifi_info),'product_type'=>$mac_obj->product_type]);
                      
                    }else{
                       $wifi_info['needset']=0;
                      return response()->json([ 'code' => 200, 'message' => '信息获取成功','data'=>array('server_info'=>$set_server,'global_info'=>$info,'wifi_info'=>$wifi_info),'product_type'=>$mac_obj->product_type]);

                    }
                  }else{
                    // 查询后台needset信息
                    if($wifi_info['needset']==1){
                      // 改变needset的值为0
                      SetWifi::where('rid',$mac_obj['mac_id'])->update(['needset'=>0]);
                     $wifi_info['encryption']=encryption($wifi_info['encryption']);
                      return response()->json([ 'code' => 200, 'message' => '信息获取成功','data'=>array('server_info'=>$set_server,'global_info'=>$info,'wifi_info'=>$wifi_info),'product_type'=>$mac_obj->product_type] );

                    }else{
                      $wifi_info_first['needset']=0;
                      return response()->json([ 'code' => 200, 'message' => '信息获取成功','data'=>array('server_info'=>$set_server,'global_info'=>$info,'wifi_info'=>$wifi_info_first),'product_type'=>$mac_obj->product_type]);

                    }
                  }
                }
              }else{

                return response()->json([ 'code' => 1000010, 'message' => '此MAC未设置服务器' ]);
                
              }

           }else{
            if($useFlag==1){
              return $this->on($mac,$ssid,$log_data,$ipsec,$proxy);
            }else{
              return response()->json([ 'code' => 100008, 'message' => '请联系管理员开启路由' ]);

            }
           }
    }

    public function on($mac,$ssid,$log_data,$ipsec,$proxy){
         // 传过来的路由不存在，则保存
               $mac_obj = new RouterMac();
               $mac_obj->uuid = makeUuid();
               $mac_obj->mac = $mac;
               $mac_obj->ssid = $ssid;
               $mac_obj->registration_time = Carbon::now();
               $mac_obj->ipsec = 0; #未连接
               $mac_obj->proxy = 0; #未连接
               $mac_obj->useFlag = 0; #未审核
               $mac_obj->save();

               $msg = '添加成功,等待管理员审核';
               $log_data['content'] = array('内容' => '添加MAC信息');
               addLog($log_data);
              
              return response()->json([ 'code' => 200 , 'message' => $msg ]);
    }

}
