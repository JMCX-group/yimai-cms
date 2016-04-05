<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/4/5
 * Time: 下午1:50
 */
?>

@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <form class="form-horizontal" action="{{URL::to('menu')}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "Page Title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">父级菜单</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="parent_id">
                                    <option value="0">/</option>
                                    @foreach($tree as $menu)
                                        <option value="{{$menu->id}}" @if(old('parent_id') == $menu->id) selected @endif >{{$menu->html}}{{$menu->name}}</option>
                                    @endforeach
                                </select>
                                @include('layouts.message.tips',['field'=>'parent_id'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">菜单名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="菜单名称" value="{{old('name')}}">
                                @include('layouts.message.tips',['field'=>'name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url" class="col-sm-3 control-label">菜单地址</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="url" name="url" placeholder="Controller.method" value="{{old('url')}}">
                                @include('layouts.message.tips',['field'=>'url'])
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="button" class="btn btn-default" onclick="javascript:history.back(-1);return false;">
                            返回
                        </button>
                        <button type="submit" class="btn btn-danger pull-right">确 定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
