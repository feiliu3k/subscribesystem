@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>地址 <small>» 编辑</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">编辑地址窗口</h3>
                </div>
                <div class="panel-body">

                    @include('partials.errors')
                    @include('partials.success')

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('product.postProductAddress', $product->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">                        
                        <input type="hidden" name="id" value="{{ $product->id }}">

                        <div class="form-group">
                            <label for="productaddress" class="col-md-3 control-label">
                                地址
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="productaddress" id="productaddress" @if ($product->address) value="{{ $product->address->productaddress }}" @endif>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="longitude" class="col-md-3 control-label">
                                经度
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="longitude" id="longitude"  @if ($product->address) value="{{ $product->address->longitude }}" @endif>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="latitude" class="col-md-3 control-label">
                                纬度
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" name="latitude" id="latitude"  @if ($product->address) value="{{ $product->address->latitude }}" @endif>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    <i class="fa fa-save"></i>
                                    保存
                                </button>
                                <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#modal-delete">
                                    <i class="fa fa-times-circle"></i>
                                    删除
                                </button>    
                                <a type="button" class="btn btn-primary btn-md" href="{{ route('product.index') }}">
                                    <i class="fa fa-reply"></i>
                                    返回
                                </a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

{{-- 确认删除 --}}
<div class="modal fade" id="modal-delete" tabIndex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    ×
                </button>
                <h4 class="modal-title">请确认修改</h4>
            </div>
            <div class="modal-body">
                <p class="lead">
                    <i class="fa fa-question-circle fa-lg"></i>
                    是否真的需要删除此地址？
                </p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ route('product.destoryProductAddress', $product->id) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">                    
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-times-circle"></i> 确认
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@stop