@extends('layouts.app')

@section('content')
<div class="container">

    {{-- 顶部工具栏 --}}
    <div class="row page-title-row">
        <div class="col-md-6">
            <h3 class="pull-left">上传</h3>
            <div class="pull-left">
                <ul class="breadcrumb">
                    @foreach ($breadcrumbs as $path => $disp)
                        <li><a href="{{ url('/admin/upload').'?folder='. $path }}">{{ $disp }}</a></li>
                    @endforeach
                    <li class="active">{{ $folderName }}</li>
                </ul>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#modal-folder-create">
                <i class="fa fa-plus-circle"></i> 新建目录
            </button>
            <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#modal-file-upload">
                <i class="fa fa-upload"></i> 上传
            </button>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">

            @include('admin.partials.errors')
            @include('admin.partials.success')

            <table id="uploads-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>文件名</th>
                        <th>类型</th>
                        <th>日期</th>
                        <th>大小</th>
                        <th data-sortable="false">操作</th>
                    </tr>
                </thead>
                <tbody>

                {{-- 子目录 --}}
                @foreach ($subfolders as $path => $name)
                    <tr>
                        <td>
                            <a href="{{ url('/admin/upload').'?folder='. $path }}">
                                <i class="fa fa-folder fa-lg fa-fw"></i>
                                {{ $name }}
                            </a>
                        </td>
                        <td>目录</td>
                        <td>-</td>
                        <td>-</td>
                        <td>
                            <button type="button" class="btn btn-xs btn-danger" onclick="delete_folder('{{ $name }}')">
                                <i class="fa fa-times-circle fa-lg"></i>
                                删除
                            </button>
                         </td>
                    </tr>
                @endforeach

                {{-- 所有文件 --}}
                @foreach ($files as $file)
                    <tr>
                        <td>
                            <a href="{{ $file['webPath'] }}">
                                @if (is_image($file['mimeType']))
                                <i class="fa fa-file-image-o fa-lg fa-fw"></i>
                                @else
                                <i class="fa fa-file-o fa-lg fa-fw"></i>
                                @endif
                                {{ $file['name'] }}
                            </a>
                        </td>
                        <td>{{ $file['mimeType'] or '未知' }}</td>
                        <td>{{ $file['modified']->format('j-M-y g:ia') }}</td>
                        <td>{{ human_filesize($file['size']) }}</td>
                        <td>
                            <button type="button" class="btn btn-xs btn-danger" onclick="delete_file('{{ $file['name'] }}')">
                                <i class="fa fa-times-circle fa-lg"></i>
                                删除
                            </button>

                            @if (strpos($folder,'alllist'))
                                <button type="button" class="btn btn-xs btn-primary" onclick="loadManager('{{ $folder.'/'.$file['name'] }}')">
                                    <i class="fa fa-plus-circle fa-lg"></i>
                                    导入管理员等信息
                                </button>
                            @endif

                            @if (strpos($folder,'arealist'))
                                <button type="button" class="btn btn-xs btn-success" onclick="loadArea('{{ $folder.'/'.$file['name'] }}')">
                                    <i class="fa fa-plus-circle fa-lg"></i>
                                    导入区域
                                </button>
                            @endif
                            @if (strpos($folder,'typelist'))
                                <button type="button" class="btn btn-xs btn-success" onclick="loadType('{{ $folder.'/'.$file['name'] }}')">
                                    <i class="fa fa-plus-circle fa-lg"></i>
                                    导入类型
                                </button>
                            @endif
                             @if (strpos($folder,'funclist'))
                                <button type="button" class="btn btn-xs btn-success" onclick="loadFunc('{{ $folder.'/'.$file['name'] }}')">
                                    <i class="fa fa-plus-circle fa-lg"></i>
                                    导入功能
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>
</div>

@include('admin.upload._modals')

@stop

@section('scripts')
<script>

    // 确认文件删除
    function delete_file(name) {
        $("#delete-file-name1").html(name);
        $("#delete-file-name2").val(name);
        $("#modal-file-delete").modal("show");
    }

    // 确认目录删除
    function delete_folder(name) {
        $("#delete-folder-name1").html(name);
        $("#delete-folder-name2").val(name);
        $("#modal-folder-delete").modal("show");
    }

    // 导入管理员等信息
    function loadManager(path) {
        $("#alllist_filename").val(path);
        $("#modal-alllist-import").modal("show");
    }
    // 导入区域信息
    function loadArea(path) {
        $("#arealist_filename").val(path);
        $("#modal-arealist-import").modal("show");
    }
    // 导入类型信息
    function loadType(path) {
        $("#typelist_filename").val(path);
        $("#modal-typelist-import").modal("show");
    }
    // 导入功能信息
    function loadFunc(path) {
        $("#funclist_filename").val(path);
        $("#modal-funclist-import").modal("show");
    }
    // 初始化数据
    $(function() {
        $("#uploads-table").DataTable();
    });
</script>
@stop