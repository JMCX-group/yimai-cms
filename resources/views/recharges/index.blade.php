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
                    <h3 class="box-title">充值列表</h3>
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
                            <th>患者姓名</th>
                            <th>患者手机号</th>
                            <th>充值总额</th>
                            <th>充值时间</th>
                            <th>充值状态</th>
                        </tr>
                        @forelse($records as $record)
                            <tr>
                                <td>{{$record->patient}}</td>
                                <td>{{$record->phone}}</td>
                                <td>{{($record->total_fee / 100) . '元'}}</td>
                                <td>{{$record->time_start}}</td>
                                @if($record->status == 'end')
                                    <td>已支付</td>
                                @elseif($record->status == 'start')
                                    <td>待支付</td>
                                @else
                                    <td>已取消</td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">暂无数据</td>
                            </tr>
                        @endforelse
                    </table>
                </div>

                @if($records->render() !== "")
                    <div class="box-footer">
                        {!! $records->render() !!}
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