<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Buyrecord;

use Auth;

class ProductDetailController extends Controller
{
    protected $_searchCondition = [
        'usebegindate'=>'',
        'useenddate'=>'',
        'usebegintime'=>'',
        'useendtime'=>'',
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $product = Product::where('delflag', 0);
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $product = $product->where('company_id', Auth::user()->company_id);
        }
        $product = $product->where('id', $id)
                            ->first();

        $details = ProductDetail::where('productifo_id',$id)
                                ->where('delflag',0)
                                ->orderBy('productifo_id','desc')
                                ->orderBy('id','desc')
                                ->paginate(config('subscribesystem.per_page'));
                                
        return view('admin.productdetail.index',compact('product','details'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        if (Gate::denies('create-detail')) {
            abort(403,'你无权进行此操作！');
        }
        $product = Product::where('delflag', 0);
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $product = $product->where('company_id', Auth::user()->company_id);
        }
        $product = $product->where('id', $id)
                            ->first();

        $detail = new ProductDetail();
        $detail->productnum=0;
        $detail->productprice=0;
        $detail->ordernum=0;
        $detail->paynum=0;
        $detail->maxordernum=1;

        return view('admin.productdetail.create',compact('product','detail'));
    }

    public function batCreate($id)
    {
        if (Gate::denies('create-detail')) {
            abort(403,'你无权进行此操作！');
        }
        $product = Product::where('delflag', 0);
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $product = $product->where('company_id', Auth::user()->company_id);
        }
        $product = $product->where('id', $id)
                            ->first();

        $detail = new ProductDetail();
        $detail->productnum=0;
        $detail->productprice=0;
        $detail->ordernum=0;
        $detail->paynum=0;
        $detail->maxordernum=1;

