@extends('admin.layout')

@section('css')
    <link rel="stylesheet" href="/libs/webuploader/webuploader.css" type="text/css"/>
    <link rel="stylesheet" href="/libs/bootstrap-switch-3.3.4/dist/css/bootstrap3/bootstrap-switch.css" type="text/css"/>
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

        .ui-nav ul{ position:relative;}
        .switch{ display: inline;position:absolute;right:10px;bottom:0;}
        table {
            table-layout: fixed;
        }
    </style>
@endsection

@section('content')

    <div class="app-third-sidebar">
        <nav class="ui-nav " style="display: block;">
            <ul>
                <li class="cur">
                    <a href="javascript:void(0);"><span>路由器列表</span></a>
                </li>
                
                @if($permissions==1)
                <div class="switch"  >
                    接收新设备：<input type="checkbox"  name="receive_status" @if ( $config == 1)
                    checked
                            @endif />
                </div>
                @endif
            </ul>

        </nav>
    </div>

    <div id="wrapper" style="height: 100%;">

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-10">
                        <form class="form-inline" id="search-form" onsubmit="return false;">

                            <div class="input-group">

                                <input type="text" style="width: 160px;" id="mac_address" name="mac_address" class="form-control"  placeholder="请输入MAC地址">

                                <span class="input-group-btn">
                                    <button class="btn btn-default" name="search" type="button">查询</button>
                                    <button class="btn btn-warning" name="to-reset" type="button">重置</button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>

        <div class="row">
            <div class="col-lg-12">
                @if($permissions==1)
                <div id="toolbar" class="btn-group">

                    <button id="btn_add" type="button"  class="btn btn-default">
                        <span style="color: #0e76a8" class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>&nbsp;批量审核
                    </button>
                    <button id="btn_delete"  type="button" class="btn btn-default" >
                        <span style="color: red" class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>&nbsp;批量删除
                    </button>

                </div>
                @endif
                <table id="table"></table>
            </div>
        </div>

    </div>

@endsection

