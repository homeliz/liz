@extends('admin.layout')

@section('css')
    <style>
        .btns{
            border-radius:20px;
            margin-right:5px;
            margin-top:5px;
        }
        .top-back {
            float: right;
            position: absolute;
            right: 20px;
            top: 8px;
        }

        li.cur a {
            font-weight: 700;
            color: #ff5400;
            border-bottom: 2px solid;
        }

    </style>
@endsection

@section('content')

    <div class="app-third-sidebar">
        <nav class="ui-nav " style="display: block;">
            <ul>
                <li class="cur">
                    <a href="javascript:void(0);"><span>{{$title}}</span></a>
                </li>
            </ul>
            <div class="top-back">
                <button class="btn btn-default layer-go-back" role="button">返回</button>
            </div>
        </nav>
    </div>

    <div id="wrapper">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <form class="form-horizontal" id="server-form0" onsubmit="return false;">
                         <div class="form-group" >
                            <label for="" class="col-sm-4 control-label"><strong><span class="red">*</span> 设定模式：</strong></label>
                            <div class="col-sm-4">
                                    @if($id>0)
                                    <select id="product_type" name="product_type" class="form-control" disabled>
                                        <option value="1" @if (isset($product_type) && $product_type==1 ) selected @endif>生活</option>
                                        <option value="2" @if (isset($product_type) && $product_type==2 ) selected @endif>工作</option>
                                        <option value="3" @if (isset($product_type) && $product_type==3 ) selected @endif>隐云</option>
                                    </select>
                                    @else
                                    <select id="product_type" name="product_type" class="form-control">
                                        <option value="1" @if (isset($product_type) && $product_type==1 ) selected @endif>生活</option>
                                        <option value="2" @if (isset($product_type) && $product_type==2 ) selected @endif>工作</option>
                                        <option value="3" @if (isset($product_type) && $product_type==3 ) selected @endif>隐云</option>
                                    </select>
                                    @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
        <div class="row"  id='yinyun'>
            <div class="col-lg-12">

                <div class="row">

                    <form class="form-horizontal" id="server-form3" onsubmit="return false;">

                        <input type="text" class="form-control hide" name="id" value="{{$id or 0}}"  placeholder="服务器id" >
                        <input type="hidden" name="product_type" value="" id="getproduct_type3">
                        <div class="form-group">
                            <label for="alias" class="col-sm-4 control-label"><strong><span class="red"></span> 别名：</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " value="{{$alias or ''}}" name="alias" id="alias3"  placeholder="请输入别名" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="server" class="col-sm-4 control-label"><strong><span class="red">*</span> 服务器地址：</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " value="{{$server or ''}}" name="server3" id="server3"  placeholder="请输入服务器地址" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="server" class="col-sm-4 control-label"><strong><span class="red">*</span> 用户名：</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " value="{{$username or ''}}" name="username" id="username3"  placeholder="请输入用户名" >
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label for="password" class="col-sm-4 control-label"><strong><span class="red">*</span> 密码：</strong></label>
                            <div class="col-sm-8 form-inline ">
                                <input type="password" class="form-control " value="{{$password or ''}}" name="password" id="password3"  placeholder="请输入密码" >  <span class="glyphicon glyphicon-eye-close" aria-hidden="true" onclick="cc(this)"></span>
                            </div>
                        </div>

                        <div class="form-group "  >
                            <label class="col-sm-5 control-label"></label>
                            <div class="col-sm-6" >
                                <button type="button" class="btn btn-default layer-go-back">关闭</button>&emsp;
                                <button type="button" class="btn btn-success ml10" onclick="save3();">保存</button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
        <div class="row"  id='noyinyun'>
            <div class="col-lg-12">

                <div class="row">

                    <form class="form-horizontal" id="server-form" onsubmit="return false;">

                        <input type="text" class="form-control hide" name="id" value="{{$id or 0}}"  placeholder="服务器id" >
                        <input type="hidden" name="product_type" value="" id="getproduct_type">

                        <div class="form-group">
                            <label for="alias" class="col-sm-4 control-label"><strong><span class="red"></span> 别名：</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " value="{{$alias or ''}}" name="alias" id="alias"  placeholder="请输入别名" >
                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="auth_enable" class="col-sm-4 control-label"><strong><span class="red"></span> 一次验证：</strong></label>
                            <div class="col-sm-4">
                                <input class="square-radio " id="auth_enable" type="checkbox" name="auth_enable" value="1"  @if( !empty($auth_enable) && $auth_enable == 1 ) checked @endif   /><span></span>&nbsp;&nbsp;
                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="switch_enable" class="col-sm-4 control-label"><strong><span class="red"></span> 自动切换：</strong></label>
                            <div class="col-sm-4">
                                <input class="square-radio " id="switch_enable" type="checkbox" name="switch_enable" value="1"  @if( empty($switch_enable) || $switch_enable == 1 ) checked @endif   /><span></span>&nbsp;&nbsp;
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="server" class="col-sm-4 control-label"><strong><span class="red">*</span> 服务器地址：</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " value="{{$server or ''}}" name="server" id="server"  placeholder="请输入服务器地址" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="server_port" class="col-sm-4 control-label"><strong><span class="red">*</span> 服务器端口：</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " value="{{$server_port or ''}}" name="server_port" id="server_port"  placeholder="请输入服务器端口" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="local_port" class="col-sm-4 control-label"><strong><span class="red">*</span> 本地端口：</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " value="{{$local_port or '1234'}}" name="local_port" id="local_port"  placeholder="请输入本地端口" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="timeout" class="col-sm-4 control-label"><strong><span class="red">*</span> 连接超时：</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " value="{{$timeout or '60'}}" name="timeout" id="timeout"  placeholder="请输入连接超时时间(秒)" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-4 control-label"><strong><span class="red">*</span> 密码：</strong></label>
                            <div class="col-sm-8 form-inline ">
                                <input type="password" class="form-control " value="{{$password or ''}}" name="password" id="password"  placeholder="请输入密码" >  <span class="glyphicon glyphicon-eye-close" aria-hidden="true" onclick="cc(this)"></span>
                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="" class="col-sm-4 control-label"><strong><span class="red">*</span> 加密方式：</strong></label>
                            <div class="col-sm-4">
                                <select id="encrypt_method" name="encrypt_method" class="form-control">
                                    @if( isset($encrypt_method_data) )
                                        @foreach( $encrypt_method_data as $k => $v )
                                            <option value="{{$k}}" @if (isset($encrypt_method) && $k == $encrypt_method ) selected @endif>{{$v}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="" class="col-sm-4 control-label"><strong><span class="red">*</span> 传输协议：</strong></label>
                            <div class="col-sm-4">
                                <select id="protocol" name="protocol" class="form-control">
                                    @if( isset($protocol_data) )
                                        @foreach( $protocol_data as $k => $v )
                                            <option value="{{$k}}" @if (isset($protocol) && $k == $protocol ) selected @endif>{{$v}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="" class="col-sm-4 control-label"><strong><span class="red">*</span> 混淆插件：</strong></label>
                            <div class="col-sm-4">
                                <select id="obfs" name="obfs" class="form-control">
                                    @if( isset($obfs_data) )
                                        @foreach( $obfs_data as $k => $v )
                                            <option value="{{$k}}" @if (isset($obfs) && $k == $obfs ) selected @endif>{{$v}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="obfs_param" class="col-sm-4 control-label"><strong><span class="red"></span> 混淆参数：</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " value="{{$obfs_param or ''}}" name="obfs_param" id="obfs_param"  placeholder="请输入混淆参数" >
                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="fast_open" class="col-sm-4 control-label"><strong><span class="red"></span> TCP快速打开：</strong></label>
                            <div class="col-sm-4">
                                <input class="square-radio " id="fast_open" type="checkbox" name="fast_open" value="1"  @if( !empty($fast_open) && $fast_open == 1 ) checked @endif   /><span></span>&nbsp;&nbsp;
                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="kcp_enable" class="col-sm-4 control-label"><strong><span class="red"></span> KcpTun 启用：</strong></label>
                            <div class="col-sm-4 from-inline">
                                <input class="square-radio " id="kcp_enable" type="checkbox" name="kcp_enable" value="1"  @if( !empty($kcp_enable) && $kcp_enable == 1 ) checked @endif   /><span></span>&nbsp;&nbsp;<span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>  二进制文件：/usr/bin/ssr-kcptun
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kcp_port" class="col-sm-4 control-label"><strong><span class="red"></span> KcpTun 端口：</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " value="{{$kcp_port or '4000'}}" name="kcp_port" id="kcp_port"  placeholder="请输入KcpTun 端口" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kcp_password" class="col-sm-4 control-label"><strong><span class="red"></span> KcpTun 密码：</strong></label>
                            <div class="col-sm-4 form-inline">
                                <input type="password" class="form-control " value="{{$kcp_password or ''}}" name="kcp_password" id="kcp_password"  placeholder="请输入KcpTun 密码" >  <span class="glyphicon glyphicon-eye-close" aria-hidden="true" onclick="cc(this)"></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kcp_param" class="col-sm-4 control-label"><strong><span class="red"></span> KcpTun 参数：</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " value="{{$kcp_param or '--nocomp'}}" name="kcp_param" id="kcp_param"   placeholder="请输入KcpTun 参数" >
                            </div>
                        </div>

                        <div class="form-group "  >
                            <label class="col-sm-5 control-label"></label>
                            <div class="col-sm-6" >
                                <button type="button" class="btn btn-default layer-go-back">关闭</button>&emsp;
                                <button type="button" class="btn btn-success ml10" onclick="save();">保存</button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>

    </div>

@endsection

@section('js')

    <script>
        //icheck插件
        $('.square-radio').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
        $(function(){
             if($('#product_type option:selected').val()==3){
                $('#noyinyun').hide();
             }else{
                $('#yinyun').hide();

             }

            $('#product_type').change(function(){

            var product_type=$('#product_type option:selected').val();
                if(product_type==3){
                    $('#noyinyun').hide();
                    $('#yinyun').show();
                }else{
                    $('#yinyun').hide();
                    $('#noyinyun').show();
                }
                
            });
        });

       

        //密码显示/隐藏
        function cc(obj) {
            if ($(obj).hasClass("glyphicon glyphicon-eye-close") ) {
                $(obj).removeClass().addClass('glyphicon glyphicon-eye-open');
                $(obj).siblings("input").attr('type','text');
            } else {
                $(obj).removeClass().addClass('glyphicon glyphicon-eye-close');
                $(obj).siblings("input").attr('type','password');
            }
        }

        function save() {
            var product_type=product_type=$('#product_type option:selected').val();
            var dt = E.getFormValues('server-form');


            var msg = '';

            //验证参数
            if( E.isEmpty(dt.server) ) {
                msg += '请输入服务器地址<br>';
            }

            if( E.isEmpty(dt.server_port) ) {
                msg += '请输入服务器端口<br>';
            }

            if( E.isEmpty(dt.local_port) ) {
                msg += '请输入本地端口<br>';
            }

            if( E.isEmpty(dt.timeout) ) {
                msg += '请输入连接超时时间<br>';
            }

            if( E.isEmpty(dt.password) ) {
                msg += '请输入密码<br>';
            }

            if( msg ) {
                layer.alert(msg,{icon:2});
                return false;
            }

            var index = layer.confirm(' 您确定保存吗', {icon: 3,offset:'50px'}, function () {

                layer.close(index);

                var index_load = layer.load(0, {shade: false});

                E.ajax({
                    type: 'POST',
                    url: '/mf/server/edit',
                    data: {dt,'product_type':product_type},
                    success: function (obj) {
                        layer.close(index_load);
                        if (obj.code == 200) {
                            layer.alert(obj.message,{icon:1,time:1500,offset:'50px'}, function(){
                                E.layerClose();
                            });
                            parent.server.refresh();
                            setTimeout('E.layerClose();',1500);
                        } else {
                            layer.alert(obj.message, {icon: 2, offset: '70px'});
                        }
                    }

                });

            });

        }
        function save3() {
            console.log(11212);
            var product_type=product_type=$('#product_type option:selected').val();
            var dt = E.getFormValues('server-form3');
           
            var msg = '';

            //验证参数
            if( E.isEmpty(dt.server3) ) {
                msg += '请输入服务器地址<br>';
            }

            if( E.isEmpty(dt.username) ) {
                msg += '请输入用户名<br>';
            }

            if( E.isEmpty(dt.password) ) {
                msg += '请输入密码<br>';
            }


            if( msg ) {
                layer.alert(msg,{icon:2});
                return false;
            }

            var index = layer.confirm(' 您确定保存吗', {icon: 3,offset:'50px'}, function () {

                layer.close(index);

                var index_load = layer.load(0, {shade: false});

                E.ajax({
                    type: 'POST',
                    url: '/mf/server/edit3',
                    data: {dt,'product_type':product_type},
                    success: function (obj) {
                        layer.close(index_load);
                        if (obj.code == 200) {
                            layer.alert(obj.message,{icon:1,time:1500,offset:'50px'}, function(){
                                E.layerClose();
                            });
                            parent.server.refresh();
                            setTimeout('E.layerClose();',1500);
                        } else {
                            layer.alert(obj.message, {icon: 2, offset: '70px'});
                        }
                    }

                });

            });

        }
    </script>

@endsection

