    <div class="form-group">
        <label for="customername" class="col-md-3 control-label">
            {{ config('subscribesystem.customer') }}名称
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="customer" name="customer" value="{{ $buyrecord->customer->customername }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="customeraccount" class="col-md-3 control-label">
            {{ config('subscribesystem.customer') }}账号
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="customeraccount" name="customeraccount" value="{{ $buyrecord->customer->customeraccount }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for=companyname" class="col-md-3 control-label">
            {{ config('subscribesystem.company') }}名称
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="companyname" name="companyname" value="{{ $buyrecord->company->companyname }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="productname" class="col-md-3 control-label">
            {{ config('subscribesystem.product') }}名称
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="productname" name="productname" value="{{ $buyrecord->product->productname }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="usedate" class="col-md-3 control-label">
            预订日期
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="usedate" name="usedate" value="{{ $buyrecord->detail->usedate }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="usebegintime" class="col-md-3 control-label">
            预订开始时间
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="usebegintime" name="usebegintime" value="{{ $buyrecord->detail->usebegintime }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="useendtime" class="col-md-3 control-label">
            预订结束时间
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="useendtime" name="useendtime" value="{{ $buyrecord->detail->useendtime }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="buytime" class="col-md-3 control-label">
            下单日期
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="buytime" name="buytime" value="{{ $buyrecord->buytime }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="buyproductnum" class="col-md-3 control-label">
            预订数量
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="buyproductnum" name="buyproductnum" value="{{ $buyrecord->buyproductnum }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="buytoken" class="col-md-3 control-label">
            预订token
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="buytoken" name="buytoken" value="{{ $buyrecord->buytoken }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-8 col-md-offset-3">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="cancelflag" {{ $buyrecord->cancelflag ? 'checked' : '' }}> 取消预订
               </label>            
                <label>        
                    <input type="checkbox" name="consumptionflag" {{ $buyrecord->consumptionflag ? 'checked' : '' }}> 消费标志
               </label>            
                <label>
                    <input type="checkbox" name="overdueflag" {{ $buyrecord->overdueflag ? 'checked' : '' }}> 过期标志
                </label>
            </div>
        </div>
    </div>
   