@section('js')

    <script src="/libs/bootstrap-switch-3.3.4/dist/js/bootstrap-switch.js"></script>
    <script>
        var permissions='{!!Session::get('permissions')!!}';
        
        var bootstrap_table_ajax_url = '/mf/router/search';
         if(permissions==1){
            $('#table').bootstrapTable({
                classes: 'table table-hover', //bootstrap的表格样式
                sidePagination: 'server', //获取数据方式【从服务器获取数据】
                toolbar: '#toolbar', //工具按钮用哪个容器
                pagination: true, //分页
                height: $(window).height() - 120, //表格高度
                pageNumber: 1, //页码【第X页】
                pageSize: 10, //每页显示多少条数据
                height: 'auto', //每页显示多少条数据
                pageList: [50, 100,200,400],      //可供选择的每页的行数（*）
                queryParamsType: 'limit',
                queryParams: function (params) {
                    var dt = E.getFormValues('search-form');
                    $.extend(params, dt);
                    return params;
                },
                url: bootstrap_table_ajax_url ,//ajax链接
                sortName: 'mac_id', //排序字段
                sortOrder: 'DESC',//排序方式
                columns: [ //字段
                    { title: '全选',field: 'select', checkbox: true, width: 20,align: 'center',valign: 'middle'},
                    { title: 'ID', field: 'id', align: 'center', sortable : true,width:30 },
                    { title: '添加时间',  field: 'created_at', align: 'center',width:55 },
                    { title: 'MAC',  field: 'mac', align: 'center',width:80 },
                    { title: 'SSID',  field: 'ssid', align: 'center',width:60 },
                    { title: '到期时间',  field: 'expire_date', align: 'center',width:55},
                    { title: '隐云状态',  field: 'moshi', align: 'center',width:55},
                    { title: '访问谷歌',  field: 'moshi1', align: 'center',width:55},
                    { title: '状态',  field: 'useFlag', align: 'center',width:35 },
                    { title: '备注',  field: 'remark_info', align: 'center',width:60 },
                    { title: '操作',  field: 'operating', align: 'left', width:170},
                ]
            });
            
         }else{
            $('#table').bootstrapTable({
                classes: 'table table-hover', //bootstrap的表格样式
                sidePagination: 'server', //获取数据方式【从服务器获取数据】
                toolbar: '#toolbar', //工具按钮用哪个容器
                pagination: true, //分页
                height: $(window).height() - 120, //表格高度
                pageNumber: 1, //页码【第X页】
                pageSize: 10, //每页显示多少条数据
                height: 'auto', //每页显示多少条数据
                pageList: [50, 100,200,400],      //可供选择的每页的行数（*）
                queryParamsType: 'limit',
                queryParams: function (params) {
                    var dt = E.getFormValues('search-form');
                    $.extend(params, dt);
                    return params;
                },
                url: bootstrap_table_ajax_url ,//ajax链接
                sortName: 'mac_id', //排序字段
                sortOrder: 'DESC',//排序方式
                columns: [ //字段
                    { title: '全选',field: 'select', checkbox: true, width: 20,align: 'center',valign: 'middle'},
                    { title: 'ID', field: 'id', align: 'center', sortable : true,width:30 },
                    { title: '添加时间',  field: 'created_at', align: 'center',width:55 },
                    { title: 'MAC',  field: 'mac', align: 'center',width:80 },
                    { title: 'SSID',  field: 'ssid', align: 'center',width:60 },
                    { title: '到期时间',  field: 'expire_date', align: 'center',width:55},
                    { title: '隐云状态',  field: 'moshi', align: 'center',width:55},
                    { title: '访问谷歌',  field: 'moshi1', align: 'center',width:55},
                    { title: '备注',  field: 'remark_info', align: 'center',width:60 },
                    { title: '操作',  field: 'operating', align: 'left', width:170},
                ]
            });

         }

        $(function () {

            $(document).on('click','#btn_add', function(){    //批量审核
                if(permissions==2){
                    layer.alert('你没有此权限',{icon:2,offset:'50px',time:2000});

                }else{

                    mac.batchChanges();
                }
            }).on('click','#btn_delete', function(){    //批量删除
                 if(permissions==2){
                    layer.alert('你没有此权限',{icon:2,offset:'50px',time:2000});

                }else{

                    mac.del();
                }
            });

            $('[name="receive_status"]').bootstrapSwitch({
                onText:"开启",
                offText:"已关闭",
                onColor:"success",
                offColor:"danger",
                size:"small",
                onSwitchChange:function(event,state){
                     if(permissions==2){
                            // layer.alert('你没有此权限',{icon:2,offset:'50px',time:2000});
                            layer.alert('你没有此权限',{icon:2,offset:'50px'},function(index){

                                window.location.reload();
                                
                                layer.close(index);
                            });
                           
                    }else{
                        console.log(11);
                        if(state==true){
                            //开启
                            
                                startsChange(1);
                        }else{
                            //关闭
                           
                                startsChange(0);
                            
                        }
                    }
                }
            })

        });



        //改变路由器接收状态
        function startsChange(op) {


            var index = layer.load(1, {
                shade: [0.1,'#fff'] //0.1透明度的白色背景
            });

            E.ajax({
                type:'post',
                url:'/mf/router/config',
                data:{
                    'config_id' : 1,
                    'op' : op
                },
                success:function(res){

                    layer.close( index );
                    $('#table').bootstrapTable('refresh');
                    if ( res.code == 200 ) {
                        layer.alert(res.message,{icon:1,offset:'50px',time:1500});
                    } else {
                        layer.alert(res.message,{icon:2,offset:'50px'});
                    }

                }

            });
        }

        var mac = {

            layer_index : 0,

            //添加 修改
            edit: function ( mac_id ) {

           
                var html ='<form class="form-horizontal" id="mac-form" onsubmit="return false;">';

                html +='<input type="hidden" class="form-control" name="mac_id" id="mac_id" value="'+mac_id+'">';

                html +='<div class="form-group">';
                html +='<label for="app_name" class="col-sm-3 control-label"><strong><span class="red">*</span> MAC：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="text"  class="form-control" name="mac" id="mac"  placeholder="请输入MAC地址" disabled>';
                html +='</div>';
                html +='</div>';

                html +='<div class="form-group">';
                html +='<label for="app_name" class="col-sm-3 control-label"><strong><span class="red">*</span> SSID：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="text" class="form-control" name="ssid" id="ssid"  placeholder="请输入SSID名称" >';
                html +='</div>';
                html +='</div>';

                html +='<div class="form-group">';
                html +='<label for="delivery_start_date" class="col-sm-3 control-label"><strong><span class="red">*</span> 注册时间：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="text" class="form-control" name="registration_time" id="registration_time"  onclick="layui.laydate({elem: this, istime: true, format: \'YYYY-MM-DD hh:mm:ss\'})" placeholder="请选择注册时间" >';
                html +='</div>';
                html +='</div>';

                html +='<div class="form-group">';
                html +='<label for="plan_days" class="col-sm-3 control-label"><strong><span class="red">*</span> 到期时间：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="text" class="form-control" name="expire_date" id="expire_date"  onclick="layui.laydate({elem: this, istime: true, format: \'YYYY-MM-DD 23:59:59\'})" placeholder="请选择到期时间" >';
                html +='</div>';
                html +='</div>';
                html +='<div class="form-group">';
                html +='<label for="plan_days" class="col-sm-3 control-label"><strong><span class="red">*</span> 备注信息：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<textarea class="form-control" rows="3" name="remark_info" id="remark_info"></textarea>';
                html +='</div>';
                html +='</div>';
                html +='</form>';

                var cc = layer.open({
                    title: '编辑MAC信息',
                    type: 1,
                    offset: '100px',
                    area: '550px',
                    scrollbar: false,
                    content: html,
                    btn: ['保存', '取消'],
                    yes : function(index) {

                        var dt = E.getFormValues('mac-form');

                        var msg = '';

                        if (E.isEmpty(dt.mac) ) {
                            msg += '请输入MAC地址<br>';
                        }

                        if (E.isEmpty(dt.ssid) ) {
                            msg += '请输入SSID名称<br>';
                        }

                        if (E.isEmpty(dt.registration_time) ) {
                            msg += '请选择注册时间<br>';
                        }

                        if (E.isEmpty(dt.expire_date) ) {
                            msg += '请选择到期时间<br>';
                        }

                        if( msg ) {
                            layer.alert(msg,{icon:2});
                            return false;
                        }

                        layer.confirm(' 您确定修改MAC信息吗', {icon: 3,offset:'50px'}, function (index) {

                            layer.close(index);
                            E.ajax({
                                type: 'POST',
                                url: '/mf/router/edit',
                                data: dt,
                                success: function (obj) {
                                    if (obj.code == 200) {

                                        layer.alert(obj.message, {icon: 1, offset: '70px', time: 1000});
                                        layer.close(cc);

                                        $('#table').bootstrapTable('refresh');
                                    } else {
                                        layer.alert(obj.message, {icon: 2, offset: '70px'});
                                    }
                                }

                            });

                        });
                    }
                });

                if( mac_id > 0 ) {  //赋值

                    E.ajax({
                        type:'get',
                        url: '/mf/router/get/'+mac_id,
                        success: function (obj) {
                            if (obj.code == 200) {
                                $('#mac').val(obj.data.mac);
                                $('#ssid').val(obj.data.ssid);
                                $('#registration_time').val(obj.data.registration_time);
                                $('#expire_date').val(obj.data.expire_date);
                                $('#remark_info').val(obj.data.remark_info);
                            } else {
                                layer.alert(obj.message, {icon: 2, offset: '70px'});
                            }
                        }
                    });
                }
                
            },

            //批量审核
            batchChanges : function () {

                var mac_id = new Array();

                if( $('#table').bootstrapTable('getAllSelections').length <= 0 ) {
                    layer.alert('至少要选择一项',{icon:2,offset:'50px'});
                    return false;
                }

                $.each( $('#table').bootstrapTable('getAllSelections') , function ( k , v ) {
                    mac_id.push( v.id ) ;
                });

                layer.confirm('您确认批量审核所选MAC吗？',{icon:3,offset:'50px'},function(index){
                    var index = layer.load(1, {
                        shade: [0.1,'#fff'] //0.1透明度的白色背景
                    });

                    E.ajax({
                        type:'post',
                        url:'/mf/router/change',
                        data:{
                            'mac_id' : mac_id,
                        },
                        success:function(res){
                            layer.close( index );
                            if ( res.code == 200 ) {
                                $('#table').bootstrapTable('refresh');
                                layer.alert(res.message,{icon:1,offset:'50px',time:1500});
                            } else {
                                layer.alert(res.message,{icon:2,offset:'50px'});
                            }
                        }

                    });

                })

            },

            //审核 取消审核
            change : function (mac_id, useFlag) {
                if(permissions==2){
                    layer.alert('你没有此权限',{icon:2,offset:'50px',time:2000});

                }else{

                    var msg = '您确认通过审核吗？';

                    if( useFlag == 0 ) {
                        msg = '您确认取消审核吗？'
                    }

                    layer.confirm(msg,{icon:3,offset:'50px'},function(index){
                        var index = layer.load(1, {
                            shade: [0.1,'#fff'] //0.1透明度的白色背景
                        });

                        E.ajax({
                            type:'post',
                            url:'/mf/router/change',
                            data:{
                                'mac_id' : mac_id,
                                'useFlag' : useFlag
                            },
                            success:function(res){
                                layer.close( index );
                                if ( res.code == 200 ) {
                                    $('#table').bootstrapTable('refresh');
                                    layer.alert(res.message,{icon:1,offset:'50px',time:1500});
                                } else {
                                    layer.alert(res.message,{icon:2,offset:'50px'});
                                }
                            }

                        });

                    })
                }
            },

            //单条删除
            delOne: function ( mac_id ) {
                if(permissions==2){
                    layer.alert('你没有此权限',{icon:2,offset:'50px',time:2000});

                 }else{

                    var del_data = new Array();

                    del_data.push( mac_id ) ;
                    layer.confirm('您确定删除MAC吗？',{icon:3,offset:'50px'},function(index){
                        var index = layer.load(1, {
                            shade: [0.1,'#fff'] //0.1透明度的白色背景
                        });

                        E.ajax({
                            type:'post',
                            url:'/mf/router/del',
                            data:{
                                'del_data' : del_data
                            },
                            success:function(res){

                                layer.close( index );

                                if ( res.code == 200 ) {
                                    $('#table').bootstrapTable('refresh');
                                    layer.alert(res.message,{icon:1,offset:'50px',time:1500});
                                } else {
                                    layer.alert(res.message,{icon:2,offset:'50px'});
                                }

                            }

                        });

                    })
                }

            },

            //批量删除
            del: function( ){

                var del_data = new Array();

                if( $('#table').bootstrapTable('getAllSelections').length <= 0 ) {
                    layer.alert('至少要选择一项',{icon:2,offset:'50px'});
                    return false;
                }

                $.each( $('#table').bootstrapTable('getAllSelections') , function ( k , v ) {
                    del_data.push( v.id ) ;
                });

                layer.confirm('您确定删除选中的MAC吗？',{icon:3,offset:'50px'},function(index){
                    var index = layer.load(1, {
                        shade: [0.1,'#fff'] //0.1透明度的白色背景
                    });

                    E.ajax({
                        type:'post',
                        url:'/mf/router/del',
                        data:{
                            'del_data' : del_data
                        },
                        success:function(res){

                            layer.close( index );

                            if ( res.code == 200 ) {
                                $('#table').bootstrapTable('refresh');
                                layer.alert(res.message,{icon:1,offset:'50px',time:1500});
                            } else {
                                layer.alert(res.message,{icon:2,offset:'50px'});
                            }

                        }

                    });

                })

            },
            // 显示服务器列表，同时勾选已选的服务器
            setServer : function (mac_id,product_type) {
              
                var url = '/mf/router/showSetServer/'+mac_id+'/'+product_type;
                layer.open({
                    title: '选择服务器',
                    type: 2,
                    area: ['900px', '500px'],
                    content: url
                });
                
            },
            // 提交已经选中的服务器
            doSetServer : function (mac_id,select_sid,product_type){
                E.ajax({
                        type:'post',
                        url: '/mf/router/doSetServer',
                        data:{
                            'mac_id' : mac_id,
                            'select_sid':select_sid,
                            'product_type':product_type
                        },
                        success:function(res){

                            if ( res.code == 200 ) {
                                $('#table').bootstrapTable('refresh');
                                layer.alert(res.message,{icon:1,offset:'50px',time:1500});
                            } else {
                                layer.alert(res.message,{icon:2,offset:'50px'});
                            }

                        }

                    });
                
            },

            // 全局设置
            globalSetting  :  function(mac_id,product_type){
               
                if(product_type==0 || product_type==3){
                    layer.alert('请开启链路模式或关闭隐云模式',{icon:2,offset:'50px'});
                }else{

                    layer.open( {
                        title: false ,
                        type: 2 ,
                        area: ['100%', '100%'] ,
                        scrollbar: false ,
                        offset: '0px' ,
                        closeBtn: 0,
                        content: '/mf/router/globalSetting/page/' + mac_id+'/'+product_type,

                    } );
                }
            
            },

            // wifi设置
             //添加 修改
            showSetWifi: function ( mac_id,ssid) {
                
                var html ='<form class="form-horizontal" id="wifi_form" onsubmit="return false;">';

                html +='<input type="hidden" class="form-control" name="rid" id="rid" value="'+mac_id+'">';

                html +='<div class="form-group">';
                html +='<label for="app_name" class="col-sm-3 control-label"><strong><span class="red"></span> SSID：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="text"  class="form-control" name="ssid" id="ssid"  placeholder="请输入SSID名称" value="'+ssid+'">';
                html +='</div>';
                html +='</div>';

                html +='<div class="form-group">';
                html +='<label for="app_name" class="col-sm-3 control-label"><strong><span class="red"></span> 加密类型：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<select class="form-control" name="encryption" id="encryption">';
                html +='<option value="none">No Encryption</option>';
                html +='<option value="wep-open">WEP 开放认证</option>';
                html +='<option value="wep-shared">WEP 共享密钥</option>';
                html +='<option value="psk">WPA-PSK</option>';
                html +='<option value="psk2">WPA2-PSK</option>';
                html +='<option value="psk-mixed">WPA-PSK/WPA2-PSK Mixed Mode</option>';
                html +='<option value="wpa">WPA-EAP</option>';
                html +='<option value="wpa2">WPA2-EAP</option>';
                html +='</select>';

                html +='</div>';
                html +='</div>';

                html +='<div class="form-group">';
                html +='<label for="delivery_start_date" class="col-sm-3 control-label"><strong><span class="red"></span> 密码：</strong></label>';
                html +='<div class="col-sm-7 form-inline">';
                html +='<input type="text" class="form-control" name="key" id="key"   placeholder="请填写密码" >';
                html +='<span class="glyphicon glyphicon-eye-close" aria-hidden="true" onclick="cc(this)"></span>';
                html +='</div>';
                html +='</div>';
                html +='<div class="form-group">';
                html +=' <label for="needset" class="col-sm-3 control-label"><strong><span class="red"></span> 一次验证：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input class="square-radio " id="needset" type="checkbox" name="needset" value="" >';
                html +='</div>';
                html +='</div>';
                html +='</form>';
                var wifi = layer.open({
                    title: 'wifi设置',
                    type: 1,
                    offset: '100px',
                    area: '550px',
                    scrollbar: false,
                    content: html,
                    btn: ['保存','取消'],
                        
                    yes : function() {
                    var wifi_info = E.getFormValues('wifi_form');
                        layer.confirm(' 您确定保存wifi设置吗？', {icon: 3,offset:'50px'}, function (index) {

                            layer.close(index);

                            E.ajax({
                                type: 'POST',
                                url: '/mf/router/doSetWifi',
                                data: wifi_info,
                                success: function (obj) {
                                    layer.close(this.layer_index);
                                    if (obj.code == 200) {
                                        layer.alert(obj.message, {icon: 1, offset: '70px', time: 1500});
                                        layer.close(wifi);

                                        $('#table').bootstrapTable('refresh');
                                    } else {
                                        layer.alert(obj.message, {icon: 2, offset: '70px'});
                                    }
                                }

                            });

                        });
                    }
                });

                //icheck插件
                $('.square-radio').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });

                if( mac_id > 0 ) {  //赋值

                    E.ajax({
                        type:'get',
                        url: '/mf/router/getWifi/'+mac_id,
                        success: function (obj) {
                            if (obj.code == 200) {
                                $('#encryption').val(obj.data.encryption);
                                $('#ssid').val(obj.data.ssid);
                                $('#key').val(obj.data.key);
                                if(obj.data.needset==1){
                                    $('#needset').iCheck('check');
                                }
                            } 
                        }
                    });
                }
                
            },

           
        }

        //密码显示/隐藏
        function cc(obj) {
            if ($(obj).hasClass("glyphicon glyphicon-eye-close") ) {
                $(obj).removeClass().addClass('glyphicon glyphicon-eye-open');
                $('#key').attr('type','text');
            } else {
                $(obj).removeClass().addClass('glyphicon glyphicon-eye-close');
                $('#key').attr('type','password');
            }
        }
        function changetype(mac_id,value){
            
            var index = layer.load(1, {
                shade: [0.1,'#fff'] //0.1透明度的白色背景
            });

            E.ajax({
                type:'post',
                url:'/mf/router/product_type',
                data:{
                    'mac_id' : mac_id,
                    'product_type' : value
                },
                success:function(res){

                    layer.close( index );
                    $('#table').bootstrapTable('refresh');
                    if ( res.code == 200 ) {
                        layer.alert(res.message,{icon:1,offset:'50px',time:1500});
                    } else {
                        layer.alert(res.message,{icon:2,offset:'50px'});
                    }

                }

            }); 
        
        }
    </script>

@endsection

