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
                            <label for="prompt" class="col-sm-3 control-label">提示</label>
                            <div class="col-sm-9">
                                <p class="help-block">广播将会进行全员推送，请慎重发出！！标题是手机顶部弹出提示的内容</p>
                            </div>
                        </div>

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
                                {{--<input type="text" class="form-control" id="img_url" name="img_url" placeholder="展示图" value="{{old('img_url')}}">--}}
                                {{--@include('layouts.message.tips',['field'=>'img_url'])--}}

                                {{--<div id="focus_img">--}}
                                {{--<div id="image-holder"></div>--}}
                                {{--</div>--}}
                                <div class="btn btn-default btn-file">
                                    <i class="fa fa-paperclip" id="upload_focus_img_icon">上传展示图</i>
                                    <input name="upload_focus_img" id="upload_focus_img" type="file" />
                                </div>
                                <p class="help-block">需要长750 * 400大小的图片； 如果不上传将展示默认图片</p>
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
                                    <option value="d">医生端</option>
                                    <option value="p">患者端</option>
                                </select>
                                @include('layouts.message.tips',['field'=>'d_or_p'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">广播给企业版/AppStore</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="e_or_a">
                                    <option value="enterprise">企业版</option>
                                    <option value="app">AppStore</option>
                                </select>
                                @include('layouts.message.tips',['field'=>'e_or_a'])
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
    <script>
        var ue=UE.getEditor("container");
        ue.ready(function(){
            //因为Laravel有防csrf防伪造攻击的处理所以加上此行
            ue.execCommand('serverparam','_token','{{ csrf_token() }}');
        });
        ue.addListener("ready", function () {
            ue.setHeight('400'); //高度400
        });

        $("#upload_focus_img").on('change', function () {
            $("#upload_focus_img_icon").text($("#upload_focus_img").val()) ;

//            if(typeof (FileReader)!="undefined"){
//                var image_holder = $("#image-holder");
//                image_holder.empty();
//
//                var reader = new FileReader();
//                reader.onload = function (e) {
//                    $("<img />", {
//                        "src" : e.target.result,
//                        "class" : "cover_small"
//                    }).appendTo(image_holder);
//                };
//            }else{
//                alert("您的浏览器不支持H5特性，无法看到图片预览");
//            }
        });
    </script>
@stop
