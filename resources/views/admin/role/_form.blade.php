<div class="form-group">
    <label for="rolename" class="col-md-3 control-label">
        名称
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="rolename" id="rolename" value="{{ $role->rolename }}" required autofocus>
    </div>
</div>
<div class="form-group">
    <label for="rolelabel" class="col-md-3 control-label">
        标签
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="rolelabel" id="rolelabel" value="{{ $role->rolelabel }}">
    </div>
</div>
<div class="form-group">
    <label for="description" class="col-md-3 control-label">
        描述
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" name="description" id="description" value="{{ $role->description }}">
    </div>
</div>
