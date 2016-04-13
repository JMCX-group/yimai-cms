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
        <div class="col-md-1">
            <div class="small-box">
                <a href="{{URL::to('tag/create')}}" class="btn btn-success">新增标签</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">标签列表</h3>
                    <div class="box-tools pull-right">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control pull-right" placeholder="快速查询">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-default disabled">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <tr>
                            <th>标签编号</th>
                            <th>科室</th>
                            <th>二级科室</th>
                            <th>特长标签</th>
                            <th>热度</th>
                            <th>状态</th></th>
                            <th>管理操作</th>
                        </tr>
                        @forelse($tags as $tag)
                            <tr>
                                <td>{{$tag->id}}</td>
                                <td>{{$tag->dept_name}}</td>
                                <td>{{$tag->dept_lv2_name}}</td>
                                <td>{{$tag->name}}</td>
                                <td>{{$tag->hot}}</td></td>
                                <td>{{$tag->status}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{URL::to('tag/'.$tag->id.'/edit')}}">
                                        编辑
                                    </a>
                                    <button class="btn btn-danger" data-toggle="modal" data-target="#defalutModal" data-url="{{URL::to('tag/'.$tag->id)}}">
                                        删除
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">暂无数据</td>
                            </tr>
                        @endforelse
                    </table>
                </div>

                @if($tags->render() !== "")
                    <div class="box-footer">
                        {!! $tags->render() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('layouts.model.default',['model_title'=>'操作提示','model_content'=>'你确定要删除这个标签吗?'])
@stop
@section('script')
    <script type="text/javascript">
        $('#defalutModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var url = button.data('url');
            var modal = $(this);

            modal.find('form').attr('action', url);
        })
    </script>
@stop