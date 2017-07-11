@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>{{ config('subscribesystem.badrecord') }} <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('badrecord.search') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 搜索{{ config('subscribesystem.badrecord') }}
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('partials.errors')
                @include('partials.success')

                <table id="badrecords-table" class="table table-striped table-bordered">
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
                    @foreach ($badrecords as $badrecord)
                        <tr>                                                       
                            <td>{{ $badrecord->customer->customeraccount }}</td>
                            <td>{{ $badrecord->product->productname }}</td>
                            <td>{{ $badrecord->detail->usedate }}</td>
                            <td>{{ $badrecord->detail->usebegintime }}</td>                            
                            <td>{{ $badrecord->buytime }}</td>                           
                            <td>
                                <a href="{{ route('badrecord.edit', $badrecord->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 编辑
                                </a>
                                <a href="{{ route('badrecord.consumpt', $badrecord->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 确认
                                </a>
                                <a href="{{ route('badrecord.overdue', $badrecord->id) }}" class="btn btn-xs btn-info">
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
            $("#badrecords-table").DataTable({
            });
        });
    </script>
@stop