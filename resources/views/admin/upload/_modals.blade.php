{{-- 新建目录 --}}
<div class="modal fade" id="modal-folder-create">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ url('/admin/upload/folder') }}" class="form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="folder" value="{{ $folder }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                    <h4 class="modal-title">新建目录</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="new_folder_name" class="col-sm-3 control-label">
                            目录名
                        </label>
                        <div class="col-sm-8">
                            <input type="text" id="new_folder_name" name="new_folder" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        取消
                    </button>
                    <button type="submit" class="btn btn-primary">
                        创建目录
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- 删除文件 --}}
<div class="modal fade" id="modal-file-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    ×
                </button>
                <h4 class="modal-title">请确认</h4>
            </div>
            <div class="modal-body">
                <p class="lead">
                    <i class="fa fa-question-circle fa-lg"></i>
                    是否要删除此
                    <kbd><span id="delete-file-name1">file</span></kbd>
                    文件?
                </p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ url('/admin/upload/file') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="folder" value="{{ $folder }}">
                    <input type="hidden" name="del_file" id="delete-file-name2">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        取消
                    </button>
                    <button type="submit" class="btn btn-danger">
                        删除文件
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- 删除目录 --}}
<div class="modal fade" id="modal-folder-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    ×
                </button>
                <h4 class="modal-title">请确认</h4>
            </div>
            <div class="modal-body">
                <p class="lead">
                    <i class="fa fa-question-circle fa-lg"></i>
                        是否要删除此
                        <kbd><span id="delete-folder-name1">folder</span></kbd>
                        目录?
                 </p>
            </div>
            <div class="modal-footer">
                <form method="POST" action="{{ url('/admin/upload/folder') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="folder" value="{{ $folder }}">
                    <input type="hidden" name="del_folder" id="delete-folder-name2">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        取消
                    </button>
                    <button type="submit" class="btn btn-danger">
                        删除目录
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- 上传文件 --}}
<div class="modal fade" id="modal-file-upload">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ url('/admin/upload/file') }}" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="folder" value="{{ $folder }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                    <h4 class="modal-title">上传文件</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="file" class="col-sm-3 control-label">
                            文件名
                        </label>
                        <div class="col-sm-8">
                            <input type="file" id="file" name="file">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file_name" class="col-sm-3 control-label">
                            可选文件名
                        </label>
                        <div class="col-sm-4">
                            <input type="text" id="file_name" name="file_name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        取消
                    </button>
                    <button type="submit" class="btn btn-primary">
                        上传文件
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- 浏览图片 --}}
<div class="modal fade" id="modal-image-view">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    ×
                </button>
                <h4 class="modal-title">图片预览</h4>
            </div>
            <div class="modal-body">
                <img id="preview-image" src="" class="img-responsive">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    取消
                </button>
            </div>
        </div>
    </div>
</div>

@if (strpos($folder,'alllist'))
{{-- 导入管理员等信息 --}}
<div class="modal fade" id="modal-alllist-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ url('/admin/loadManager') }}" class="form-horizontal" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                    <h4 class="modal-title">导入管理员等信息</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="alllist_filename" class="col-sm-3 control-label">
                            文件名
                        </label>
                        <div class="col-sm-8">
                            <input type="text" id="alllist_filename" name="alllist_filename" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        取消
                    </button>
                    <button type="submit" class="btn btn-primary">
                        导入
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (strpos($folder,'arealist'))
{{-- 导入区域信息 --}}
<div class="modal fade" id="modal-arealist-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ url('/admin/loadArea') }}" class="form-horizontal" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                    <h4 class="modal-title">导入区域信息</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="arealist_filename" class="col-sm-3 control-label">
                            文件名
                        </label>
                        <div class="col-sm-8">
                            <input type="text" id="arealist_filename" name="arealist_filename" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        取消
                    </button>
                    <button type="submit" class="btn btn-primary">
                        导入
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (strpos($folder,'typelist'))
{{-- 导入类型信息 --}}
<div class="modal fade" id="modal-typelist-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ url('/admin/loadType') }}" class="form-horizontal" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                    <h4 class="modal-title">导入类型信息</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="typelist_filename" class="col-sm-3 control-label">
                            文件名
                        </label>
                        <div class="col-sm-8">
                            <input type="text" id="typelist_filename" name="typelist_filename" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        取消
                    </button>
                    <button type="submit" class="btn btn-primary">
                        导入
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@if (strpos($folder,'funclist'))
{{-- 导入功能信息 --}}
<div class="modal fade" id="modal-funclist-import">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ url('/admin/loadFunc') }}" class="form-horizontal" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        ×
                    </button>
                    <h4 class="modal-title">导入功能信息</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="funclist_filename" class="col-sm-3 control-label">
                            文件名
                        </label>
                        <div class="col-sm-8">
                            <input type="text" id="funclist_filename" name="funclist_filename" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        取消
                    </button>
                    <button type="submit" class="btn btn-primary">
                        导入
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif
