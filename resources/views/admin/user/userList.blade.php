
@extends('admin.layout')

@section('css')
    <link rel="stylesheet" href="/libs/webuploader/webuploader.css" type="text/css"/>
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

        #filePicker{position:relative}
        #delete-file{position: absolute;top: 0px; left: 125px; height: 38px;}
    </style>
@endsection

@section('content')

    <div class="app-third-sidebar">
        <nav class="ui-nav " style="display: block;">
            <ul>
                <li class="cur">
                    <a href="javascript:void(0);"><span>用户列表</span></a>
                </li>
            </ul>
        </nav>
    </div>

    <div id="wrapper">

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-2">
                        <button class="btn btn-success" type="button" onclick="user.add();">添加用户</button>
                    </div>
                    <div class="col-md-10">
                        <form class="form-inline" id="search-form" onsubmit="return false;">

                            <div class="form-group">
                            </div>

                            <div class="input-group">
                                <select class="form-control" name="permissions_select" id="permissions_select">
                                    <option></option>
                                    <option>超级管理员</option>
                                    <option>普通管理员</option>
                                </select>
                                <!-- <input type="text" style="width: 160px;" id="file_name" name="file_name" class="form-control"  placeholder="请输入超级管理员账号">
                                <input type="text" style="width: 160px;" id="file_name" name="file_name" class="form-control"  placeholder="请输入普通管理员账号"> -->

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

                <div id="toolbar" class="btn-group">

                    <button id="btn_add" type="button"  class="btn btn-default">
                        <span style="color: #0e76a8" class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>&nbsp;批量启用
                    </button>
                    <button id="btn_delete"  type="button" class="btn btn-default" >
                        <span style="color: red" class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>&nbsp;批量删除
                    </button>

                </div>

                <table id="table"></table>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <script src="/libs/webuploader/webuploader.js"></script>
    <script>

        var bootstrap_table_ajax_url = '/mf/user/search';
        $('#table').bootstrapTable({
            classes: 'table table-hover', //bootstrap的表格样式
            sidePagination: 'server', //获取数据方式【从服务器获取数据】
            toolbar: '#toolbar', //工具按钮用哪个容器
            pagination: true, //分页
            height: $(window).height() - 200, //表格高度
            pageNumber: 1, //页码【第X页】
            pageSize: 50, //每页显示多少条数据
            pageList: [50, 100,200,400],      //可供选择的每页的行数（*）
            queryParamsType: 'limit',
            queryParams: function (params) {
                var dt = E.getFormValues('search-form');
                $.extend(params, dt);
                return params;
            },
            url: bootstrap_table_ajax_url ,//ajax链接
            sortName: 'id', //排序字段
            sortOrder: 'DESC',//排序方式
            columns: [ //字段
                { title: "全选",field: "select", checkbox: true, width: 100,align: "center",valign: "middle"},
                { title: 'ID', field: 'id', align: 'center', sortable : true },
                { title: '创建者',  field: 'creator', align: 'center' },
                { title: '用户名', field: 'username', align: 'center' },
                { title: '添加时间',  field: 'created_at', align: 'center' },
                { title: '到期时间',  field: 'expire_date', align: 'center' },
                { title: '管理员',  field: 'permissions', align: 'center' },
                { title: '状态', field: 'useFlag', align: 'center' },
                { title: '操作',  field: 'operating', align: 'center' },
            ]
        });

         $(function () {

            $(document).on('click','#btn_add', function(){    //批量审核
                user.batchChanges();
            }).on('click','#btn_delete', function(){    //批量删除
                user.del();
            });


        });

       
       var user={

            //批量启用
            batchChanges : function () {

                var mac_id = new Array();

                if( $('#table').bootstrapTable('getAllSelections').length <= 0 ) {
                    layer.alert('至少要选择一项',{icon:2,offset:'50px'});
                    return false;
                }

                $.each( $('#table').bootstrapTable('getAllSelections') , function ( k , v ) {
                    mac_id.push( v.id ) ;
                });

                layer.confirm('您确认批量启用所选用户吗？',{icon:3,offset:'50px'},function(index){
                    var index = layer.load(1, {
                        shade: [0.1,'#fff'] //0.1透明度的白色背景
                    });

                    E.ajax({
                        type:'post',
                        url:'/mf/user/change',
                        data:{
                            'id' : mac_id,
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

             //禁用 启用
            change : function (id, useFlag,userName) {

                var msg = '您确认禁用'+userName+'吗？';

                if( useFlag == 0 ) {
                    msg ='您确认禁用'+userName+'吗？';
                }
                if( useFlag == 1 ) {
                    msg ='您确认启用'+userName+'吗？';
                }

                layer.confirm(msg,{icon:3,offset:'50px'},function(index){
                    var index = layer.load(1, {
                        shade: [0.1,'#fff'] //0.1透明度的白色背景
                    });

                    E.ajax({
                        type:'post',
                        url:'/mf/user/change',
                        data:{
                            'id' : id,
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
            },

            //单条删除
            delOne: function ( mac_id ) {

                var del_data = new Array();

                del_data.push( mac_id ) ;
                layer.confirm('您确定删除该用户吗？',{icon:3,offset:'50px'},function(index){
                    var index = layer.load(1, {
                        shade: [0.1,'#fff'] //0.1透明度的白色背景
                    });

                    E.ajax({
                        type:'post',
                        url:'/mf/user/del',
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

                layer.confirm('您确定删除选中的用户吗？',{icon:3,offset:'50px'},function(index){
                    var index = layer.load(1, {
                        shade: [0.1,'#fff'] //0.1透明度的白色背景
                    });

                    E.ajax({
                        type:'post',
                        url:'/mf/user/del',
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

            //添加 修改
            edit: function ( id ) {

                var html ='<form class="form-horizontal" id="mac-form" onsubmit="return false;">';

                html +='<input type="hidden" class="form-control" name="id" id="id" value="'+id+'">';

                html +='<div class="form-group">';
                html +='<label for="inputEmail3" class="col-sm-3 control-label"><strong><span class="red">*</span> 用户名</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="text"  class="form-control" name="userName" id="userName" value="" >';
                html +='</div>';
                html +='</div>';

                html +='<div class="form-group form-inline">';
                html +='<label for="inputEmail3" class="col-sm-3 control-label"><strong><span class="red">*</span> 密码</strong></label>';
                html +='<div class="col-sm-8">';
                html +='<input type="password"  class="form-control" name="password" id="password"  placeholder="请输入密码">';
                html +='<span class="glyphicon glyphicon-eye-close" aria-hidden="true" onclick="cc(this)"></span>';
                html +='</div>';
                html +='</div>';

                html +='<div class="form-group form-inline" id="mima">';
                html +='<label for="inputEmail3" class="col-sm-3 control-label"><strong><span class="red">*</span> 确认密码</strong></label>';
                html +='<div class="col-sm-8">';
                html +='<input type="password"  class="form-control" name="repassword" id="repassword"  placeholder="请输入密码">';
                html +='<span class="glyphicon glyphicon-eye-close" aria-hidden="true" onclick="recc(this)"></span>';
                html +='</div>';
                html +='</div>';

                // html +='<div class="form-group">';
                // html +='<label for="plan_days" class="col-sm-3 control-label"><strong><span class="red">*</span> 到期时间：</strong></label>';
                // html +='<div class="col-sm-9">';
                // html +='<input type="text" class="form-control" name="expire_date" id="expire_date"  onclick="layui.laydate({elem: this, istime: true, format: \'YYYY-MM-DD 23:59:59\'})" placeholder="请选择到期时间" >';
                // html +='</div>';
                // html +='</div>';
                html +='<div class="form-group">';
                html +='<label for="app_name" class="col-sm-3 control-label"><strong><span class="red"></span> 管理员类型：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<select class="form-control" name="permissions" id="permissions" onchange="changeuser(this.value)">';
                html +='<option value="1">超级管理员</option>';
                html +='<option value="2">普通管理员</option>';
                html +='</select>';

                html +='</div>';
                html +='</div>';
                html +='</form>';

                var cc = layer.open({
                    title: '编辑用户信息',
                    type: 1,
                    offset: '100px',
                    area: '550px',
                    scrollbar: false,
                    content: html,
                    btn: ['保存', '取消'],
                    yes : function(index) {

                        var dt = E.getFormValues('mac-form');

                        var msg = '';

                        if (E.isEmpty(dt.userName) ) {
                            msg += '请输入用户名<br>';
                        }

                        if (E.isEmpty(dt.password) ) {
                            msg += '请输入密码<br>';
                        }

                        if (E.isEmpty(dt.repassword) ) {
                            msg += '请确认密码<br>';
                        }
                        if (dt.password!==dt.repassword) {
                            msg += '两次密码不一致<br>';
                        }
                        if($('#permissions').val()==2){

                            if (E.isEmpty(dt.expire_date) ) {
                                msg += '请选择到期时间<br>';
                            }
                        }

                        if( msg ) {
                            layer.alert(msg,{icon:2});
                            return false;
                        }

                        layer.confirm(' 您确定修改用户信息吗', {icon: 3,offset:'50px'}, function (index) {

                            layer.close(index);
                            E.ajax({
                                type: 'POST',
                                url: '/mf/user/edit',
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

                 //icheck插件
                $('.square-radio').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });

                if( id > 0 ) {  //赋值

                    E.ajax({
                        type:'get',
                        url: '/mf/user/get/'+id,
                        success: function (obj) {
                            console.log(obj);
                            if (obj.code == 200) {
                                
                                $('#userName').val(obj.data.userName);
                                $('#permissions').val(obj.data.permissions);

                                if(obj.data.permissions==2){
                                        var html_push='';
                                        html_push +='<div class="form-group" id="daoqi_time">';
                                        html_push +='<label for="plan_days" class="col-sm-3 control-label"><strong><span class="red">*</span> 到期时间：</strong></label>';
                                        html_push +='<div class="col-sm-9">';
                                        html_push +='<input type="text" class="form-control" name="expire_date" id="expire_date"  onclick="layui.laydate({elem: this, istime: true, format: \'YYYY-MM-DD 23:59:59\'})" value="'+obj.data.expire_date+'" >';
                                        html_push +='</div>';
                                        html_push +='</div>';
                                        $('#mima').after(html_push);
                                }

                            } else {
                                layer.alert(obj.message, {icon: 2, offset: '70px'});
                            }
                        }
                    });
                }

            },

            add: function (  ) {
                var html ='<form class="form-horizontal" id="mac-form" onsubmit="return false;">';

                html +='<div class="form-group">';
                html +='<label for="inputEmail3" class="col-sm-3 control-label"><strong><span class="red">*</span> 用户名</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="text"  class="form-control" name="userName" id="userName" value="" >';
                html +='</div>';
                html +='</div>';

                html +='<div class="form-group form-inline">';
                html +='<label for="inputEmail3" class="col-sm-3 control-label"><strong><span class="red">*</span> 密码</strong></label>';
                html +='<div class="col-sm-8">';
                html +='<input type="password"  class="form-control" name="password" id="password"  placeholder="请输入密码">';
                html +='<span class="glyphicon glyphicon-eye-close" aria-hidden="true" onclick="cc(this)"></span>';
                html +='</div>';
                html +='</div>';

                html +='<div class="form-group form-inline" id="mima">';
                html +='<label for="inputEmail3" class="col-sm-3 control-label"><strong><span class="red">*</span> 确认密码</strong></label>';
                html +='<div class="col-sm-8">';
                html +='<input type="password"  class="form-control" name="repassword" id="repassword"  placeholder="请输入密码">';
                html +='<span class="glyphicon glyphicon-eye-close" aria-hidden="true" onclick="recc(this)"></span>';
                html +='</div>';
                html +='</div>';

               
                html +='<div class="form-group">';
                html +='<label for="app_name" class="col-sm-3 control-label"><strong><span class="red"></span> 管理员类型：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<select class="form-control" name="permissions" id="permissions" onchange="changeuser(this.value)">';
                html +='<option value="1">超级管理员</option>';
                html +='<option value="2">普通管理员</option>';
                html +='</select>';

                html +='</div>';
                html +='</div>';
                html +='</form>';

                var cc = layer.open({
                    title: '编辑用户信息',
                    type: 1,
                    offset: '100px',
                    area: '550px',
                    scrollbar: false,
                    content: html,
                    btn: ['保存', '取消'],
                    yes : function(index) {

                        var dt = E.getFormValues('mac-form');

                        var msg = '';

                        if (E.isEmpty(dt.userName) ) {
                            msg += '请输入用户名<br>';
                        }

                        if (E.isEmpty(dt.password) ) {
                            msg += '请输入密码<br>';
                        }

                        if (E.isEmpty(dt.repassword) ) {
                            msg += '请确认密码<br>';
                        }
                        if (dt.password!==dt.repassword) {
                            msg += '两次密码不一致<br>';
                        }
                        if($('#permissions').val()==2){

                            if (E.isEmpty(dt.expire_date) ) {
                                msg += '请选择到期时间<br>';
                            }
                        }

                        if( msg ) {
                            layer.alert(msg,{icon:2});
                            return false;
                        }

                        layer.confirm(' 您确定修改用户信息吗', {icon: 3,offset:'50px'}, function (index) {

                            layer.close(index);
                            E.ajax({
                                type: 'POST',
                                url: '/mf/user/add',
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

                 //icheck插件
                $('.square-radio').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });

               
            },
            // 显示路由列表，同时勾选已选的路由
            showSetRouter : function (id) {
                var url = '/mf/user/showSetRouter/'+id;
                layer.open({
                    title: '选择路由',
                    type: 2,
                    offset: '30px',
                    area: ['900px', '500px'],
                    content: url
                });
            },
            // 显示路由列表，同时勾选已选的路由
            showSetServer : function (id) {
                var url = '/mf/user/showSetServer/'+id;
                layer.open({
                    title: '选择服务器',
                    type: 2,
                    offset: '30px',
                    area: ['900px', '500px'],
                    content: url
                });
            },
             // 提交已经选中的服务器
            doSetServer : function (mac_id,select_sid){
                E.ajax({
                        type:'post',
                        url: '/mf/user/doSetServer',
                        data:{
                            'mac_id' : mac_id,
                            'select_sid':select_sid
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

             // 提交已经选中的服务器
            doSetRouter : function (mac_id,select_sid){
                E.ajax({
                        type:'post',
                        url: '/mf/user/doSetRouter',
                        data:{
                            'mac_id' : mac_id,
                            'select_sid':select_sid
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

       }

          //密码显示/隐藏
        function cc(obj) {
            if ($(obj).hasClass("glyphicon glyphicon-eye-close") ) {
                $(obj).removeClass().addClass('glyphicon glyphicon-eye-open');
                $('#password').attr('type','text');
            } else {
                $(obj).removeClass().addClass('glyphicon glyphicon-eye-close');
                $('#password').attr('type','password');
            }
        }
        function recc(obj) {
            if ($(obj).hasClass("glyphicon glyphicon-eye-close") ) {
                $(obj).removeClass().addClass('glyphicon glyphicon-eye-open');
                $('#repassword').attr('type','text');
            } else {
                $(obj).removeClass().addClass('glyphicon glyphicon-eye-close');
                $('#repassword').attr('type','password');
            }
        }
        // 给超级管理员和普通管理员绑定点击事件
        function changeuser(obj){

            if(obj==2){
                 var html_push='';
                    html_push +='<div class="form-group" id="daoqi_time">';
                    html_push +='<label for="plan_days" class="col-sm-3 control-label"><strong><span class="red">*</span> 到期时间：</strong></label>';
                    html_push +='<div class="col-sm-9">';
                    html_push +='<input type="text" class="form-control" name="expire_date" id="expire_date"  onclick="layui.laydate({elem: this, istime: true, format: \'YYYY-MM-DD 23:59:59\'})" placeholder="请选择到期时间" >';
                    html_push +='</div>';
                    html_push +='</div>';
                    $('#mima').after(html_push);
                }else{
                    $('#daoqi_time').remove();
                }
        }
      
    </script>

@endsection

