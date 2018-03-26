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
                    <a href="javascript:void(0);"><span>个人设置</span></a>
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

                  

                </div>

            </div>
        </div>

    </div>

@endsection

@section('js')

    <script>
       
    </script>

@endsection

