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
                <form class="form-horizontal" action="{{URL::to('college/'.$college->id)}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "page_title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="put">
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">院校名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="院校名称" value="{{$college->name}}">
                                @include('layouts.message.tips',['field'=>'name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">状态</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="status" title="状态">
                                    <option value="已核实" @if($college->status=="已核实") selected @endif>已核实</option>
                                    <option value="待核实" @if($college->status=="待核实") selected @endif>待核实</option>
                                    <option value="已拒绝" @if($college->status=="已拒绝") selected @endif>已拒绝</option>
                                    <option value="已删除" @if($college->status=="已删除") selected @endif>已删除</option>
                                </select>
                                @include('layouts.message.tips',['field'=>'status'])
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{route('college.index')}}">返回</a>
                        <button type="submit" class="btn btn-danger pull-right">确 定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
