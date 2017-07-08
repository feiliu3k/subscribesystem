@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>{{ config('subscribesystem.product') }} <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('product.create') }}" class="btn btn-success btn-md">
                    <i class="fa fa-plus-circle"></i> 新建{{ config('subscribesystem.product') }}
                </a>           
                
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal-search">
                    <i class="fa fa-plus-circle"></i> 搜索{{ config('subscribesystem.product') }}
                </button>            
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
                            <th>单位</th>
                            <th>类型</th>   
                            <th>区域</th>               
                            <th data-sortable="false">操作</th>
                        </tr>
                     </thead>
                    <tbody>
                    @if ($products) 
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->productname }}</td>
                                <td>{{ $product->company->companyname }}</td>
                                <td>{{ $product->productType->typename }}</td>
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
                    @endif    
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
            $("#products-table").DataTable({
            });
        });
    </script>
    </script>
@stop