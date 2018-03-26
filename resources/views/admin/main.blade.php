<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>魔方后台</title>
    <link href="/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- <link href="/libs/bootstrap//bootstrap.min.css" rel="stylesheet"> -->
    <link href="/css/admin/main.css?v=2017110609" rel="stylesheet">
    <link rel="stylesheet" href="/libs/css/layer.min.css">

</head>
<style>
    .form-horizontal .form-group{
        margin:0;
        margin-top:20px;
    }
    .control-label{
        width: 100px;
    }
   
</style>
<body>
<!--顶部-->
<div class="top-cont">
    <div class="team-logo">
    </div>
    <div class="top-nav">
        <div class="top-nav-list">
            <ul>
                @foreach ( $menus as $group_id => $group_name )
                    @if ( $group_id == $menu_key)
                        <li class="selected">
                    @else
                        <li>
                            @endif
                            <a href="/mf?menu={{$group_id}}">
                                <p class="nume_{{$group_id}}">{{$group_name}}</p>
                            </a>
                        </li>
                        @endforeach
            </ul>
        </div>

        <div class="member-infor">
            <ul>
                <li><span class="mem-name">{{$user_name}}</span><span>|&nbsp;&nbsp;<a href="/mf/logout?redirect_url=/dd">注销</a></span></li>
                <li><span><a href="javascript: void(0);"  id="setinfo" target="main-frame">个人设置</a></span></li>
            </ul>
        </div>
    </div>
</div>

<div class="main-content" id="main-content">
    <!--左侧边栏-->
    <div class="left-sidebar">
        <ul class="nav">
            @foreach($left_menus as $l_k => $l_m)
                <li data-index="{{$l_k}}">
                    <span><img src="{{$l_m['icon']}}"></span>
                    <span>{{$l_m['name']}}</span>
                    <div class="arrow"></div>
                </li>
            @endforeach
        </ul>
    </div>

    <!--子菜单栏-->
    <div class="sub-sidebar">
        <ul class="sub-nav-list">
            @if( isset( $left_menus ) && !empty( $left_menus ))
                @foreach($left_menus as $l_k => $l_m)
                    @foreach($l_m['sub'] as $m_m)
                        <li class="sub-nav-{{$l_k}}" style="display: none;">
                            <a href="{{$m_m['link']}}" target="main-frame">
                                <p>{{$m_m['name']}}</p>
                            </a>
                        </li>
                    @endforeach
                @endforeach
            @endif
        </ul>
    </div>

    <div class="right-sidebar">
        <!--主内容-->
        <div class="main-cont">
            <iframe frameborder="0" id="main-frame" name="main-frame" width="100%" height="100%" >

            </iframe>
        </div>
    </div>

</div>

<script src="/libs/jquery/jquery-2.2.2.min.js"></script>
<script src="/libs/js/jquery/2.2.3/jquery.min.js"></script>
<script src='/libs/js/jquery/2.1.3/jquery.min.js'></script>
<script src="/libs/js/jquery/2.2.3/jquery.min.js"></script>
<script src="/libs/layer/layer.js"></script>
<script src="/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="/libs/js/layer/3.0.1/layer.min.js"></script>

<script src='/libs/js/materialize.js'></script>
<!-- <script src="/libs/js/layer/3.0.1/layer.min.js"></script> -->
<script src="/libs/layer/layer.min.js"></script>
<script src="/libs/ebsig/base.js?v=20170206"></script>

