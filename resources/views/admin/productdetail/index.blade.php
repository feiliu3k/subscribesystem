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

                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal-search">
                    <i class="fa fa-plus-circle"></i> 搜索{{ config('subscribesystem.detail') }}
                </button>

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
        {{-- 搜索框 --}}
    <div class="modal fade" id="modal-search" tabIndex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">请输入查询条件</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('product.search') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <label for="productname" class="col-md-3 control-label">
                                {{ config('subscribesystem.product') }}名称
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="productname" name="productname">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="areaname_id" class="col-md-3 control-label">
                                区域
                            </label>
                            <div class="col-md-8">
                                <select name="areaname_id" id="areaname_id" class="form-control" >
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }} ">
                                            {{ $area->areaname }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="producttype_id" class="col-md-3 control-label">
                                类型
                            </label>
                            <div class="col-md-8">
                                <select name="producttype_id" id="producttype_id" class="form-control" >
                                    @foreach ($productTypes as $productType)                   
                                    <option value="{{ $productType->id }} ">
                                        {{ $productType->typename }}
                                    </option>                    
                                    @endforeach
                                </select>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-3 ">
                                <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-times-circle"></i> 提交
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
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