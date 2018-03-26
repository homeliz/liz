<?php

namespace App\Http\Controllers\Admin\Common;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis as Redis;
use Gregwar\Captcha\CaptchaBuilder;

class CaptchaController extends Controller
{

    /**
     * 生成图片验证码
     * @param Request $request
     */
    public function index( Request $request )
    {

        $width = $request->input('w', 100);
        $height = $request->input('h', 40);

        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder;

        //可以设置图片宽高及字体
        $builder->build($width, $height, $font = null);

        //获取验证码的内容
        $phrase = $builder->getPhrase();

        //把内容存入session  并保存600秒
        Redis::setex('laravel_yzm' . session()->getId(), 600, $phrase );

        //生成图片
        header('Content-Type: image/jpeg');
        $builder->output();

    }
}
