<div class="form-group">
    <label for="managername" class="col-md-3 control-label">
        名称
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="managername" name="managername" value="{{ $manager->managername }}" required autofocus>
    </div>
</div>

<div class="form-group">
    <label for="manageraccount" class="col-md-3 control-label">
        账号
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="manageraccount" name="manageraccount" value="{{ $manager->manageraccount }}" required autofocus>
    </div>
</div>

<div class="form-group">
    <label for="cellphone" class="col-md-3 control-label">
        电话
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="cellphone" name="cellphone" value="{{ $manager->cellphone }}">
    </div>
</div>

<div class="form-group">
    <label for="email" class="col-md-3 control-label">
        电子邮件
    </label>
     <div class="col-md-8">
        <input type="text" class="form-control" id="email" name="email" value="{{ $manager->email }}">
    </div>
</div>

<div class="form-group">
    <label for="IDCard" class="col-md-3 control-label">
        身份证
    </label>
     <div class="col-md-8">
        <input type="text" class="form-control" id="IDCard" name="IDCard" value="{{ $manager->IDCard }}">
    </div>
</div>

<div class="form-group">
    <label for="application_note" class="col-md-3 control-label">
        申请说明
    </label>
     <div class="col-md-8">
        <input type="text" class="form-control" id="application_note" name="application_note" value="{{ $manager->application_note }}">
    </div>
</div>

<div class="form-group">
    <div class="col-md-8 col-md-offset-3">
        <div class="checkbox" >
            <label>
                <input  type="checkbox" id="verifyflag"  name="verifyflag" value=1 @if ($manager->verifyflag==1) checked="checked" @endif >
                审核标志
            </label>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="company_id" class="col-md-3 control-label">
        单位
    </label>
    <div class="col-md-8">
        <select name="company_id" id="company_id" class="form-control" >
        @foreach ($companies as $company)
            @if ($manager->company_id==$company->id)
            <option value="{{ $company->id }} " selected="selected">
                {{ $company->companyname }}
            </option>
            @else
            <option value="{{ $company->id }} ">
                {{ $company->companyname }}
            </option>
            @endif
        @endforeach
        </select>
    </div>
</div>
