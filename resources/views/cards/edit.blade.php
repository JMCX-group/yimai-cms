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
        <div class="col-md-8">
            <div class="box box-info">
                <form class="form-horizontal" action="{{URL::to('card/'.$doctors->id)}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "page_title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="put">
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">姓名</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="name" name="name" placeholder="无" value="{{$doctors->name}}">
                                @include('layouts.message.tips',['field'=>'name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-sm-3 control-label">手机号</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="phone" name="phone" placeholder="无" value="{{$doctors->phone}}">
                                @include('layouts.message.tips',['field'=>'phone'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="avatar" class="col-sm-3 control-label">头像</label>
                            <div class="col-sm-9">
                                <img src="{{$doctors->avatar}}" alt="image without thumbnail corners">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hospital" class="col-sm-3 control-label">医院</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="hospital" name="hospital" placeholder="无" value="{{$doctors->hospital}}">
                                @include('layouts.message.tips',['field'=>'hospital'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="dept" class="col-sm-3 control-label">科室</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="dept" name="dept" placeholder="无" value="{{$doctors->dept}}">
                                @include('layouts.message.tips',['field'=>'dept'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="title" class="col-sm-3 control-label">级别</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="title" name="title" placeholder="无" value="{{$doctors->title}}">
                                @include('layouts.message.tips',['field'=>'title'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-sm-3 control-label">收件地址</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="address" name="address" placeholder="无" value="{{$doctors->address}}">
                                @include('layouts.message.tips',['field'=>'address'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="addressee" class="col-sm-3 control-label">收件人</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="addressee" name="addressee" placeholder="无" value="{{$doctors->addressee}}">
                                @include('layouts.message.tips',['field'=>'addressee'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="receive_phone" class="col-sm-3 control-label">收件手机号</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="receive_phone" name="receive_phone" placeholder="无" value="{{$doctors->receive_phone}}">
                                @include('layouts.message.tips',['field'=>'receive_phone'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="express_no" class="col-sm-3 control-label">快递单号</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="express_no" name="express_no" placeholder="输入快递单号" value="">
                                @include('layouts.message.tips',['field'=>'express_no'])
                            </div>
                        </div>

                        <ul class="breadcrumb">
                            <li><a href="#">其他信息</a> <span class="divider"></span></li>
                        </ul>
                        <div class="form-group">
                            <label for="focus_img_url" class="col-sm-3 control-label"></label>
                            <div class="col-sm-9">
                                <p class="help-block"><strong style="color:red">注意：输入拒绝原因，提交将会拒绝此单内容。</strong>不输入直接提交则为同意。</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="refuse_info" class="col-sm-3 control-label" style="color:red">拒绝原因</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="refuse_info" name="refuse_info" placeholder="输入拒绝原因，该信息会提示用户" value="">
                                @include('layouts.message.tips',['field'=>'refuse_info'])
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{route('card.todo')}}">返回</a>
                        <button type="submit" class="btn btn-primary pull-right">提 交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
