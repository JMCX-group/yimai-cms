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
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">收入列表</h3>
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
                            <th>订单号</th>
                            <th>订单状态</th>
                            <th>收入类型</th>
                            <th>收入金额</th>
                        </tr>
                        @forelse($revenues as $revenue)
                            <tr>
                                <td>{{$revenue->appointment_id}}</td>
                                @if($revenue->status == 'completed')
                                    <td>已完成</td>
                                    <td>平台抽成</td>
                                    <td>{{$revenue->platform_fee}}</td>
                                @else
                                    <td>已取消</td>
                                    <td>违约金</td>
                                    <td>{{$revenue->default_fee}}</td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">暂无数据</td>
                            </tr>
                        @endforelse
                    </table>
                </div>

                @if($revenues->render() !== "")
                    <div class="box-footer">
                        {!! $revenues->render() !!}
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