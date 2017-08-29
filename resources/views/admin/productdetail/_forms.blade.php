
    <input type="hidden" name="id"  id="id" value="{{ $product->id }}" >
    <div class="form-group">
        <label for="productname" class="col-md-3 control-label">
            {{ config('subscribesystem.product') }}名称
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="productname" name="productname" value="{{ $product->productname }}" readonly>
        </div>
    </div>
    <div class="form-group">
		<label for="usebegindate" class="col-md-3 control-label">
			使用日期范围
		</label>
		<div class="col-md-4">
			<div class="input-group date" id="usebegindate">
				<input type="text" class="form-control" name="usebegindate">
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>
		<div class="col-md-4">
			<div class="input-group date" id="useenddate">
				<input type="text" class="form-control" name="useenddate">
				<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
				</span>
			</div>
		</div>
	</div>
    <div class="form-group">
        <label class="col-md-3 control-label">
            选中需要添加星期
        </label>
        <div class="col-md-8">
            <div class="checkbox" >
                <label>
                    <input  type="checkbox" name="weeks[]" value=1>
                    星期一
                </label>
                <label>
                    <input  type="checkbox" name="weeks[]" value=2>
                    星期二
                </label>
                <label>
                    <input  type="checkbox" name="weeks[]" value=3>
                    星期三
                </label>
                <label>
                    <input  type="checkbox" name="weeks[]" value=4>
                    星期四
                </label>
                <label>
                    <input  type="checkbox" name="weeks[]" value=5>
                    星期五
                </label>
                <label>
                    <input  type="checkbox" name="weeks[]" value=6>
                    星期六
                </label>
                <label>
                    <input  type="checkbox" name="weeks[]" value=0>
                    星期日
                </label>
            </div>
        </div>
    </div>
    <div class="usetimes">
        <div class="form-group usetime">
            <label for="usebegintime" class="col-md-3 control-label">
                使用时间范围
            </label>        
            <div class="col-md-3">
                <div class="input-group date usebegintime">
                    <input type="text" class="form-control" name="usebegintime[]" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>   
            <div class="col-md-3">
                <div class="input-group date useendtime">
                    <input type="text" class="form-control" name="useendtime[]" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-time"></span>
                    </span>
                </div>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-danger btn-delete-usetime"><i class="fa fa-times-circle"></i>删除</button>
                <button type="button" class="btn btn-success btn-add-usetime"><i class="fa fa-plus-circle"></i>添加</button>
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
            <input type="text" class="form-control" name="ordernum"  id="ordernum" value="{{ $detail->ordernum }}" readonly>
        </div>
    </div>
    <div class="form-group">
        <label for="paynum" class="col-md-3 control-label">
            已消费数量
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" name="paynum"  id="paynum" value="{{ $detail->paynum }}" readonly>
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