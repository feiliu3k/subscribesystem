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

                <a href="{{ route('product.index') }}" class="btn btn-info btn-md">
                    <i class="fa fa-plus-circle"></i> {{ config('subscribesystem.product') }}首页
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
                <div class="pull-right">
                   {!! $products->appends([
                        'productname' => $searchCondition['productname'],
                        'areaname_id' => $searchCondition['areaname_id'],
                        'producttype_id' => $searchCondition['producttype_id'],
                        ])->render() 
                    !!}
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
@stop