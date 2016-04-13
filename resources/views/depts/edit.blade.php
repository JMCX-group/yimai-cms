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
                <form class="form-horizontal" action="{{URL::to('dept/'.$dept_standards->id)}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "page_title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="put">
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">一级科室</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="parent_id" style="min-height: 480px;">
                                    <option value="0" selected>无</option>
                                    @foreach($dept_lv1 as $dept)
                                        <option value="{{$dept->id}}" @if($dept->id == $dept_standards->parent_id) selected @endif>{{$dept->name}}</option>
                                    @endforeach
                                </select>
                                @include('layouts.message.tips',['field'=>'parent_id'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">科室名称</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="科室名称" value="{{$dept_standards->name}}">
                                @include('layouts.message.tips',['field'=>'name'])
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{route('dept.index')}}">返回</a>
                        <button type="submit" class="btn btn-danger pull-right">确 定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
