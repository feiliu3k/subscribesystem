@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>客户 <small>» 新建</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">新建客户窗口</h3>
                </div>
                <div class="panel-body">

                    @include('partials.errors')

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('customer.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('admin.customer._form')

                        <div class="form-group">
                            <label for="newpassword" class="col-md-3 control-label">
                                密码
                            </label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="newpassword" name="newpassword">
                            </div>
                        </div>    
 
                        <div class="form-group">
                            <label for="newpassword_confirmation" class="col-md-3 control-label">
                                确认新密码
                            </label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="newpassword_confirmation" id="newpassword_confirmation" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    <i class="fa fa-plus-circle"></i>
                                    添加客户
                                </button>
                            </div>
                        </div>

                    </form>

                 </div>
             </div>
        </div>
    </div>
</div>
@stop