<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <title>魔方后台</title>
    <link rel="stylesheet" href="/libs/css/materialize.min.css">
    <link rel="stylesheet" href="/libs/css/layer.min.css">
    <style>
        html, body {
            height: 100%;
            width: 100%;
            display: table
        }

        .login-container {
            display: table-cell;
            vertical-align: middle;
            background-color: #00bcd4 !important;
        }

        .card-login {
            width: 20%;
            margin: 0 auto;
        }

        .card-header{
            background-color: #e91e63;
            text-align: center;
            padding-top: 20px;
            padding-bottom: 20px;
        }
         @font-face {
          font-family: 'Material Icons';
          font-style: normal;
          font-weight: 400;
          src: url('/libs/font/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2') format('woff2');
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

<body>

<div class="login-container">
    <div class="row">
        <div class="col s10 m6 l3 offset-l5 offset-s1  offset-m3">
            <div class="card z-depth-2">
                <div class="card-header">
                    <!-- change for your logo image below -->
                    <img src="data:image/png;base64,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"
                    />
                </div>
                <div class="card-content">
                    <form  onsubmit="return false;" method="post">
                        <div class="row">
                            <div class="input-field">
                                <i class="material-icons prefix">account_circle</i>
                                <input type="text" class="validate" id="username" name="username" value="">
                                <label for="icon_prefix">Username</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <i class="material-icons prefix">lock_outline</i>
                                <input type="password" class="validate" id="password" name="password">
                                <label for="icon_prefix">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <input type="checkbox" class="filled-in" id="filled-in-box" />
                            <label for="filled-in-box">Remember me</label>
                        </div>
                        <div class="row">
                            <button class="pink btn waves-effect waves-light col s12"  id="comfirm_submit" name="action">LOGIN</button>
                        </div>
                    </form>
                </div>
               {{-- <div class="card-action">
                    <a href="#">SIGN UP</a>
                    <a href="#">FORGOT PASSWORD</a>
                </div>--}}
            </div>
        </div>
    </div>
</div>
<script src='/libs/js/jquery/2.1.3/jquery.min.js'></script>
<script src='/libs/js/materialize.js'></script>
<script src="/libs/js/jquery/2.2.3/jquery.min.js"></script>
<!-- <script src="/libs/js/layer/3.0.1/layer.min.js"></script> -->
<script src="/libs/layer/layer.min.js"></script>
<script src="/libs/ebsig/base.js?v=20170206"></script>

<script>

    //登录
    function login(){

        var login_name = $.trim($('#username').val());
        var password = $.trim($('#password').val());

        if ( E.isEmpty(login_name) ) {
            layer.alert('请输入用户名',{icon:2});
            $('#username').focus();
            return false;
        }

        if ( E.isEmpty(password) ) {
            layer.alert('请输入密码',{icon:2});
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
            url:'/mf/login/do',
            data:{
                login_name : login_name,
                password : password,
            },
            dataType: 'json',
            success: function(obj) {
                console.log(obj);
                layer.close(layer_index);
                if (obj.code == 200 ) {
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

        //键盘回车登录
        $(document).keypress(function(e) {

            // 回车键事件
            if(e.which == 13) {
                login();
            }

        });

    });
</script>

</body>

</html>
