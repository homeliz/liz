@extends('admin.layout')

@section('css')
    <style>
        html { overflow-x:hidden; overflow-y:auto; }
    </style>
@endsection

@section('content')

    <div id="wrapper" style="min-height: auto;">

        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-12">
                        <form class="form-inline pull-right" id="search-form" onsubmit="return false;">

                            <div class="form-group">
                                <input type="text" style="width: 160px;"  class="form-control" id="alias" name="alias" placeholder="请输入别名">
                            </div>

                            <div class="input-group">
                                <input type="text" class="form-control" name="server" id="server" style="width: 145px;" placeholder="请输入ip">
                                <span class="input-group-btn">
                                    <button class="btn btn-default"  onclick="plugin.search()" type="button">查询</button>
                                    <button class="btn btn-warning"  onclick="plugin.resets()" type="button">重置</button>
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
                <form class="form-horizontal" style="margin-top: 0px;" role="form">
                    <table class="table table-bordered" id="table">

                    </table>
                </form>
            </div>
            <div  class="col-lg-12" id="paging-box"></div>
        </div>

        <div class="search-box" style="bottom: 0;width: 100%;margin-bottom: 30px;padding: 10px;z-index:1000;">
            <div style="float:right;margin-right:343px;">
                <button type="button" class="btn btn-primary" id="server-choose-btn" >选择</button>
                &nbsp;&nbsp;<button type="button" class="btn btn-default" id="server-cancel-btn">关闭</button>
            </div>
        </div>

    </div>

@endsection

@section('js')
    <script>

        var sids  = '{!!$sids!!}';
        var mac_id  =  '{!!$mac_id!!}';
        var product_type  =  '{!!$product_type!!}';
        sids=JSON.parse(sids);
         $(window).ready(function () {
            $('.square-radio').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
           
            $(document).on('click', '#server-choose-btn', function () { //  点击选择按钮
                var select_sid = new Array();
                if ( $(':checked') ) {
                     $(':checked').each(function(){
                        select_sid.push($(this).attr('id'));
                    });
                    parent.mac.doSetServer(mac_id,select_sid,product_type);
                    plugin.close();
                } else {
                    layer.alert('最少选择一个服务器', {icon: 2, offset: '70px'});
                    return false;
                }
            }).on('click' , '#server-cancel-btn' , function() {                            //关闭
                plugin.close();
            }).on('click', '.pagination a', function(){      //点击分页事件
                var page = $(this).attr('data-paging');
                if (page) {
                    plugin.search(page);
                }
            }).on( 'ifClicked', 'input[name=all_server]', function ( ) {  //全选全不选

                var box = $('.server');

                if ( $(this).is(':checked') ) {      //全不选
                    box.iCheck('uncheck') ;
                } else {   //全选
                    box.iCheck('check') ;
                }

            }).on( 'ifChanged', '.server', function ( ) {   //当所有都选中时或者取消时 改变全选/全不选状态

                var id = parseInt($(this).val());
                if ( $(this).is(':checked') == true ) {   //选中
                    if ( sids.indexOf( id ) == -1 )   {   //不在在数组中
                        sids.push(id);

                    }

                } else {     
                    if ( sids.indexOf( id ) !== -1 )   {   //在数组中
                        sids.splice($.inArray(id,sids),1);
                        
                    }
                }

                var boxs = $('.server') ;
                if ( boxs.filter(':checked').length == boxs.length ) {
                    $('.all_server').iCheck('check') ;
                } else {
                    $('.all_server').iCheck('uncheck') ;
                }

            });

            plugin.search(1);
        });

        var  plugin = {

            search : function($page){

                var page    = $page ? $page : 1;
                var param   = E.getFormValues('search-form');
                param.page  = page;
                param.sort  = 'id';
                param.order = 'DESC';
                param.rid = mac_id;
                // if ( group_id != 0 ) {
                //     param.group_id = group_id;
                // }

                E.ajax({
                    type : 'get',
                    url :'/mf/router/setServer/'+product_type,
                    data : param,
                    success: function( obj ) {
                        var html = '';
                        var htmls = '';
                        html += '<thead>';
                        html += '<tr>';
                        html += '<th>ID</th>';
                        html += '<th>别名</th>';
                        html += '<th>服务器地址</th>';
                        html += '<th>服务器端口</th>';
                        html += '<th style="text-align: center;padding-bottom: 0px;padding-top: 0px;padding-left: 0px;padding-right: 0px;border-left-width: 0px;border-bottom-width: 1‒;border-right-width: 0px;border-top-width: 1px;border-bottom-width: 2px; ">';
                        html += '<span style="display : inline-block; width: 50px; margin-bottom: 0px;overflow: hidden;height:22px;">';
                        html += '<input type="checkbox" class="square-radio all_server" name="all_server" >&ensp;全选/全不选</span>';
                        html += '</th>';
                        html += '</tr>';
                        html += '</thead>';
                        html += '<tbody>';
                        if (obj.total > 0) {
                            for (var i in obj.rows) {
                                html += '<tr id="server_content_'+obj.rows[i]['id']+'" align="center">';
                                html += '<td >'+obj.rows[i]['id']+'</td>';  //id
                                html += '<td>'+obj.rows[i]['alias']+'</td>';  //IP地址
                                html += '<td >'+obj.rows[i]['server']+'</td>'; //服务器IP地址
                                html += '<td >'+obj.rows[i]['server_port']+'</td>';  //服务器端口
                                html += '<td style="text-align: center; " class="last">';
                                html += '<span style="display : inline-block; width: 100px; margin-bottom: 0px;overflow: hidden;height:22px;">';
                                    if(jQuery.inArray(obj.rows[i]['id'], obj.rid)!=-1){
                                        html += '<input type="checkbox" class="square-radio server" id="'+obj.rows[i]['id']+'" name="server" value="'+obj.rows[i]['id']+'" checked>&ensp;请选择';
                                    } else {
                                        html += '<input type="checkbox" class="square-radio server" id="'+obj.rows[i]['id']+'" name="server" value="'+obj.rows[i]['id']+'" >&ensp;请选择';
                                    }


                                html += '</span>';
                                html += '</td>';
                                html += '</tr>';

                            }


                            if (obj.link) {
                                htmls += obj.link;
                            }


                        }
                        html += '</tbody>';

                        if( obj.total == 0) {

                            html += '<tbody>';
                            html += '<tr>';
                            html += '<th colspan="7" style="text-align: center; ">未查找到数据</th>';
                            html += '<tr>';
                            html += '</tbody>';

                            $('#table').html(html);
                        }

                        $('#table').html(html);
                        $('#paging-box').html(htmls);


                        $('.square-radio').iCheck({
                            checkboxClass: 'icheckbox_square-blue',
                            radioClass: 'iradio_square-blue',
                            increaseArea: '20%' // optional
                        });

                    }
                });
            },
            //关闭
            close: function () {
                var index = parent.layer.getFrameIndex(window.name);
                parent.layer.close(index);
            },

            resets: function () {   //重置
                $('#server').val('');
                $('#alias').val('');
                plugin.search();
                
            }
        
           
        }
           
    </script>

@endsection
