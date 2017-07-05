@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>{{ config('subscribesystem.detail') }} <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('detail.create', $product->id) }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新建{{ config('subscribesystem.detail') }}
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">

                @include('partials.errors')
                @include('partials.success')

                <table id="details-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>编号</th>
                            <th>{{ config('subscribesystem.product') }}名称</th>
                            <th>使用日期</th>
                            <th>使用开始时间</th>   
                            <th>使用结束时间</th>
                            <th>价格</th>
                            <th>总数量</th>
                            <th>已预定数量</th>
                            <th>已消费数量</th>
                            <th>可已预定最大数量</th>    
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @foreach ($details as $detail)
                        <tr>
                            <th>{{ $detail->id }}</th>
                            <th>{{ $detail->product->productname }}</th>
                            <th>{{ $detail->usedate }}</th>
                            <th>{{ $detail->usebegintime }}</th>   
                            <th>{{ $detail->useendtime }}</th>
                            <th>{{ $detail->productprice }}</th>
                            <th>{{ $detail->productnum }}</th>
                            <th>{{ $detail->ordernum }}</th>
                            <th>{{ $detail->paynum }}</th>
                            <th>{{ $detail->maxordernum }}</th>
                            <td>
                                <a href="{{ route('detail.edit', [$detail->productifo_id, $detail->id]) }}" class="btn btn-xs btn-info">
                                    <i class="fa fa-edit"></i> 编辑
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
            $("#details-table").DataTable({
            });
        });
    </script>
@stop