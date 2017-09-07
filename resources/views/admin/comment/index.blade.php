@extends('layouts.app')

@section('styles')
    <link href="{{ URL::asset('vendor/datetimepicker/bootstrap-datetimepicker.min.css')  }}" rel="stylesheet" />
    <link href="{{ URL::asset('css/jrsx.css') }}" rel="stylesheet">    
    <link href="{{ URL::asset('css/lightbox.css') }}" rel="stylesheet">
@stop

@section('content')
    <div class="container">
        <div class="row page-title-row">
            <div class="col-md-6">
                <h3>{{ config('subscribesystem.comment') }} <small>» 列表</small></h3>
            </div>
            <div class="col-md-6 text-right">
                <button class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal-search">
                    <i class="fa fa-plus-circle"></i> 搜索{{ config('subscribesystem.comment') }}
                </button>

            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                @include('partials.errors')
                @include('partials.success')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="pull-right list-inline remove-margin-bottom topic-filter">
                            <li>
                                <i class="glyphicon glyphicon-time"></i> 评论列表
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    @if (count($comments)>0)
                        <div class="panel-body remove-padding-horizontal main-body">
                            <ul class="list-group row topic-list">
                                @foreach ($comments as $comment)
                                    <li class="list-group-item media 1" style="margin-top: 0px;">                       
                                        <div class="infos">
                                            <div class="add-margin-bottom">
                                            <span class="account">账号：{{ $comment->customer->customeraccount }}</span>
                                                <span> • </span>
                                                <span class="product">场地：{{ $comment->product->productname }}</span>
                                                <span> • </span>
                                                <span class="product">单位：{{ $comment->company->companyname }}</span>
                                                <span> • </span>
                                                <span class="sendtime">发表时间：{{ $comment->sendtime }}</span>
                                            </div>
                                            <div class="media-heading">
                                            {{ $comment->commentcontent }}
                                            </div>
                                            <div class="add-margin-bottom">
                                                @if (count($comment->commentimgs)>0)
                                                    @foreach ($comment->commentimgs as $img)
                                                        @if (!containsDescenders($img))
                                                            <img class="js-lightbox"
                                                            data-role="lightbox"
                                                            data-source="{{ config('subscribesystem.comment_path').$img }}"
                                                            src="{{ config('subscribesystem.comment_path').$img }}"
                                                            data-group="{{ $comment->id }}"
                                                            data-id="{{ $img }}"
                                                            data-caption="{{ $comment->customer->customername }}"
                                                            data-desc="{{ $comment->commentcontent }}"
                                                            alt="{{ $img }}"
                                                            width="100px" height="100px" />
                                                        @else
                                                            <img class="js-videobox"
                                                            data-role="videobox"
                                                            data-source="{{ config('subscribesystem.comment_path').$img }}"
                                                            src="{{ URL::asset('img/play.png') }}"
                                                            width="100px" height="100px" />
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>

                                            <div class="col-md-6 pull-right">
                                                @if (Auth::check())
                                                    <span class="operate pull-right">
                                                        <button type="button" class="btn btn-danger btn-xs btn-delete" data-ucid="{{ $comment->id }}" >
                                                            <i class="fa fa-times-circle"></i>
                                                            删除
                                                        </button>
                                                        <button type="button" class="btn btn-success btn-xs btn-verify" data-ucid="{{ $comment->id }}">
                                                            <i class="fa fa-check-square-o"></i>
                                                            @if ($comment->verifyflag==0)
                                                                通过
                                                            @else
                                                                取消
                                                            @endif
                                                        </button>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <div class="panel-body remove-padding-horizontal main-body">
                            <p>无评论数据</p>
                        </div>
                    @endif
                    <div class="panel-footer text-right">
                        {!! $comments->render() !!}
                    </div>
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
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('comment.search') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="productname" class="col-md-3 control-label">
                                {{ config('subscribesystem.product') }}名称
                            </label>
                            <div class="col-md-8">
                                <select name="product_id" id="product_id" class="form-control" >
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }} ">
                                            {{ $product->productname }}&nbsp&nbsp({{ $product->company->companyname }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="customeraccount" class="col-md-3 control-label">
                                {{ config('subscribesystem.customer') }}账号
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="customeraccount" name="customeraccount" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="content" class="col-md-3 control-label">
                                内容
                            </label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="content" name="content" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="begintime" class="col-md-3 control-label">
                                时间范围
                            </label>
                            <div class="col-md-4">
                                <div class="input-group datetime" id="begintime">
                                    <input type="text" class="form-control" name="begintime">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group datetime" id="endtime">
                                    <input type="text" class="form-control" name="endtime">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
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
    <script src="{{ URL::asset('js/lightbox.js') }}"></script>
    <script src="{{ URL::asset('js/videobox.js') }}"></script>
	<script type="text/javascript"
     src="{{ URL::asset('vendor/datetimepicker/moment-with-locales.js')  }}">
    </script>
	<script type="text/javascript"
     src="{{ URL::asset('vendor/datetimepicker/bootstrap-datetimepicker.min.js')  }}">
    </script>
    
    <script type="text/javascript">
    $(function () {
        var lightbox = new LightBox();
        var videobox = new VideoBox();
 
        $('#begintime').datetimepicker({
            locale: 'zh-CN',
            format: 'YYYY-MM-DD',
        });

        $('#endtime').datetimepicker({
            locale: 'zh-CN',
            format: 'YYYY-MM-DD',
        });

        $(".btn-delete").click(function(event) {
            var _self=this;
            var sure=confirm('你确定要删除吗?');
            if (sure){
                var ucid=$(this).attr("data-ucid");
                var liveid=$(this).attr("data-liveid");

                $.ajax({
                    type: 'POST',
                    url: '{{ url("admin/comment/destroy") }}',
                    data: {'ucid': ucid},
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        $(_self).parents("li").remove();
                        //window.location.href='{{ url("/news") }}/'+tipid;
                    },
                    error: function(xhr, type){
                        alert('删除评论失败！');
                    }
                });
            }
        });
        $(".btn-verify").click(function(event) {
            var _self=this;
            var ucid=$(this).attr("data-ucid");
            $.ajax({
                type: 'POST',
                url: '{{ url("admin/comment/verify") }}',
                data: {'ucid': ucid},
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    //window.location.href='{{ url("/news") }}/'+tipid;
                   if(data.verifyflag===0){
                        $(_self).html('<i class="fa fa-check-square-o"></i> 通过 ');
                   }else{
                        $(_self).html('<i class="fa fa-check-square-o"></i> 取消 ');
                   }
                },
                error: function(xhr, type){
                    alert('审核修改失败！');
                }
            });
        });

     });
    </script>
@stop
