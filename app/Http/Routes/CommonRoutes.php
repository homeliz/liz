<?php
/**
 * 后台路由控制器
 */
namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class CommonRoutes
{
    public function map( Registrar $router )
    {

        $router->get('captcha','Admin\Common\CaptchaController@index' );  #验证码

        $router->any('upload','Admin\Common\UploadController@upload');#上传文件

        $router->get('dd/common/download','Admin\Common\DownloadController@download'); #点击下载

        #选择
        $router->get('dd/common/download','Admin\Common\DownloadController@download'); #点击下载



    }
}