@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>{{ config('subscribesystem.buyrecord') }} <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('buyrecord.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新建{{ config('subscribesystem.buyrecord') }}
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('partials.errors')
                @include('partials.success')

                <table id="products-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>编号</th>
                            <th>{{ config('subscribesystem.product') }}名称</th>
                            <th>预定日期</th>
                            <th>开始时间</th>   
                            <th>结束时间</th>
                            <th>客户姓名</th> 
                            <th>预定时间</th> 
                            <th>预定数量</th>
                            <th>预定token</th> 
                            <th>预定数量</th>
                            <th>消费标志</th> 
                            <th>过期标志</th>                 
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($buyrecords as $buyrecord)
                        <tr>
                            <td>{{ $buyrecord->id }}</td>
                            <td>{{ $buyrecord->product->productname }}</td>
                            <td>{{ $buyrecord->detail->usedate }}</td>
                            <td>{{ $buyrecord->detail->usebegintime }}</td>
                            <td>{{ $buyrecord->detail->useendtime }}</td>
                            <td>{{ $buyrecord->customer->typename }}</td>
                            <td>{{ $product->area->areaname }}</td>
                            <td>
                                <a href="{{ route('product.edit', $product->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 编辑
                                </a>

                                <a href="{{ route('product.getProductAddress', $product->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 地址
                                </a>

                                <a href="{{ route('detail.index', $product->id) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 细节
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
            $("#products-table").DataTable({
            });
        });
    </script>
@stop