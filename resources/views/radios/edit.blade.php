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
                <form class="form-horizontal" action="{{URL::to('radio/'.$radio->id)}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "page_title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="put">
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">标题</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="标题" value="{{$radio->name}}">
                                @include('layouts.message.tips',['field'=>'name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="img_url" class="col-sm-3 control-label">展示图</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="img_url" name="img_url" placeholder="展示图" value="{{$radio->img_url}}">
                                @include('layouts.message.tips',['field'=>'img_url'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="content" class="col-sm-3 control-label">内容</label>
                            <div class="col-sm-8">
                                <div id="container" name="container" class="edui-default">
                                    @include('UEditor::head')
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">所属APP</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="d_or_p">
                                    <option value="d" @if($radio->d_or_p=="d") selected @endif>医生端</option>
                                    <option value="p" @if($radio->d_or_p=="p") selected @endif>患者端</option>
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
        还没
    </script>
    <script>
        var ue=UE.getEditor("container");
        ue.ready(function(){
            //因为Laravel有防csrf防伪造攻击的处理所以加上此行
            ue.execCommand('serverparam','_token','{{ csrf_token() }}');
        });
        ue.addListener("ready", function () {
            ue.setContent('{{$banner->content}}', false);
            ue.setHeight('400'); //高度400
        });
    </script>
@stop