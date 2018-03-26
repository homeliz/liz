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
        #lan,#wan{
            font-size: 17px;
            line-height: 38px;
            width: 135px;
            text-align: center;
            border-bottom: none;
            cursor: pointer;
            color: 
        }
        #wan{
            color: #0069d6;
        }
        #lan{
            color: #808080
        }
        #wan span{
            color: #0069d6;
            
        }
        #lan span{
            color: #808080
        }
        #wan span,#lan span{
            font-size: 20px;
        }
        .list-inline{
            border-bottom: 1px solid #ddd;
        }
        .add{
            font-size: 23px;
            color: #0069d6;
            cursor: pointer;
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

                    <form class="form-horizontal" id="server-form" onsubmit="return false;">

                        <input type="text" class="form-control hide" name="mac_id" value="{{$mac_id or 0}}"  placeholder="mac_id" >
                        <input type="text" class="form-control hide" name="product_type" value="{{$product_type or ''}}"  placeholder="product_type" >

                         @if(isset($set_server) )
                        <input type="text" class="form-control hide" name="global_id" value="{{$set_server['id'] or ''}}"  placeholder="global_id" >
                        <input type="text" class="form-control hide" name="wan_id" value="{{$wan['id'] or ''}}"  placeholder="wan_id" >
                        <input type="text" class="form-control hide" name="lan_id" value="{{$lan['id'] or ''}}"  placeholder="lan_id" >
                        @endif

                    <h3>全局设置</h3>
                        <div class="form-group" >
                            <label for="" class="col-sm-4 control-label"><strong> 全局服务器</strong></label>
                            <div class="col-sm-4">
                                <select id="global_server" name="global_server" class="form-control">
                                        <option value="nil"  @if (!empty($set_server) && $set_server['global_server']=='nil' ) selected @endif>停用</option>
                                        @if(isset($server_selected) )
                                        @foreach( $server_selected as $k => $v )
                                            <option value="{{$v}}" @if (!empty($set_server) && $v == $set_server['global_server'] ) selected @endif>{{$v}}</option>
                                        @endforeach
                                        @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-sm-4 control-label"><strong>UDP中继服务器</strong></label>
                            <div class="col-sm-4">
                                <select id="udp_server" name="udp_relay_server" class="form-control">
                                        <option value="">停用</option>
                                        <option value="same" @if( !empty($set_server) && $set_server['udp_relay_server'] == 'same') selected @endif>与全局服务器相同</option>
                                        @if( isset($server_selected) )
                                        @foreach( $server_selected as $k => $v )
                                            <option value="{{$v}}" @if (!empty($set_server) &&   $v==$set_server['udp_relay_server'] ) selected @endif>{{$v}}</option>
                                        @endforeach
                                        @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="auth_enable" class="col-sm-4 control-label"><strong><span class="red"></span> 启用进程监控</strong></label>
                            <div class="col-sm-4">
                                <input class="square-radio " id="monitor_enable" type="checkbox" name="monitor_enable" value="1"  @if( empty($set_server) || $set_server['monitor_enable'] == 1 ) checked @endif><span></span>&nbsp;&nbsp;
                            </div>
                        </div>

                        <div class="form-group" >
                            <label for="switch_enable" class="col-sm-4 control-label"><strong><span class="red"></span> 启用自动切换</strong></label>
                            <div class="col-sm-4">
                                <div id="auto_switch_toggle">
                                    <input class="square-radio " id="enable_switch" type="checkbox" name="enable_switch" value="1"  @if( empty($set_server) || $set_server['enable_switch']  == 1 ) checked @endif   /><span></span>&nbsp;&nbsp;
                                </div>
                            </div>
                        </div>
                        <div id="auto_switch_display">
                            <div class="form-group" id="div_search_week">
                                <label for="server" class="col-sm-4 control-label"><strong>自动切换检查周期（秒）</strong></label>
                                <div class="col-sm-4">
                                @if(!empty($set_server) && $set_server['switch_time']==0)
                                    <input type="text" class="form-control " value="600" name="switch_time" id="switch_time">
                                @else
                                    <input type="text" class="form-control " value="{{$set_server['switch_time'] or '600'}}" name="switch_time" id="switch_time">
                                @endif
                                </div>
                            </div>
                            <div class="form-group" id="div_timeout">
                                <label for="server" class="col-sm-4 control-label"><strong>切换检查超时时间（秒）</strong></label>
                                <div class="col-sm-4">
                                @if(!empty($set_server) && $set_server['switch_timeout']==0)
                                    <input type="text" class="form-control " value="6" name="switch_timeout" id="switch_timeout">
                                @else
                                    <input type="text" class="form-control " value="{{$set_server['switch_timeout'] or '6'}}" name="switch_timeout" id="switch_timeout">
                                @endif
                                </div>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label for="" class="col-sm-4 control-label"><strong>运行模式</strong></label>
                            <div class="col-sm-4">
                                <select id="gfw_enable" name="gfw_enable" class="form-control">
                                        <option value="router" @if (!empty($set_server) && $set_server['gfw_enable'] == 'router' ) selected @endif>ip路由模式</option>
                                        <option value="gfw" @if (!empty($set_server) && $set_server['gfw_enable'] == 'gfw' ) selected @endif>GFW列表模式</option>
                                </select>
                            </div>
                        </div>
                         <div class="form-group" >
                            <label for="switch_enable" class="col-sm-4 control-label"><strong><span class="red"></span> 启用隧道（DNS）转发</strong></label>
                            <div class="col-sm-4">
                                <div id="auto_switch_toggle">
                                    <input class="square-radio " id="tunnel_enable" type="checkbox" name="tunnel_enable" value="1"  @if( empty($set_server) || $set_server['tunnel_enable']  == 1 ) checked @endif><span></span>&nbsp;&nbsp;
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="server" class="col-sm-4 control-label"><strong> 隧道（DNS）本地端口</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " value="{{$set_server['tunnel_port'] or '5300'}}" name="tunnel_port" id="tunnel_port"  placeholder="隧道（DNS）本地端口" >
                            
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="server" class="col-sm-4 control-label"><strong> DNS服务器地址和端口</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " value="{{$set_server['tunnel_forward'] or '8.8.8.8:53'}}" name="tunnel_forward" id="tunnel_forward"  placeholder="请输入DNS服务器地址和端口" >
                            </div>
                        </div>
                    <h3>SOCKS5代理</h3>
                        <div class="form-group" >
                            <label for="" class="col-sm-4 control-label"><strong> 服务器</strong></label>
                            <div class="col-sm-4">
                                <select id="server" name="server" class="form-control">
                                    <option value="nil" @if( !empty($set_server) && $set_server['server']  == 'nil' ) checked @endif>停用</option>
                                    @if( isset($server_selected) )
                                    @foreach( $server_selected as $k => $v )
                                        <option value="{{$v}}" @if (!empty($set_server) && $v == $set_server['server'] ) selected @endif>{{$v}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="server_port" class="col-sm-4 control-label"><strong> 本地端口</strong></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control " value="{{$set_server['local_port'] or '1080'}}" name="local_port" id="local_port"  placeholder="请输入本地端口" >
                            </div>
                        </div>
                    <h3>访问控制</h3>
                        <div>
                            <ul class="list-inline">
                                <li id="wan">接口-<span>wan</span></li>
                                <li id="lan">接口-<span>lan</span></li>

                            </ul>
                        </div>
                        <!-- <span id="wan">接口-<span>wan</span></span> -->
                        <!-- <span id="lan">接口-<span>lan</span></span><br> -->
                        <div id="wan_toggle">
                            <div class="form-group" >
                                <label for="" class="col-sm-4 control-label"><strong>被忽略IP列表</strong></label>
                                <div class="col-sm-4">
                                    <select id="wan_bp_list" name="wan_bp_list" class="form-control">
                                    @if(!empty($wan))
                                        <option value="/etc/china_ssr.txt"  @if( !empty($wan) && $wan['wan_bp_list'] == '/etc/china_ssr.txt') selected @endif>/etc/china_ssr.txt</option>
                                        <option value="/dev/null" @if( !empty($wan) && $wan['wan_bp_list'] == '/dev/null') selected @endif>留空-作为全局代理</option>
                                        @if($wan['wan_bp_list'] !== '/etc/china_ssr.txt' && $wan['wan_bp_list'] !== '/dev/null')
                                            <option value="{{$wan['wan_bp_list']}}" selected>{{$wan['wan_bp_list']}}</option>
                                        @endif
                                        <option value="---自定义---">---自定义---</option>
                                    @else
                                        <option value="/etc/china_ssr.txt" >/etc/china_ssr.txt</option>
                                        <option value="/dev/null" >留空-作为全局代理</option>
                                        <option value="---自定义---">---自定义---</option>
                                    @endif
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" id="extra_ignore_ip_clone_parent">
                                <label for="server" class="col-sm-4 control-label"><strong> 额外被忽略的ip</strong></label>
                                <div class="col-sm-4" id='extra_ignore_ip_clone'>
                                    @if(isset($wan) )
                                        <textarea class="form-control" rows="3" id="extra_ignore_ip" name="extra_ignore_ip">{{$wan['extra_ignore_ip']}}</textarea>
                                    @else
                                        <textarea class="form-control" rows="3" id="extra_ignore_ip" name="extra_ignore_ip"></textarea>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" id="extra_ignore_ip_clone_parent">
                                <label for="server" class="col-sm-4 control-label"><strong> 强制走代理</strong></label>
                                <div class="col-sm-4" id='extra_ignore_ip_clone'>
                                    @if(isset($wan))
                                        <textarea class="form-control" rows="3" id="force_ip" name="force_ip">{{$wan['force_ip']}}</textarea>
                                    @else
                                         <textarea class="form-control" rows="3" id="force_ip" name="force_ip"></textarea>
                                    @endif
                                </div>
                                
                            </div>
                        </div>
                        <div id="lan_toggle" style="display: none">
                            <div class="form-group" >
                                <label for="" class="col-sm-4 control-label"><strong>路由器访问控制</strong></label>
                                <div class="col-sm-4">
                                    <select id="router_proxy" name="router_proxy" class="form-control">
                                            <option value="1"  @if( !empty($lan) && $lan['router_proxy'] == '1') selected @endif>正常代理</option>
                                            <option value="0" @if( !empty($lan) && $lan['router_proxy'] == '0') selected @endif>不走代理</option>
                                            <option value="2" @if( !empty($lan) && $lan['router_proxy'] == '2') selected @endif>强制走代理</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group" >
                                <label for="" class="col-sm-4 control-label"><strong>内网访问控制</strong></label>
                                <div class="col-sm-4">
                                    <select id="lan_ac_mode" name="lan_ac_mode" class="form-control">
                                            <option value="0"  @if( !empty($lan) && $lan['lan_ac_mode'] == '停用') selected @endif>停用</option>
                                            <option value="w" @if( !empty($lan) && $lan['lan_ac_mode']=='w') selected @endif>允许列表内</option>
                                            <option value="b" @if( !empty($lan) && $lan['lan_ac_mode'] == 'b') selected @endif>允许列表外</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="server" class="col-sm-4 control-label"><strong> 内网主机列表</strong></label>
                                <div class="col-sm-4" id='extra_ignore_ip_clone'>
                                    @if(isset($lan) )

                                        <textarea class="form-control" rows="3" id="in_online_host" name="in_online_host">{{$lan['in_online_host']}}</textarea>
                                    @else
                                        <textarea class="form-control" rows="3" id="in_online_host" name="in_online_host"></textarea>

                                    @endif
                                </div>
                                
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
        // 自定义
        $('#wan_bp_list').change(function(){
            if($('#wan_bp_list').val()=='---自定义---'){

               $('#wan_bp_list').replaceWith("<input id='wan_bp_list' name='wan_bp_list' class='form-control' autofocus></input>");
            }
        });
        // wan的切换
        $('#wan').click(function(){
            $('#lan_toggle').css('display','none');
            $('#wan_toggle').css('display','block');
            $('#wan').css('color','#0069d6');
            $('#wan span').css('color','#0069d6');
            $('#lan').css('color','#808080');
            $('#lan span').css('color','#808080');
        });
        $('#lan').click(function(){
            $('#wan_toggle').css('display','none');
            $('#lan_toggle').css('display','block');
            $('#lan').css('color','#0069d6');
            $('#lan span').css('color','#0069d6');
            $('#wan').css('color','#808080');
            $('#wan span').css('color','#808080');
        });
        // 启用自动切换打开浏览器一瞬间的显示状态
       var auto_switch= $(':checkbox').eq(1).attr('checked');
       if(auto_switch=='checked'){
            $('#auto_switch_display').css('display','block');
       }else{
            $('#auto_switch_display').css('display','none');
       }
       // 启用自动切换之toggle
       $(':checkbox').eq(1).on('ifChecked', function(){
            $('#auto_switch_display').css('display','block');
        });
       $(':checkbox').eq(1).on('ifUnchecked', function(){
            $('#auto_switch_display').css('display','none');
        });
        // icheck插件
        $('.square-radio').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });

        function save() {
            var dt = E.getFormValues('server-form');

           // var msg = '';

            //验证参数
            // if( E.isEmpty(dt.server) ) {
            //     msg += '请输入服务器地址<br>';
            // }

            // if( E.isEmpty(dt.server_port) ) {
            //     msg += '请输入服务器端口<br>';
            // }

            // if( E.isEmpty(dt.local_port) ) {
            //     msg += '请输入本地端口<br>';
            // }

            // if( E.isEmpty(dt.timeout) ) {
            //     msg += '请输入连接超时时间<br>';
            // }

            // if( E.isEmpty(dt.password) ) {
            //     msg += '请输入密码<br>';
            // }

            // if( E.isEmpty(dt.obfs_param) ) {
            //     msg += '请输入混淆参数<br>';
            // }

            // if( msg ) {
            //     layer.alert(msg,{icon:2});
            //     return false;
            // }
            var mac_id={{$mac_id}};
            var index = layer.confirm(' 您确定保存吗', {icon: 3,offset:'50px'}, function () {

                layer.close(index);

                var index_load = layer.load(0, {shade: false});

                E.ajax({
                    type: 'POST',
                    url: '/mf/router/doGlobalSetting',
                    data: dt,
                    success: function (obj) {
                        layer.close(index_load);
                        if (obj.code == 200) {
                            layer.alert(obj.message,{icon:1,time:1500,offset:'50px'}, function(){
                                E.layerClose();
                            });
                            // parent.server.refresh();
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

