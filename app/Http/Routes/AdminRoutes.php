<?php
/**
 * 后台路由控制器
 */
namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class AdminRoutes
{
    public function map( Registrar $router )
    {
        //路由重定向到登录页面
        $router->get('/', function (){
            return redirect('mf/login');
        });

        $router->get('mf/login','Admin\LoginController@login' );   #进入登录界面
        $router->get('mf/login/do','Admin\LoginController@loginDo' );  #登录验证
        $router->post('mf/setting','Admin\LoginController@set' );  #修改密码
        

        $router->group(['middleware' => 'admin.server'], function( $router ) {
            // 加载超级管理员主页
            $router->get('mf','Admin\AdminController@main');
            // 加载普通管理员主页
            $router->get('usermf','Admin\AdminController@usermain');

            $router->get('mf/logout','Admin\LoginController@logout' );  #退出登录

            #路由器管理
            $this->routerManagement($router);



        });

    }

    /**
     * 路由器管理
     * @param $router
     */
    public function routerManagement( $router )
    {
        #接口文档

        #路由器
        $router->get('mf/router/index','Admin\Router\RouteController@index');
        $router->get('mf/router/search','Admin\Router\RouteController@search');
        $router->post('mf/router/config','Admin\Router\RouteController@config'); #改变接收状态
        $router->post('mf/router/change','Admin\Router\RouteController@change'); #审核未审核
        $router->post('mf/router/del','Admin\Router\RouteController@del'); #删除
        $router->post('mf/router/edit','Admin\Router\RouteController@edit'); 
        $router->post('/mf/router/product_type','Admin\Router\RouteController@product_type');
        #新增修改
        $router->get('mf/router/get/{mac_id}','Admin\Router\RouteController@getMac'); 
         #根据mac_id设置对应的服务器之显示所有的服务器列表
        $router->get('mf/router/showSetServer/{mac_id}/{product_type}','Admin\Router\RouteController@showSetServer');
        #根据mac_id设置对应的服务器
        $router->get('mf/router/setServer/{product_type}','Admin\Router\RouteController@setServer');
        #根据mac_id和已经选择服务器的ID设置对应的服务器
        $router->post('mf/router/doSetServer','Admin\Router\RouteController@doSetServer');
        // 根据mac_id去全局设置
         $router->get('mf/router/globalSetting/page/{mac_id}/{product_type}','Admin\Router\RouteController@globalSetting');
         // 全局设置提交
         $router->post('mf/router/doGlobalSetting','Admin\Router\RouteController@doGlobalSetting');
         // wifi设置提交
         $router->post('mf/router/doSetWifi','Admin\Router\RouteController@doSetWifi');
         // wifi设置信息显示
         $router->get('mf/router/getWifi/{mac_id}','Admin\Router\RouteController@getWifi');
        #根据mac_id 获取一条信息

        #ssr服务器
        $router->get('mf/server/index','Admin\Server\ServerListController@index');
        $router->get('mf/server/search','Admin\Server\ServerListController@search');
        $router->get('mf/server/add/page/{id}','Admin\Server\ServerListController@addIndex');  #编辑页
        $router->post('mf/server/edit','Admin\Server\ServerListController@edit');  #保存
        $router->post('mf/server/edit3','Admin\Server\ServerListController@edit3');  #保存
        $router->get('mf/server/delete/{id}','Admin\Server\ServerListController@delete');  #删除

        // 接口日志
        $router->get('/mf/interface/index','Admin\InterfaceLog\InterfaceLogController@index');
        $router->get('/mf/interface/search','Admin\InterfaceLog\InterfaceLogController@search');
        $router->get('/mf/interface/searchOne/{mac}','Admin\InterfaceLog\InterfaceLogController@searchOne');
        $router->get('/mf/interface/searchOneData','Admin\InterfaceLog\InterfaceLogController@searchOneData');
        $router->get('/mf/interface/get/{id}','Admin\InterfaceLog\InterfaceLogController@getLog');
        $router->post('/mf/interface/edit','Admin\InterfaceLog\InterfaceLogController@edit');
        $router->post('/mf/interface/del','Admin\InterfaceLog\InterfaceLogController@del');

        // 用户管理
        $router->get('/mf/user/index','Admin\User\UserController@index');
        $router->get('/mf/user/search','Admin\User\UserController@search');
        $router->post('mf/user/change','Admin\User\UserController@change'); #禁用启用
        $router->post('mf/user/del','Admin\User\UserController@del'); #删除
        $router->post('mf/user/edit','Admin\User\UserController@edit'); 
        $router->get('mf/user/get/{id}','Admin\User\UserController@getUser'); 
        $router->post('mf/user/add','Admin\User\UserController@add'); 
        $router->get('mf/user/showSetRouter/{id}','Admin\User\UserController@showSetRouter'); 
        $router->get('mf/user/showSetServer/{id}','Admin\User\UserController@showSetServer');
        $router->get('mf/user/setRouter','Admin\User\UserController@setRouter');
        $router->get('mf/user/aa','Admin\User\UserController@aa');
        $router->get('mf/user/setServer','Admin\User\UserController@setServer');
        $router->post('mf/user/doSetServer','Admin\User\UserController@doSetServer');
        $router->post('mf/user/doSetRouter','Admin\User\UserController@doSetRouter');

      






    }

}