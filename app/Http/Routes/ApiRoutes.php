<?php
/**
 * api  接口
 */

namespace App\Http\Routes;

use Illuminate\Contracts\Routing\Registrar;

class ApiRoutes
{
    public function map( Registrar $router )
    {

        $router->any('api/mac/info','Api\MacController@index' );  #Mac信息接口
        $router->any('getinfo','Api\ApiWorkController@index' );  #Mac信息接口

    }
}