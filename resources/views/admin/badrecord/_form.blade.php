    <div class="form-group">
        <label for="customername" class="col-md-3 control-label">
            {{ config('subscribesystem.customer') }}名称
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="customer" name="customer" value="{{ $badrecord->customer->customername }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="customeraccount" class="col-md-3 control-label">
            {{ config('subscribesystem.customer') }}账号
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="customeraccount" name="customeraccount" value="{{ $badrecord->customer->customeraccount }}" readonly>
        </div>
    </div>    
    <div class="form-group">
        <label for="productname" class="col-md-3 control-label">
            {{ config('subscribesystem.product') }}名称
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="productname" name="productname" value="{{ $badrecord->product->productname }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="usedate" class="col-md-3 control-label">
            预订日期
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="usedate" name="usedate" value="{{ $badrecord->detail->usedate }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="usebegintime" class="col-md-3 control-label">
            预订开始时间
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="usebegintime" name="usebegintime" value="{{ $badrecord->detail->usebegintime }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="useendtime" class="col-md-3 control-label">
            预订结束时间
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="useendtime" name="useendtime" value="{{ $badrecord->detail->useendtime }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="buytime" class="col-md-3 control-label">
            下单日期
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="buytime" name="buytime" value="{{ $badrecord->buytime }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="buyproductnum" class="col-md-3 control-label">
            预订数量
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="buyproductnum" name="buyproductnum" value="{{ $badrecord->buyproductnum }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="buytoken" class="col-md-3 control-label">
            预订token
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="buytoken" name="buytoken" value="{{ $badrecord->buytoken }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="cancelflag" {{ $badrecord->cancelflag ? 'checked' : '' }}> 取消预订
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="consumptionflag" {{ $badrecord->consumptionflag ? 'checked' : '' }}> 消费标志
                </label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="overdueflag" {{ $badrecord->overdueflag ? 'checked' : '' }}> 过期标志
                </label>
            </div>
        </div>
    </div>