<script>

    $(function() {

         var permissions='{!!Session::get('permissions')!!}';
         var username='{!!$user_name!!}';

        var main_content_obj = $('#main-content');


        //调整iframe高度
        var wh = $(window).height();
        main_content_obj.css('height', (wh-61) + 'px');

        main_content_obj.find('div.sub-sidebar').find('li').click(function () {
            main_content_obj.find('div.sub-sidebar').find('li').removeClass('cur-sub-nav').eq($(this).index()).addClass('cur-sub-nav');
        });

        main_content_obj.find('div.left-sidebar').find('li').click(function () {
            main_content_obj.find('div.left-sidebar').find('li').removeClass('cur-nav').eq($(this).index()).addClass('cur-nav');

            main_content_obj.find('div.sub-sidebar').find('li').hide();

            var sub_nav = $('li.sub-nav-' + $(this).attr('data-index'));
            sub_nav.show();
            sub_nav.eq(0).trigger('click');
            $('#main-frame').attr('src', sub_nav.eq(0).find('a').attr('href'));

            if (sub_nav.length > 1) {
                main_content_obj.find('div.sub-sidebar').show();
                main_content_obj.find('div.right-sidebar').css('padding-left', '240px');
            } else {
                main_content_obj.find('div.sub-sidebar').hide();
                main_content_obj.find('div.right-sidebar').css('padding-left', '120px');
            }

        });
        main_content_obj.find('div.left-sidebar').find('li').eq(0).trigger('click');


               

        // 个人设置
        $('#setinfo').click(function(){
               var html ='<form class="form-horizontal" id="set-form" onsubmit="return false;">';
                html +='<div class="form-group">';
                html +='<label for="inputEmail3" class="col-sm-3 control-label"><strong><span class="red">*</span> 用户名</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="text"  class="form-control" name="userName" id="userName" value="'+username+'" disabled>';
                html +='</div>';
                html +='</div>';
                html +='<div class="form-group">';
                html +='<label for="inputEmail3" class="col-sm-3 control-label"><strong><span class="red">*</span> 原密码</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="password"  class="form-control" name="oldpwd" id="oldpwd"  placeholder="请输入原密码">';
                html +='</div>';
                html +='</div>';
                html +='<div class="form-group">';
                html +='<label for="inputEmail3" class="col-sm-3 control-label"><strong><span class="red">*</span> 新密码</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="password"  class="form-control" name="newpwd" id="newpwd"  placeholder="请输入新密码">';
                html +='</div>';
                html +='</div>';
                html +='<div class="form-group">';
                html +='<label for="inputEmail3" class="col-sm-3 control-label"><strong><span class="red">*</span> 确认密码</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="password"  class="form-control" name="renewpwd" id="renewpwd"  placeholder="请输入新密码">';
                html +='</div>';
                html +='</div>';

                html +='</form>';
                var cc = layer.open({
                    title: '个人设置',
                    type: 1,
                    offset: '100px',
                    area: '550px',
                    scrollbar: false,
                    content: html,
                    btn: ['保存', '取消'],
                    yes : function() {

                        var dt = E.getFormValues('set-form');

                        var msg = '';

                        if (E.isEmpty(dt.userName) ) {
                            msg += '请输入用户名<br>';
                        }
                        if (E.isEmpty(dt.oldpwd) ) {
                            msg += '请输入原密码<br>';
                        }
                        if (E.isEmpty(dt.newpwd) ) {
                            msg += '请输入新密码<br>';
                        }
                        if (E.isEmpty(dt.renewpwd) ) {
                            msg += '请再次输入新密码<br>';
                        }


                        if( msg ) {
                            layer.alert(msg,{icon:2});
                            return false;
                        }

                        layer.confirm(' 您确定重置个人信息吗', {icon: 3,offset:'50px'}, function (index) {
                            layer.close(index);
                            E.ajax({
                                type: 'post',
                                url: '/mf/setting',
                                data: dt,
                                success: function (obj) {
                                    if (obj.code == 200) {
                                        layer.alert(obj.message, {icon: 1, offset: '70px', time: 1500});
                                        layer.close(cc);

                                    } else {
                                        layer.alert(obj.message, {icon: 2, offset: '70px'});
                                    }
                                }

                            });

                        });
                    }
                });
        })

    });


    
   

</script>
</body>
</html>
