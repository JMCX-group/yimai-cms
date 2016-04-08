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
                <form class="form-horizontal" action="{{URL::to('user/'.$user->id)}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "Page_title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="put">
                    </div>
                    <div class="box-body">
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">用户角色</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" multiple="multiple" name="role_id[]" style="width: 100%">
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}" @if(in_array($role->display_name,$displayNames)) selected @endif>{{$role->display_name}}</option>
                                    @endforeach
                                </select>
                                @include('layouts.message.tips',['field'=>'role_id'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">用户名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="用户名称" value="{{$user->name}}">
                                @include('layouts.message.tips',['field'=>'name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">用户邮箱</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email" name="email" placeholder="用户邮箱" value="{{$user->email}}">
                                @include('layouts.message.tips',['field'=>'email'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-3 control-label">用户密码</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="password" name="password" placeholder="用户密码">
                                @include('layouts.message.tips',['field'=>'password'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation" class="col-sm-3 control-label">确认密码</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="确认密码" value="{{$user->password_confirmation}}">
                                @include('layouts.message.tips',['field'=>'password_confirmation'])
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-default" onclick="javascript:history.back('{{route('user.index')}}');return false;">
                            返回
                        </button>
                        <button type="submit" class="btn btn-danger pull-right">确 定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
