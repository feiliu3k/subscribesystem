@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/upload.css') }}" >
    <link href="{{ URL::asset('vendor/select2/css/select2.min.css')}}" rel="stylesheet" />
@stop

@section('content')
<div class="container">
    <div class="row page-title-row">
        <div class="col-md-12">
            <h3>{{ config('subscribesystem.product') }} <small>» 新建</small></h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">新建{{ config('subscribesystem.product') }}窗口</h3>
                </div>
                <div class="panel-body">
                
                    @include('partials.errors')

                    <form class="form-horizontal" role="form" method="POST" action="{{ route('product.store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        @include('admin.product._form')

                        <div class="form-group">
                            <div class="col-md-7 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-md">
                                    <i class="fa fa-plus-circle"></i>
                                    添加新{{ config('subscribesystem.product') }}
                                </button>
                            </div>
                        </div>
                    </form>
                 </div>
             </div>
        </div>
    </div>

    <div class="upload-mask">
    </div>
    <div class="panel panel-info upload-file">
        <div class="panel-heading">
            上传文件
            <span class="close pull-right">关闭</span>
        </div>
        <div class="panel-body">
            <div id="validation-errors"></div>
            <form method="POST" action="{{ url('admin/dash/uploadImgFile') }}" id="imgForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label>文件上传</label>
                    <span class="require">(*)</span>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input id="thumb" name="file" type="file"  required="required">
                    <input id="filetype"  type="hidden" name="filetype" value="">
                </div>
            </form>
        </div>
        <div class="panel-footer">
        </div>
    </div>
</div>

@stop
@section('scripts')
	<script type="text/javascript" charset="utf-8" src="{{ URL::asset('vendor/ueditor/ueditor.config.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::asset('vendor/ueditor/ueditor.all.js') }}"></script>
    <script type="text/javascript" charset="utf-8" src="{{ URL::asset('vendor/ueditor/lang/zh-cn/zh-cn.js') }}"></script>
	<script src="{{ URL::asset('js/jquery.form.js') }}"></script>
    <script src="{{ URL::asset('vendor/select2/js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('vendor/select2/js/i18n/zh-CN.js') }}"></script>

    <script type="text/javascript">  

        try{
            if (editor) {editor.destroy();}
        }
        finally {
            var editor = new UE.ui.Editor();
            editor.ready(function() {
                editor.execCommand( 'fontfamily', '微软雅黑' );
            });
            editor.render("productexplain");
        }


        $(function() {
            
            $("#product-function").select2({
                tags: true,
            });

            //上传图片相关

            $('.upload-mask').on('click',function(){
                $(this).hide();
                $('.upload-file').hide();
            });

            $('.upload-file .close').on('click',function(){
                $('.upload-mask').hide();
                $('.upload-file').hide();
            });


            $('.img-upload').on('click',function(){
                $('.upload-mask').show();
                $('.upload-file').show();

                $('#filetype').attr('value','image');
            });

            $('.adimg-upload').on('click',function(){
                $('.upload-mask').show();
                $('.upload-file').show();

                $('#filetype').attr('value','adimg');
            });

            //ajax 上传
            $(document).ready(function() {
                var options = {
                    beforeSubmit:  showRequest,
                    success:       showResponse,
                    dataType: 'json'
                };
                $('#imgForm input[name=file]').on('change', function(){
                    //$('#upload-avatar').html('正在上传...');
                    $('#imgForm').ajaxForm(options).submit();
                });
            });

            function showRequest() {
                $("#validation-errors").hide().empty();
                $("#output").css('display','none');
                return true;
            }

            function showResponse(response)  {
                if(!response.success)
                {
                    var responseErrors = response.errors;

                    $("#validation-errors").append('<div class="alert alert-error"><strong>'+ responseErrors +'</strong><div>');

                    $("#validation-errors").show();
                } else {

                    $('.upload-mask').hide();
                    $('.upload-file').hide();
                    
                    if (response.filetype=='image'){
                        $("#productimg").val(response.src);
                    }

                    if (response.filetype=='adimg'){
                        $("#adimg").val(response.src);
                    }

                }
            }

        });

    </script>

@stop