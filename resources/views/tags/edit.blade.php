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
                <form class="form-horizontal" action="{{URL::to('tag/'.$tag->id)}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "page_title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <input type="hidden" name="_method" value="put">
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">科室</label>
                            <div class="col-sm-9">
                                <select id="dept_id" class="form-control select2" name="dept_id" style="min-height: 480px;">
                                    <option value="0" selected>无</option>
                                    @foreach($dept_standards as $dept_standard)
                                        @if($dept_standard->parent_id == 0)
                                            <option value="{{$dept_standard->id}}" @if($dept_standard->id == $tag->dept_id)) selected @endif>{{$dept_standard->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @include('layouts.message.tips',['field'=>'dept_id'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">二级科室</label>
                            <div class="col-sm-9">
                                <select id="dept_lv2_id" class="form-control select2" name="dept_lv2_id" style="min-height: 480px;">
                                    <option value="0" selected>无</option>
                                    @foreach($dept_standards as $dept_standard)
                                        @if($dept_standard->parent_id == $tag->dept_id)
                                            <option value="{{$dept_standard->id}}" parent_id="{{ $tag->dept_id }}" @if($dept_standard->id == $tag->dept_lv2_id)) selected @endif>{{$dept_standard->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @include('layouts.message.tips',['field'=>'dept_lv2_id'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">特长标签</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="特长标签" value="{{$tag->name}}">
                                @include('layouts.message.tips',['field'=>'name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">热度</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="hot">
                                    <option value="0" @if($tag->hot == "0")) selected @endif>0</option>
                                    <option value="1" @if($tag->hot == "1")) selected @endif>1</option>
                                    <option value="2" @if($tag->hot == "2")) selected @endif>2</option>
                                </select>
                                @include('layouts.message.tips',['field'=>'hot'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">状态</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="status" title="状态">
                                    <option value="已核实" @if($tag->status=="已核实") selected @endif>已核实</option>
                                    <option value="待核实" @if($tag->status=="待核实") selected @endif>待核实</option>
                                    <option value="已拒绝" @if($tag->status=="已拒绝") selected @endif>已拒绝</option>
                                    <option value="已删除" @if($tag->status=="已删除") selected @endif>已删除</option>
                                </select>
                                @include('layouts.message.tips',['field'=>'status'])
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-default" href="{{route('tag.index')}}">返回</a>
                        <button type="submit" class="btn btn-danger pull-right">确 定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@extends('tags.js')
