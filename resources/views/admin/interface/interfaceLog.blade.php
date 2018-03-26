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
    </style>
@endsection

@section('content')

    <div class="app-third-sidebar">
        <nav class="ui-nav " style="display: block;">
            <ul>
                <li class="cur">
                    <a href="javascript:void(0);"><span>接口日志列表</span></a>
                </li>
               
            </ul>

        </nav>
    </div>

    <div id="wrapper">

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
                <div id="toolbar" class="btn-group">
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

    <script src="/libs/bootstrap-switch-3.3.4/dist/js/bootstrap-switch.js"></script>
    <script>
         var permissions='{!!Session::get('permissions')!!}';

        var bootstrap_table_ajax_url = '/mf/interface/search';
        $('#table').bootstrapTable({
            classes: 'table table-hover', //bootstrap的表格样式
            sidePagination: 'server', //获取数据方式【从服务器获取数据】
            toolbar: '#toolbar', //工具按钮用哪个容器
            pagination: true, //分页
            height: $(window).height() - 120, //表格高度
            pageNumber: 1, //页码【第X页】
            pageSize: 15, //每页显示多少条数据
            pageList: [50, 100,200,400],      //可供选择的每页的行数（*）
            queryParamsType: 'limit',
            height:'auto',
            queryParams: function (params) {
                var dt = E.getFormValues('search-form');
                $.extend(params, dt);
                return params;
            },
            url: bootstrap_table_ajax_url ,//ajax链接
            sortName: 'id', //排序字段
            sortOrder: 'DESC',//排序方式
            columns: [ //字段
                { title: "全选",field: "select", checkbox: true, width: 30,align: "center",valign: "middle"},
                { title: 'ID', field: 'id', align: 'center', sortable : true },
                { title: '访问时间',  field: 'visit_time', align: 'center'},
                { title: 'MAC',  field: 'mac', align: 'center' },
                { title: 'SSID',  field: 'ssid', align: 'center'},
                { title: '配置次数',  field: 'net', align: 'center'},
                { title: '累计请求次数',  field: 'count', align: 'center'},
                { title: '用户IP',  field: 'user_ip', align: 'center'},
                { title: '操作',  field: 'operating', align: 'left'},
            ]
        });

        $(function () {

            $(document).on('click','#btn_delete', function(){    //批量删除
                interface.del();
            });

        });

        var interface = {

            layer_index : 0,

            //添加 修改
            edit: function ( id ) {
              
                var html ='<form class="form-horizontal" id="interface-form" onsubmit="return false;">';

                html +='<input type="hidden" class="form-control" name="id" id="id" value="'+id+'">';

                html +='<div class="form-group">';
                html +='<label for="app_name" class="col-sm-3 control-label"><strong><span class="red">*</span> MAC：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="text"  class="form-control" name="mac" id="mac"  placeholder="请输入MAC地址">';
                html +='</div>';
                html +='</div>';

                html +='<div class="form-group">';
                html +='<label for="app_name" class="col-sm-3 control-label"><strong><span class="red">*</span> SSID：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="text" class="form-control" name="ssid" id="ssid"  placeholder="请输入SSID名称" >';
                html +='</div>';
                html +='</div>';

                html +='<div class="form-group">';
                html +='<label for="delivery_start_date" class="col-sm-3 control-label"><strong><span class="red">*</span> 访问时间：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="text" class="form-control" name="visit_time" id="visit_time"  onclick="layui.laydate({elem: this, istime: true, format: \'YYYY-MM-DD hh:mm:ss\'})" placeholder="请选择访问时间" >';
                html +='</div>';
                html +='</div>';
                 html +='<div class="form-group">';
                html +='<label for="plan_days" class="col-sm-3 control-label"><strong><span class="red">*</span> 用户IP：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="text" class="form-control" name="user_ip" id="user_ip" placeholder="请输入用户IP" >';
                html +='</div>';
                html +='</div>';
                html +='<div class="form-group">';
                html +='<label for="plan_days" class="col-sm-3 control-label"><strong><span class="red"></span> 配置次数：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="text" class="form-control" name="net" id="net" placeholder="请输入状态" >';
                html +='</div>';
                html +='</div>';
               
                html +='<div class="form-group">';
                html +='<label for="plan_days" class="col-sm-3 control-label"><strong><span class="red"></span> 累计请求次数：</strong></label>';
                html +='<div class="col-sm-9">';
                html +='<input type="text" class="form-control" name="count" id="count" placeholder="请输入累计请求次数" >';
                html +='</div>';
                html +='</div>';
                html +='</form>';

                var log= layer.open({
                    title: '编辑M日志信息',
                    type: 1,
                    offset: '50px',
                    area: '550px',
                    scrollbar: false,
                    content: html,
                    btn: ['保存', '取消'],
                    yes : function() {

                        var dt = E.getFormValues('interface-form');

                        var msg = '';

                        if (E.isEmpty(dt.mac) ) {
                            msg += '请输入MAC地址<br>';
                        }

                        if (E.isEmpty(dt.ssid) ) {
                            msg += '请输入SSID名称<br>';
                        }

                        if (E.isEmpty(dt.visit_time) ) {
                            msg += '请选择访问时间<br>';
                        }

                        if (E.isEmpty(dt.user_ip) ) {
                            msg += '请输入用户IP<br>';
                        }

                        if( msg ) {
                            layer.alert(msg,{icon:2});
                            return false;
                        }

                        layer.confirm(' 您确定修改日志信息吗', {icon: 3,offset:'50px'}, function (index) {

                            layer.close(index);
                            console.log(dt);
                            E.ajax({
                                type: 'POST',
                                url: '/mf/interface/edit',
                                data: dt,
                                success: function (obj) {
                                    layer.close(this.layer_index);
                                    if (obj.code == 200) {
                                        layer.alert(obj.message, {icon: 1, offset: '70px', time: 1500});
                                        layer.close(log);
                                        $('#table').bootstrapTable('refresh');
                                    } else {
                                        layer.alert(obj.message, {icon: 2, offset: '70px'});
                                    }
                                }

                            });

                        });
                    }
                });

                if( id > 0 ) {  //赋值

                    E.ajax({
                        type:'get',
                        url: '/mf/interface/get/'+id,
                        success: function (obj) {
                            if (obj.code == 200) {
                                $('#mac').val(obj.data.mac);
                                $('#ssid').val(obj.data.ssid);
                                $('#visit_time').val(obj.data.visit_time);
                                $('#user_ip').val(obj.data.user_ip);
                                $('#net').val(obj.data.net);
                                $('#count').val(obj.data.count);
                            } else {
                                layer.alert(obj.message, {icon: 2, offset: '70px'});
                            }
                        }
                    });
                }
           

            },

            //单条删除
            delOne: function ( id ) {
             
                var del_data = new Array();

                del_data.push( id ) ;
                layer.confirm('您确定删除日志吗？',{icon:3,offset:'150px'},function(index){
                    var index = layer.load(1, {
                        shade: [0.1,'#fff'] //0.1透明度的白色背景
                    });

                    E.ajax({
                        type:'post',
                        url:'/mf/interface/del',
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
                layer.confirm('您确定删除选中的日志吗？',{icon:3,offset:'50px'},function(index){
                    var index = layer.load(1, {
                        shade: [0.1,'#fff'] //0.1透明度的白色背景
                    });

                    E.ajax({
                        type:'post',
                        url:'/mf/interface/del',
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
               
    }

    </script>

@endsection

