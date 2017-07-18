<div class="form-group">
    <label for="customername" class="col-md-3 control-label">
        名称
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="customername" name="customername" value="{{ $customer->customername }}" required autofocus>
    </div>
</div>

<div class="form-group">
    <label for="customeraccount" class="col-md-3 control-label">
        账号
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="customeraccount" name="customeraccount" value="{{ $customer->customeraccount }}" required autofocus>
    </div>
</div>

<div class="form-group">
    <label for="cellphone" class="col-md-3 control-label">
        电话
    </label>
    <div class="col-md-8">
        <input type="text" class="form-control" id="cellphone" name="cellphone" value="{{ $customer->cellphone }}">
    </div>
</div>

<div class="form-group">
    <label for="email" class="col-md-3 control-label">
        电子邮件
    </label>
     <div class="col-md-8">
        <input type="text" class="form-control" id="email" name="email" value="{{ $customer->email }}">
    </div>
</div>

<div class="form-group">
    <label for="IDCard" class="col-md-3 control-label">
        身份证
    </label>
     <div class="col-md-8">
        <input type="text" class="form-control" id="IDCard" name="IDCard" value="{{ $customer->IDCard }}">
    </div>
</div>

<div class="form-group">
    <label for="credit" class="col-md-3 control-label">
        信用
    </label>
     <div class="col-md-8">
        <input type="text" class="form-control" id="credit" name="credit" value="{{ $customer->credit }}">
    </div>
</div>

<div class="form-group">
    <label for="frmale" class="col-md-3 control-label">
        性别
    </label>
    <div class="col-md-8"> 
        <label class="radio-inline">
            <input type="radio" name="sex" id="frmale" value="1" @if ($customer->sex==1) checked="checked" @endif > 女
        </label>
        <label class="radio-inline">
            <input type="radio" name="sex" id="male" value="2"  @if ($customer->sex==2) checked="checked" @endif> 男
        </label>
    </div>
</div>