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
                    <a href="javascript:void(0);"><span>服务器列表</span></a>
                </li>
            </ul>

        </nav>
    </div>

    <div id="wrapper">

        <div class="row">
            <div class="col-lg-12">
                {{--<div class="row">
                    <div class="col-md-8">
                        <button class="btn btn-success" type="button" onclick="app.edit(0);">添加应用信息</button>
                    </div>
                </div>--}}
                <div class="row">
                    <div class="col-md-2">
                        <button class="btn btn-success" type="button" onclick="server.edit(0);">添加服务器</button>
                    </div>
                    <div class="col-md-10">
                        <form class="form-inline" id="search-form" onsubmit="return false;">

                            <div class="input-group">

                                <input type="text" style="width: 160px;" id="server" name="server" class="form-control"  placeholder="请输入服务器地址">

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
                <table id="table"></table>
            </div>
        </div>

    </div>

@endsection

@section('js')

    <script>
         var permissions='{!!Session::get('permissions')!!}';

        var bootstrap_table_ajax_url = '/mf/server/search';
        $('#table').bootstrapTable({
            classes: 'table table-hover', //bootstrap的表格样式
            sidePagination: 'server', //获取数据方式【从服务器获取数据】
            toolbar: '#toolbar', //工具按钮用哪个容器
            pagination: true, //分页
            height: $(window).height() - 120, //表格高度
            pageNumber: 1, //页码【第X页】
            pageSize: 50, //每页显示多少条数据
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
                { title: 'ID', field: 'id', align: 'left', sortable : true },
                { title: '添加时间',  field: 'created_at', align: 'center' },
                { title: '别名',  field: 'alias', align: 'center' },
                { title: '服务器地址',  field: 'server', align: 'center' },
                { title: '用户名',  field: 'username', align: 'center' },
                { title: '服务器端口',  field: 'server_port', align: 'center' },
                { title: '加密方式',  field: 'encrypt_method', align: 'center' },
                { title: '传输协议',  field: 'protocol', align: 'center' },
                { title: '混淆插件',  field: 'obfs', align: 'center' },
                { title: 'KcpTun',  field: 'kcp_enable', align: 'center' },
                { title: '自动切换',  field: 'switch_enable', align: 'center' },
                { title: '工作模式',  field: 'product_type', align: 'center' },
                { title: '操作',  field: 'operating', align: 'left' },
            ]
        });

        var server = {
            edit : function (id) {
                if(permissions==2){
                    layer.alert('你没有此权限',{icon:2,offset:'50px',time:2000});

                }else{
                    layer.open( {
                        title: false ,
                        type: 2 ,
                        area: ['100%', '100%'] ,
                        scrollbar: false ,
                        offset: '0px' ,
                        closeBtn: 0,
                        content: '/mf/server/add/page/' + id,

                    } );

                }
            },

            /*刷新表单*/
            refresh: function () {
                $('#table').bootstrapTable('refresh');
            },

            del : function (id) {
                 if(permissions==2){
                    layer.alert('你没有此权限',{icon:2,offset:'50px',time:2000});

                }else{
                    layer.confirm('您确定删除该服务器信息吗？',{icon:3,offset:'50px'},function(index){
                        var index = layer.load(1, {
                            shade: [0.1,'#fff'] //0.1透明度的白色背景
                        });

                        E.ajax({
                            type:'get',
                            url:'/mf/server/delete/'+id,
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
            }
        }


    </script>

@endsection

