<?php
/**
 * Created by PhpStorm.
 * User: lyx
 * Date: 16/3/23
 * Time: 上午11:30
 */
?>

@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-1">
            <div class="small-box">
                <a href="{{URL::to('push/create')}}" class="btn btn-success">新建Banner</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Banner</h3>
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
                            <th>序号</th>
                            <th>标题</th>
                            <th>头图</th>
                            <th>医/患</th>
                            <th>状态</th>
                            <th>管理操作</th>
                        </tr>
                        @forelse($banners as $banner)
                            <tr>
                                <td>{{$banner->id}}</td>
                                <td>{{$banner->name}}</td>
                                <td><img src="{{$banner->focus_img_url}}" style="width: 150px;"></td>
                                <td>{{$banner->d_or_p}}</td>
                                <td>{{$banner->status}}</td>
                                <td>
                                    <a class="btn btn-info" href="{{URL::to('pushs/banner-edit/'.$banner->id)}}">
                                        编辑
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">暂无数据</td>
                            </tr>
                        @endforelse
                    </table>
                </div>

                @if($banners->render() !== "")
                    <div class="box-footer">
                        {!! $banners->render() !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
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
