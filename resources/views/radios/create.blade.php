<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/3/30
 * Time: 下午3:32
 */
?>

@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-10">
            <div class="box box-info">
                <form class="form-horizontal" action="{{URL::to('radio')}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "page_title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">标题</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="title" name="title" placeholder="标题" value="{{old('title')}}">
                                @include('layouts.message.tips',['field'=>'title'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img_url" class="col-sm-3 control-label">展示图</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="img_url" name="img_url" placeholder="展示图" value="{{old('img_url')}}">
                                @include('layouts.message.tips',['field'=>'img_url'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-sm-3 control-label">内容</label>
                            <div class="col-sm-8">
                                <div id="container" class="edui-default">
                                    @include('UEditor::head')
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">所属APP</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="d_or_p">
                                    <option value="d">医生端</option>
                                    <option value="p">患者端</option>
                                </select>
                                @include('layouts.message.tips',['field'=>'d_or_p'])
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{route('radio.index')}}">返回</a>
                        <button type="submit" class="btn btn-danger pull-right">确 定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('script')
    <!-- 加载编辑器的容器 -->
    <script id="container" name="content" type="text/plain">

    </script>
    <script>
        var ue=UE.getEditor("container");
        ue.ready(function(){
            //因为Laravel有防csrf防伪造攻击的处理所以加上此行
            ue.execCommand('serverparam','_token','{{ csrf_token() }}');
        });
    </script>
@stop
