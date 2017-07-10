@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>{{ config('subscribesystem.buyrecord') }} <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('buyrecord.search') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 搜索{{ config('subscribesystem.buyrecord') }}
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('partials.errors')
                @include('partials.success')

                <table id="buyrecords-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>                           
                            <th>客户账号</th> 
                            <th>{{ config('subscribesystem.product') }}名称</th>
                            <th>预定日期</th>
                            <th>开始时间</th> 
                            <th>下单时间</th> 
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($buyrecords as $buyrecord)
                        <tr>                                                       
                            <td>{{ $buyrecord->customer->customeraccount }}</td>
                            <td>{{ $buyrecord->product->productname }}</td>
                            <td>{{ $buyrecord->detail->usedate }}</td>
                            <td>{{ $buyrecord->detail->usebegintime }}</td>                            
                            <td>{{ $buyrecord->buytime }}</td>                           
                            <td>
                                <a href="{{ route('buyrecord.edit', $buyrecord->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 编辑
                                </a>
                                <a href="{{ route('buyrecord.consumpt', $buyrecord->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 确认
                                </a>
                                <a href="{{ route('buyrecord.overdue', $buyrecord->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 过期
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(function() {
            $("#buyrecords-table").DataTable({
            });
        });
    </script>
@stop