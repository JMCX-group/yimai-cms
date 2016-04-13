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
                <form class="form-horizontal" action="{{URL::to('tag')}}" method="post" enctype="multipart/form-data">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$page_title or "page_title"}}</h3>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                    </div>
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">科室</label>
                            <div class="col-sm-9">
                                <select id="dept_id" class="form-control select2" name="dept_id" style="min-height: 480px;">
                                    <option value="0" selected>无</option>
                                    @foreach($dept_standards as $dept_standard)
                                        @if($dept_standard->parent_id == 0)
                                            <option value="{{$dept_standard->id}}">{{$dept_standard->name}}</option>
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
                                        @if($dept_standard->parent_id == 0)
                                            <option value="{{$dept_standard->id}}" parent_id="0">{{$dept_standard->name}}</option>
                                        @else
                                            <option value="{{$dept_standard->id}}" parent_id="{{$dept_standard->parent_id}}">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp{{$dept_standard->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @include('layouts.message.tips',['field'=>'dept_lv2_id'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label">特长标签</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name" placeholder="特长标签" value="{{old('name')}}">
                                @include('layouts.message.tips',['field'=>'name'])
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">热度</label>
                            <div class="col-sm-9">
                                <select class="form-control select2" name="hot">
                                    <option value="0" selected>0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                                @include('layouts.message.tips',['field'=>'hot'])
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
