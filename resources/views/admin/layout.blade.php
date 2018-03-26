<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>魔方后台</title>
    <link href="/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/libs/bootstrap-table-master/dist/bootstrap-table.min.css">
    <link rel="stylesheet" href="/libs/bootstrap-select/dist/css/bootstrap-select.css">
    <link href="/libs/iCheck/skins/square/blue.css" rel="stylesheet">
    <link rel="stylesheet" href="/libs/kindeditor/themes/default/default.css?v=20140227" type="text/css" media="screen" />

    <style>

        body { margin:0;font-size: 12px;font-family: Helvetica, STHeiti, "Microsoft YaHei", Verdana, Arial, Tahoma, sans-serif; background: #f2f2f2; position:relative;}
        ol, ul {
            list-style: none;
        }
        .red {
            color: #ff0000;
        }

        #wrapper {
            margin: 10px;
            padding: 15px;
            background: #fff;
            min-height: 500px;
        }

        .ui-nav ul:after {
            content: "";
            display: table;
            clear: both;
        }
        .app-third-sidebar {
            position: relative;
            height: 50px;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            background: #fff;
            border-bottom: 1px solid #e5e5e5;
            -webkit-transition: padding-right 0.5s;
            -moz-transition: padding-right 0.5s;
            transition: padding-right 0.5s;
        }
        .ui-nav {
            position: relative;
            border-bottom: none;
            margin-bottom: 0;
            display: block;
        }
        .ui-nav ul {
            zoom: 1;
            margin-bottom: 0;
            margin-left: 1px;
            padding: 0;
        }
        .ui-nav li {
            float: left;
        }
        .ui-nav li a {
            height: 50px;
            padding: 0 20px;
            min-width: 0;
            border: none;
            background: transparent;
            font-size: 14px;
            color: #666666;
            line-height: 48px;
            text-align: center;
            display: inline-block;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }
        .ui-nav li span {
            display: inline-block;
        }

        .ui-nav li.active span {
            color: #333;
            border-bottom: 2px solid #0099FC;
        }

        .top-back {
            float: right;
            position: absolute;
            right: 20px;
            top: 8px;
        }

        /* bootstrap */
        .page-header {
            margin: 0;
        }
        h4 {
            margin-top: 0;
        }
        .col-md-10 {
            text-align: right;
        }
        .form-horizontal {
            margin-top: 20px;
            padding-right: 15px;
            padding-left: 15px;
        }

    </style>

    @yield('css')

</head>

<body>

@yield('content')

</body>

<script src="/libs/jquery/jquery-2.2.2.min.js"></script>
<script src="/libs/layer/layer.js"></script>
<script src="/libs/layui/layui.js?v=20170413" charset="utf-8"></script>
<script src="/libs/bootstrap-table-master/dist/bootstrap-table.min.js?v=20161202"></script>
<script src="/libs/bootstrap-table-master/dist/bootstrap-table.js?v=20161202"></script>
<script src="/libs/bootstrap-table-master/dist/locale/bootstrap-table-zh-CN.js"></script>
<script src="/libs/bootstrap-select/dist/js/bootstrap-select.js"></script>
<script src="/libs/bootstrap/js/bootstrap.min.js"></script>
<script src="/libs/ebsig/base.js?v=20170206"></script>
<script src="/libs/iCheck/icheck.js"> </script>
<script src="/libs/kindeditor/kindeditor-all.js?v=20141124" type="text/javascript"> </script>
<script src="/libs/kindeditor/lang/zh_CN.js" type="text/javascript"></script>
<script>
    //时间插件
    layui.use(['laydate']);
</script>
@yield('js')

</html>