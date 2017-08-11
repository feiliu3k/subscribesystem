@extends('layouts.app')

@section('styles')
    <link href="{{ URL::asset('vendor/datetimepicker/bootstrap-datetimepicker.min.css')  }}" rel="stylesheet" />
@stop

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-12">
                <h3>{{ config('subscribesystem.detail') }} <small>» 新建</small></h3>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">自动生成{{ config('subscribesystem.detail') }}窗口</h3>
                    </div>
                    <div class="panel-body">
                    
                        @include('partials.errors')

                        <form class="form-horizontal" role="form" method="POST" action="{{ route('detail.postAutoGenDetail') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            @include('admin.productdetail._autogenform')

                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button type="submit" class="btn btn-primary btn-md">
                                        <i class="fa fa-plus-circle"></i>
                                        自动生成{{ config('subscribesystem.detail') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script id="use-time-template"  type="text/template">
        <div class="form-group usetime">
            <label for="usebegintime" class="col-md-3 control-label">
                使用时间范围
            </label>        
            <div class="col-md-3">
                <div class="input-group date usebegintime">
                    <input type="text" class="form-control" name="usebegintime[]" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>   
            <div class="col-md-3">
                <div class="input-group date useendtime">
                    <input type="text" class="form-control" name="useendtime[]" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-md btn-danger btn-delete-usetime"><i class="fa fa-times-circle"></i>删除</button>
                <button type="button" class="btn btn-md btn-success btn-add-usetime"><i class="fa fa-plus-circle"></i>添加</button>
            </div>
        </div> 
    </script>


@stop
@section('scripts')
    <script type="text/javascript"
     src="{{ URL::asset('vendor/datetimepicker/moment-with-locales.js')  }}">
    </script>
	<script type="text/javascript"
     src="{{ URL::asset('vendor/datetimepicker/bootstrap-datetimepicker.min.js')  }}">
    </script>

    <script type="text/javascript">
        $(function () {
            $('#usebegindate').datetimepicker({
                        locale: 'zh-CN',
                        format: 'YYYY-MM-DD'
                    });
            $('#useenddate').datetimepicker({
                        locale: 'zh-CN',
                        format: 'YYYY-MM-DD'
                    });
            $('.usebegintime').datetimepicker({
                        locale: 'zh-CN',
                        format: 'HH:mm:ss'
                    });
            $('.useendtime').datetimepicker({
                        locale: 'zh-CN',
                        format: 'HH:mm:ss'
                    });
            $('.checkbox input').iCheck({
                checkboxClass: 'icheckbox_flat-red',
            });
            //add usetime
            $('.usetimes').on('click','.btn-add-usetime',function(){
                var template=$('#use-time-template');
                var usetime=$(this).parents('.usetime').first();
                usetime.after(template.html());
                usetime.next().find('.usebegintime').datetimepicker({
                        locale: 'zh-CN',
                        format: 'HH:mm:ss'
                    });
                usetime.next().find('.useendtime').datetimepicker({
                        locale: 'zh-CN',
                        format: 'HH:mm:ss'
                    });
            });
 
                        //delete usetime
            $('.usetimes').on('click','.btn-delete-usetime',function(){
                var template=$('#use-time-template').html();
                $(this).parents('.usetime').remove();
            });
        });
    </script>

@stop