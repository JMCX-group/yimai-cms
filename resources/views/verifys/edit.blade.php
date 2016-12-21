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
        <div class="col-md-6">
            <div class="box box-info">
                <form class="form-horizontal" action="{{URL::to('verify/'.$doctors->id)}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "page_title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="put">
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="city" class="col-sm-3 control-label">姓名</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="name" name="name" placeholder="无" value="{{$doctors->name}}">
                                @include('layouts.message.tips',['field'=>'name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-sm-3 control-label">手机号</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="phone" name="phone" placeholder="无" value="{{$doctors->phone}}">
                                @include('layouts.message.tips',['field'=>'phone'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-sm-3 control-label">头像</label>
                            <div class="col-sm-9">
                                <img src="{{$doctors->avatar}}" alt="image without thumbnail corners">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-sm-3 control-label">省市</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="city" name="city" placeholder="无" value="{{$doctors->province.' - '.$doctors->city}}">
                                @include('layouts.message.tips',['field'=>'city'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-sm-3 control-label">医院</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="hospital" name="hospital" placeholder="无" value="{{$doctors->hospital}}">
                                @include('layouts.message.tips',['field'=>'hospital'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-sm-3 control-label">科室</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="dept" name="dept" placeholder="无" value="{{$doctors->dept}}">
                                @include('layouts.message.tips',['field'=>'dept'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-sm-3 control-label">院校</label>
                            <div class="col-sm-9">
                                <input type="text" disabled="disabled" class="form-control" id="college" name="college" placeholder="无" value="{{$doctors->college}}">
                                @include('layouts.message.tips',['field'=>'college'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-sm-3 control-label">认证资料</label>
                            <div class="col-sm-9">
                                @foreach($doctors->auth_img as $item)
                                    <img src="{{$item}}" width="250px" style="margin-bottom:10px;" alt="image without thumbnail corners">
                                @endforeach
                                @include('layouts.message.tips',['field'=>'info'])
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{route('verify.todo')}}">返回</a>
                        <a class="btn btn-warning" href="{{URL::to('verify/refuse/'.$doctors->id)}}">拒绝</a>
                        <button type="submit" class="btn btn-primary pull-right">通 过</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