        return view('admin.productdetail.batCreate',compact('product','detail'));
    }

    public function ConditionDestory($id)
    {
        if (Gate::denies('create-detail')) {
            abort(403,'你无权进行此操作！');
        }
        $product = Product::where('delflag', 0);
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $product = $product->where('company_id', Auth::user()->company_id);
        }
        $product = $product->where('id', $id)
                            ->first();

        $detail = new ProductDetail();
        $detail->productnum=0;
        $detail->productprice=0;
        $detail->ordernum=0;
        $detail->paynum=0;
        $detail->maxordernum=1;

        return view('admin.productdetail.conditionDestory',compact('product','detail'));
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request, $id)
    {
        if (Gate::denies('create-detail')) {
            abort(403,'你无权进行此操作！');
        }        
        $this->validate($request, [
            'usedate' => 'required|string|max:255',
        ]);

        $product = Product::where('delflag', 0);
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $product = $product->where('company_id', Auth::user()->company_id);
        }
        $product = $product->where('id', $id)
                            ->first();
        
        $detail = new ProductDetail();

        $detail->productifo_id=$product->id;
        $detail->usedate = $request->usedate;
        $detail->usebegintime = $request->usebegintime;
        $detail->useendtime = $request->useendtime;
        $detail->productprice = $request->productprice;
        $detail->productnum = $request->productnum;
        $detail->ordernum = $request->ordernum;
        $detail->paynum = $request->paynum;
        $detail->maxordernum = $request->maxordernum;
        
        $detail->save();
        return redirect('/admin/product/'.$product->id.'/detail')
                        ->withSuccess("场地细节 '$product->productname' 创建成功.");
       
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function batStore(Request $request, $id)
    {
        if (Gate::denies('create-detail')) {
            abort(403,'你无权进行此操作！');
        }

        $usebegintimes=$request->usebegintime;
        $useendtimes=$request->useendtime;
        if ((count($usebegintimes)==0) || (count($usebegintimes)!=count($useendtimes))){
            return back()->withErrors("时间范围有错，请重新输入！");
        }

        $this->validate($request, [
            'usebegindate' => 'required|string|max:255',
            'useenddate' => 'required|string|max:255',
        ]);


        $product = Product::where('delflag', 0);
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $product = $product->where('company_id', Auth::user()->company_id);
        }
        $product = $product->where('id', $id)
                            ->first();
        
        $usebegindate=new Carbon($request->usebegindate);
        $useenddate=new Carbon($request->useenddate);
        
        $weeks=$request->weeks;


        $details=[]; 


        while ($usebegindate<=$useenddate) {
            $usedate=$usebegindate;
            $week= $usedate->dayOfWeek;
            if (empty($weeks)) {
                for ($i=0;$i<count($usebegintimes);$i++){
                    if (($usebegintimes[$i]) && ($useendtimes[$i])){                        
                        $detail = new ProductDetail();
                        $detail->productifo_id=$product->id;
                        $detail->usedate = $usedate->toDateString();
                        $detail->usebegintime = $usebegintimes[$i];
                        $detail->useendtime = $useendtimes[$i];
                        $detail->productprice = $request->productprice;
                        $detail->productnum = $request->productnum;
                        $detail->ordernum = $request->ordernum;
                        $detail->paynum = $request->paynum;
                        $detail->maxordernum = $request->maxordernum;
                        $details[]=$detail->attributesToArray();
                    }else{
                        return back()->withErrors("时间有错，请重新输入！");
                    }
                }
            } else if  (in_array($week,$weeks)) {
                for ($i=0;$i<count($usebegintimes);$i++){
                    if (($usebegintimes[$i]) && ($useendtimes[$i])){                        
                        $detail = new ProductDetail();
                        $detail->productifo_id=$product->id;
                        $detail->usedate = $usedate->toDateString();
                        $detail->usebegintime = $usebegintimes[$i];
                        $detail->useendtime = $useendtimes[$i];
                        $detail->productprice = $request->productprice;
                        $detail->productnum = $request->productnum;
                        $detail->ordernum = $request->ordernum;
                        $detail->paynum = $request->paynum;
                        $detail->maxordernum = $request->maxordernum;
                        $details[]=$detail->attributesToArray();
                    }else{
                        return back()->withErrors("时间有错，请重新输入！");
                    }
                }
            }
            $usebegindate=$usebegindate->addDay();
        }
        
        ProductDetail::insert($details);

        return redirect('/admin/product/'.$product->id.'/detail')
                        ->withSuccess("场地细节 '$product->productname' 创建成功.");
       
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $did)
    {
        $product = Product::where('delflag', 0);
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $product = $product->where('company_id', Auth::user()->company_id);
        }
        $product = $product->where('id', $id)
                            ->first();

        $detail = ProductDetail::where('delflag',0)
                                ->where('id', $did)
                                ->orderBy('id','desc')->first();

        if (Gate::denies('modify-detail',$detail)) {
            abort(403,'你无权进行此操作！');
        }                     

        return view('admin.productdetail.edit', compact('product', 'detail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $did)
    {
        $this->validate($request, [
            'usedate' => 'required|string|max:255',
        ]); 

        $product = Product::where('delflag', 0);
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $product = $product->where('company_id', Auth::user()->company_id);
        }
        $product = $product->where('id', $id)
                            ->first();

        
        $detail = ProductDetail::where('delflag',0)
                                ->where('id', $did)
                                ->orderBy('id','desc')->first();

        if (Gate::denies('modify-detail',$detail)) {
            abort(403,'你无权进行此操作！');
        }
        if (!$detail->buyrecords->isEmpty()){
            return back()->withErrors("已有预订，场地细节不能修改.");
        }

        $detail->productifo_id=$product->id;
        $detail->usedate = $request->usedate;
        $detail->usebegintime = $request->usebegintime;
        $detail->useendtime = $request->useendtime;
        $detail->productprice = $request->productprice;
        $detail->productnum = $request->productnum;
        $detail->ordernum = $request->ordernum;
        $detail->paynum = $request->paynum;
        $detail->maxordernum = $request->maxordernum;
        $detail->save();
        
        return redirect("/admin/product/$product->id/detail/$detail->id/edit")
                        ->withSuccess("场地细节 '$product->productname' 更新成功.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function Destory($id, $did)
    {
        $detail = ProductDetail::where('delflag',0)                                
                                ->where('id', $did)
                                ->orderBy('id','desc')->first();
        if (Gate::denies('delete-detail',$detail)) {
            abort(403,'你无权进行此操作！');
        }
        if (!$detail->buyrecords->isEmpty()){
            return back()->withErrors("已有预订，场地细节不能删除.");
        }
        $detail->delflag=1;
        $detail->save();

        return redirect("/admin/product/$detail->productifo_id/detail")
                        ->withSuccess("场地细节 '$did' 已经被删除.");
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function batDestory(Request $request, $id)
    {
        if (Gate::denies('create-detail')) {
            abort(403,'你无权进行此操作！');
        }
     
        $product = Product::where('delflag', 0);
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $product = $product->where('company_id', Auth::user()->company_id);
        }
        $product = $product->where('id', $id)
                            ->first();
        if (!$product){
            return redirect('/admin/product/'.$product->id.'/detail')
                    ->withErrors("场地细节 '$product->productname' 批量删除失败.");
        }

        $this->validate($request, [
            'usebegindate' => 'required|string|max:255',
            'useenddate' => 'required|string|max:255',
            'usebegintime' => 'required|string|max:255',
            'useendtime' => 'required|string|max:255',
        ]);

        $usebegindate=new Carbon($request->usebegindate);
        $useenddate=new Carbon($request->useenddate);
        $usebegintime=$request->usebegintime;
        $useendtime=$request->useendtime;    
       
        $weeks=$request->weeks;
        //查找出符合条件的detail
        $details = ProductDetail::where('productifo_id',$id)
                                ->whereBetween('usedate',[$usebegindate,$useenddate])
                                ->where('usebegintime','>=',$usebegintime)
                                ->where('useendtime','<=',$useendtime)
                                ->where('delflag',0)
                                ->get();
        //对符合条件的数据进行删除
        
        return redirect('/admin/product/'.$product->id.'/detail')
                        ->withSuccess("场地细节 '$product->productname' 批量删除成功.");
       
    }

    public function search(Request $request, $id)
    {   
        if (Gate::denies('list-detail')) {
            abort(403,'你无权进行此操作！');
        }
        $this->validate($request, [
            'usebegindate' => 'required|string|max:255',
            'useenddate' => 'required|string|max:255',            
        ]);

        $searchCondition=$this->_searchCondition;

        foreach (array_keys($this->_searchCondition) as $field) {
            $searchCondition[$field] = $request->get($field);
        }
        
        $product = Product::where('delflag', 0);
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $product = $product->where('company_id', Auth::user()->company_id);
        }
        $product = $product->where('id', $id)
                            ->first();

        $details = ProductDetail::where('productifo_id',$id)
                            ->whereBetween('usedate',[$searchCondition['usebegindate'],$searchCondition['useenddate']])
                            ->where('delflag',0);        

        if ($searchCondition['usebegintime']){
            $details=$details->where('usebegintime','>=', $searchCondition['usebegintime']);            
        }

        if ($searchCondition['useendtime']){
            $details=$details->where('useendtime','<=', $searchCondition['useendtime']);            
        }

        $details =$details->orderBy('usedate','desc') 
                            ->paginate(config('subscribesystem.per_page'));

        return view('admin.productdetail.search',compact('details', 'product', 'searchCondition'));
    }

    public function order($customer_id, $did)
    {
       
    }

    public function getAutoGenDetail()
    {
        if (Gate::denies('modify-manager')) {
            abort(403,'你无权进行此操作！');
        }
        $detail = new ProductDetail();
        $detail->productprice=0;
        $detail->productnum=10000;
        $detail->ordernum=0;
        $detail->paynum=0;
        $detail->maxordernum=1;
        return view('admin.productdetail.autogen',compact('detail'));
    }

    public function postAutoGenDetail(Request $request)
    {
        if (Gate::denies('modify-manager')) {
            abort(403,'你无权进行此操作！');
        }

        $usebegintimes=$request->usebegintime;
        $useendtimes=$request->useendtime;
        if ((count($usebegintimes)==0) || (count($usebegintimes)!=count($useendtimes))){
            return back()->withErrors("时间范围有错，请重新输入！");
        }

        $this->validate($request, [
            'usebegindate' => 'required|string|max:255',
            'useenddate' => 'required|string|max:255',
        ]);


        $product_ids = Product::where('delflag', 0)->select('id')->get();       
        
        $usebegindate=new Carbon($request->usebegindate);
        $useenddate=new Carbon($request->useenddate);
        
        $weeks=$request->weeks;



        foreach ($product_ids as $product_id) {
            $details=[]; 
            $begindate=clone $usebegindate;            
            while ($begindate<=$useenddate) {
                $usedate=$begindate;
                $week= $usedate->dayOfWeek;
                if (empty($weeks)) {
                    for ($i=0;$i<count($usebegintimes);$i++){
                        if (($usebegintimes[$i]) && ($useendtimes[$i])){                        
                            $detail = new ProductDetail();
                            $detail->productifo_id=$product_id->id;
                            $detail->usedate = $usedate->toDateString();
                            $detail->usebegintime = $usebegintimes[$i];
                            $detail->useendtime = $useendtimes[$i];
                            $detail->productprice = $request->productprice;
                            $detail->productnum = $request->productnum;
                            $detail->ordernum = $request->ordernum;
                            $detail->paynum = $request->paynum;
                            $detail->maxordernum = $request->maxordernum;
                            $details[]=$detail->attributesToArray();
                        }else{
                            return back()->withErrors("时间有错，请重新输入！");
                        }
                    }
                } else if  (in_array($week,$weeks)) {
                    for ($i=0;$i<count($usebegintimes);$i++){
                        if (($usebegintimes[$i]) && ($useendtimes[$i])){                        
                            $detail = new ProductDetail();
                            $detail->productifo_id=$product_id->id;
                            $detail->usedate = $usedate->toDateString();
                            $detail->usebegintime = $usebegintimes[$i];
                            $detail->useendtime = $useendtimes[$i];
                            $detail->productprice = $request->productprice;
                            $detail->productnum = $request->productnum;
                            $detail->ordernum = $request->ordernum;
                            $detail->paynum = $request->paynum;
                            $detail->maxordernum = $request->maxordernum;
                            $details[]=$detail->attributesToArray();
                        }else{
                            return back()->withErrors("时间有错，请重新输入！");
                        }
                    }
                }
                $begindate=$begindate->addDay();
            }
            ProductDetail::insert($details);
        }
        

        return redirect('/admin/product')
                        ->withSuccess("场地细节自动生成成功.");
       
    }

}
