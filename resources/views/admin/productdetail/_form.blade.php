
    <input type="hidden" name="id"  id="id" value="{{ $product->id }}" >
    <div class="form-group">
        <label for="productname" class="col-md-3 control-label">
            {{ config('subscribesystem.product') }}名称
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="productname" name="productname" value="{{ $product->productname }}">
        </div>
    </div>
    <div class="form-group">
        <label for="usedate" class="col-md-3 control-label">
            使用日期
        </label>
        <div class="col-md-8 input-append date" id="usedate">
            <div class="input-group">
                <input type="text" data-format="yyyy-MM-dd" class="form-control" name="usedate"   value="{{ $detail->usedate }}" >
                <span class="input-group-addon add-on">
                    <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="fa fa-calendar">
                    </i>
                </span>
            </div>
        </div>        
    </div>
    <div class="form-group">
        <label for="usebegintime" class="col-md-3 control-label">
            使用开始时间
        </label>
        <div class="col-md-8 input-append date" id="usebegintime">
            <div class="input-group">
                <input type="text" data-format="hh:mm:ss" class="form-control" name="usebegintime"   value="{{ $detail->usebegintime }}" >
                <span class="input-group-addon add-on">
                    <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="fa fa-clock-o">
                    </i>
                </span>
            </div>
        </div>        
    </div>
    <div class="form-group">
        <label for="useendtime" class="col-md-3 control-label">
            使用结束时间
        </label>
        <div class="col-md-8 input-append date" id="useendtime">
            <div class="input-group">
                <input type="text" data-format="hh:mm:ss" class="form-control" name="useendtime"   value="{{ $detail->useendtime }}" >
                <span class="input-group-addon add-on">
                    <i data-time-icon="icon-time" data-date-icon="icon-calendar" class="fa fa-clock-o">
                    </i>
                </span>
            </div>
        </div> 
    </div>
    <div class="form-group">
        <label for="productprice" class="col-md-3 control-label">
            价格
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="productprice"  id="productprice" value="{{ $detail->productprice }}" >
        </div>        
    </div>
    <div class="form-group">
        <label for="productnum" class="col-md-3 control-label">
            总数量
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="productnum"  id="productnum" value="{{ $detail->productnum }}" >
        </div>        
    </div>
    <div class="form-group">
        <label for="ordernum" class="col-md-3 control-label">
            已预定数量
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="ordernum"  id="ordernum" value="{{ $detail->ordernum }}" >
        </div>        
    </div>
    <div class="form-group">
        <label for="paynum" class="col-md-3 control-label">
            已消费数量
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="paynum"  id="paynum" value="{{ $detail->paynum }}" >
        </div>        
    </div>
    <div class="form-group">
        <label for="maxordernum" class="col-md-3 control-label">
            可预定的最大数量
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="maxordernum"  id="maxordernum" value="{{ $detail->maxordernum }}" >
        </div>        
    </div>
