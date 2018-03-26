<!DOCTYPE html>
<html lang="zh-cn" data-dpr="1" style="font-size: 54px;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="renderer" content="webkit">
    <title>ASO自助投放平台</title>
    <meta name="description" content="ASO自助投放平台">
    <meta name="keyword" content="ASO自助投放平台">
    <link rel="stylesheet" href="/libs/css/materialize.min.css">
    <link rel="stylesheet" href="/libs/css/layer.min.css">
    <!-- <link href="http://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.bootcss.com/layer/3.0.1/mobile/need/layer.min.css" rel="stylesheet"> -->
    <script>if ('undefined' === typeof console) {
            window.console = undefined;
        }</script>
    <script>
        !function(N,M){function L(){var a=I.getBoundingClientRect().width;a/F>540&&(a=540*F);var d=a/10;I.style.fontSize=d+"px",D.rem=N.rem=d}var K,J=N.document,I=J.documentElement,H=J.querySelector('meta[name="viewport"]'),G=J.querySelector('meta[name="flexible"]'),F=0,E=0,D=M.flexible||(M.flexible={});if(H){console.warn("将根据已有的meta标签来设置缩放比例");var C=H.getAttribute("content").match(/initial\-scale=([\d\.]+)/);C&&(E=parseFloat(C[1]),F=parseInt(1/E))}else{if(G){var B=G.getAttribute("content");if(B){var A=B.match(/initial\-dpr=([\d\.]+)/),z=B.match(/maximum\-dpr=([\d\.]+)/);A&&(F=parseFloat(A[1]),E=parseFloat((1/F).toFixed(2))),z&&(F=parseFloat(z[1]),E=parseFloat((1/F).toFixed(2)))}}}if(!F&&!E){var y=N.navigator.userAgent,x=(!!y.match(/android/gi),!!y.match(/iphone/gi)),w=x&&!!y.match(/OS 9_3/),v=N.devicePixelRatio;F=x&&!w?v>=3&&(!F||F>=3)?3:v>=2&&(!F||F>=2)?2:1:1,E=1/F}if(I.setAttribute("data-dpr",F),!H){if(H=J.createElement("meta"),H.setAttribute("name","viewport"),H.setAttribute("content","initial-scale="+E+", maximum-scale="+E+", minimum-scale="+E+", user-scalable=no"),I.firstElementChild){I.firstElementChild.appendChild(H)}else{var u=J.createElement("div");u.appendChild(H),J.write(u.innerHTML)}}N.addEventListener("resize",function(){clearTimeout(K),K=setTimeout(L,300)},!1),N.addEventListener("pageshow",function(b){b.persisted&&(clearTimeout(K),K=setTimeout(L,300))},!1),"complete"===J.readyState?J.body.style.fontSize=12*F+"px":J.addEventListener("DOMContentLoaded",function(){J.body.style.fontSize=12*F+"px"},!1),L(),D.dpr=N.dpr=F,D.refreshRem=L,D.rem2px=function(d){var c=parseFloat(d)*this.rem;return"string"==typeof d&&d.match(/rem$/)&&(c+="px"),c},D.px2rem=function(d){var c=parseFloat(d)/this.rem;return"string"==typeof d&&d.match(/px$/)&&(c+="rem"),c}}(window,window.lib||(window.lib={}));
    </script>
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link  type="text/css" href="/css/admin/index.v1.css?v=201711061" rel="stylesheet">
    <style>
        #cc {
            max-width: 100%;
            height: auto;
            width: 100%;
            width:auto\9; /* ie8 */
            -ms-interpolation-mode:bicubic;
        }
        @font-face {
          font-family: 'Material Icons';
          font-style: normal;
          font-weight: 400;
          src: url(https://fonts.gstatic.com/s/materialicons/v36/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2) format('woff2');
        }

        .material-icons {
          font-family: 'Material Icons';
          font-weight: normal;
          font-style: normal;
          font-size: 24px;
          line-height: 1;
          letter-spacing: normal;
          text-transform: none;
          display: inline-block;
          white-space: nowrap;
          word-wrap: normal;
          direction: ltr;
          -webkit-font-feature-settings: 'liga';
          -webkit-font-smoothing: antialiased;
        }
    </style>
</head>


<body style="font-size: 12px;">
<!--[if lt IE 9]>
<div class="alert alert-danger topframe" role="alert">你的浏览器实在<strong>太太太太太太旧了</strong>，升级完浏览器再说
    <a target="_blank" class="alert-link" href="http://browsehappy.com">立即升级</a>
</div><![endif]-->

<div class="wrapper">
    <div class="view headView autoHeadView">
        <a class="back pc-hide" href=""><img src="/images/admin/back.png" alt=""></a>
        <a class=" pc-hide birderLog" href="javascript:;"><img src="/images/admin/logo2.png"></a>
    </div>

    <div class="loginBox">
        <h3 class="loginTitle text-center">用户登录<span></span></h3>
        <form class="form-signin"  method="post">

            <div style="display: none" class="formBox login-msg error ">  {{--错误提示--}}
                <span style="float:left;font-size:12px"></span>
            </div>

            <div class="formBox">
                <span class="loginIcon"><img src="/images/admin/userIcon.png" alt=""></span>
                <input type="text" name="username" id="username" placeholder="手机号/用户名" class="form-control">
            </div>

            <div class="formBox">
                <span class="loginIcon"><img src="/images/admin/pwdIcon.png" alt=""></span>
                <input type="password" id="password" name="password" placeholder="密码" class="form-control">
            </div>

            <div class="formBox getcode">
                    <span class="loginIcon"><img id="cc" src="/images/admin/key.png" alt=""></span>
                    <input type="text" id="code" name="code" placeholder="输入验证码" class="form-control">

                <img id="verifyCode" src="/captcha" alt="">

            </div>

            <input type="button" class="btn btn-login" id="comfirm_submit" value="登录">
            <div class="createCallout">
                <a class="forgetAcount" href="">忘记密码？</a>
                <p>没有账号?去<a href="" class="creatAcount">注册</a></p>
            </div>
        </form>
    </div>
    <div class="bgBlock1 mobile-hide">
        <img src="/images/admin/bg1.png" alt="">
    </div>
    <div class="bgBlock2 mobile-hide">
        <img src="/images/admin/bg2.png" alt="">
    </div>
    <div class="title mobile-hide">
        <img src="" alt="">
    </div>

{{--    <div class="view footerView">
        <div class="okmemo mobile-hide">
        </div>
        <p>
        </p><div class="okmemo mobile-hide">
            <p>&nbsp;</p>
            <p>版权所属</p>
            <p></p>
        </div>
    </div>--}}

</div>
<div class="footer mobile-hide">
</div>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="http://cdn.bootcss.com/jquery/2.2.3/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/layer/3.0.1/layer.min.js"></script>
<script src="/libs/ebsig/base.js?v=20170206"></script>

<script>
    //错误提示
    function error_msg( msg ) {
        $('.login-msg').show();
        $('.login-msg').find('span').html(msg);
    }

    //登录
    function login(){

        var login_name = $.trim($('#username').val());
        var password = $.trim($('#password').val());
        var yzm = $.trim($('#code').val());

        if ( E.isEmpty(login_name) ) {
            error_msg('请输入用户名');
            $('#login_name').focus();
            return false;
        }

        if ( E.isEmpty(password) ) {
            error_msg('请输入密码');
            $('#password').focus();
            return false;
        }

 /*       if ( E.isEmpty(yzm) ) {
            error_msg('请输入验证码');
            $('#code').focus();
            return false;
        }*/

        var layer_index = layer.load();

        $.ajax({
            type: 'GET',
            url:'/dd/login/do',
            data:{
                login_name : login_name,
                password : password,
                yzm : yzm
            },
            dataType: 'json',
            success: function(obj) {
                layer.close(layer_index);
                if (obj.code == 200) {
                    self.location = obj.data.redirect_url;
                }else{
                    layer.alert(obj.message,{icon:2},function(){
                        $('#username').focus();
                        layer.closeAll();
                    });
                }
            }
        });

    }

    //点击确认按钮
    $("#comfirm_submit").on('click', function () {
        login();
    });

    $(function () {

        //聚焦
        $('#username').focus();

        //验证码
        $('#verifyCode').click(function(){
            var yzm_src = '/captcha?code=' + Math.ceil(Math.random()*10000);
            $(this).attr('src', yzm_src);
        });
        //键盘回车登录
        $(document).keypress(function(e) {

            // 回车键事件
            if(e.which == 13) {
                login();
            }

        });

    });
</script>

</body></html>