    <div class="form-group">
        <label for="productname" class="col-md-3 control-label">
            {{ config('subscribesystem.product') }}名称
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="productname" name="productname" value="{{ $product->productname }}">
        </div>
    </div>
    <div class="form-group">
        <label for="productimg" class="col-md-3 control-label">
            封面
        </label>
        <div class="col-md-6">
            <input type="text" class="form-control" name="productimg"  id="productimg" value="{{ $product->productimg }}" >
        </div>
        <div class="col-md-2 thumb-wrap">
            <div class="img-upload btn btn-block btn-info btn-flat" title="点击上传">点击上传</div>
        </div>
    </div>
    <div class="form-group">
        <label for="companyname" class="col-md-3 control-label">
            {{ config('subscribesystem.company') }}名称
        </label>
        <div class="col-md-8">
            <input type="text" class="form-control" id="companyname" name="companyname" value="{{ Auth::user()->company->companyname }}" readonly>
        </div>
    </div>    
    <div class="form-group">
        <label for="area_id" class="col-md-3 control-label">
            区域
        </label>
        <div class="col-md-8">
            <select name="area_id" id="area_id" class="form-control" >
                @foreach ($areas as $area)
                    @if ($product->areaname_id==$area->id)
                        <option value="{{ $area->id }} " selected="selected">
                            {{ $area->areaname }}
                        </option>
                    @else
                        <option value="{{ $area->id }} ">
                            {{ $area->areaname }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="producttype_id" class="col-md-3 control-label">
            类型
        </label>
        <div class="col-md-8">
            <select name="producttype_id" id="producttype_id" class="form-control" >
                @foreach ($productTypes as $productType)
                    @if ($product->producttype_id==$productType->id)
                    <option value="{{ $productType->id }} " selected="selected">
                        {{ $productType->typename }}
                    </option>
                    @else
                    <option value="{{ $productType->id }} ">
                        {{ $productType->typename }}
                    </option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="productfunction" class="col-md-3 control-label">
            功能
        </label>
        <div class="col-md-8">
            <select id="product-function" name="productFunction_ids[]" multiple="multiple"  class="form-control" >
                @foreach ($productFunctions as $productFunction)
                    @if (($product->functions) && ($product->functions->contains($productFunction)))
                    <option value="{{ $productFunction->id }} " selected="selected">
                        {{ $productFunction->functionname }}
                    </option>
                    @else
                    <option value="{{ $productFunction->id }} ">
                        {{ $productFunction->functionname }}
                    </option>
                    @endif
                @endforeach               
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="productAddress" class="col-md-3 control-label">
            地址
        </label>
        <div class="col-md-8">
        @if ($product->address)
            <input type="text" class="form-control" id="productAddress" name="productAddress" value="{{ $product->address->productaddress }}">
        @else
            <input type="text" class="form-control" id="productAddress" name="productAddress">
        </div>
    </div>
    <div class="form-group">
        <label for="productexplain" class="col-md-3 control-label">
            内容简介
        </label>
        <div class="col-md-8">
            <script id="productexplain" name="productexplain" type="text/plain" style="width:100%;height:300px;">{!! $product->productexplain !!}</script>
        </div>
    </div>


