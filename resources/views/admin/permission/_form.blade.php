<div class="form-group">
    <label for="permissionname" class="col-md-3 control-label">
        名称
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="permissionname" id="permissionname" value="{{ $permission->permissionname }}">
    </div>
</div>
<div class="form-group">
    <label for="permissionlabel" class="col-md-3 control-label">
        标签
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="permissionlabel" id="permissionlabel" value="{{ $permission->permissionlabel }}">
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-md-3 control-label">
        描述
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="description" id="description" value="{{ $permission->description }}">
    </div>
</div>