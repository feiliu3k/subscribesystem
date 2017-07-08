<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\ProductDetail;

class ProductDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id){

        $product = Product::where('delflag', 0)
                        ->where('id', $id)
                        ->where('company_id', Auth::user()->company_id)
                        ->first();

        $details = ProductDetail::where('productifo_id',$id)
                                ->where('delflag',0)
                                ->orderBy('usedate','desc')
                                ->get();
        return view('admin.productdetail.index',compact('product','details'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product = Product::where('delflag', 0)
                        ->where('id', $id)
                        ->where('company_id', Auth::user()->company_id)
                        ->first();
        $detail = new ProductDetail();

        return view('admin.productdetail.create',compact('product','detail'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $this->validate($request, [
            'usedate' => 'required|string|max:255',
        ]);

        $product = Product::where('delflag', 0)
                        ->where('company_id', Auth::user()->company_id)
                        ->where('id', $id)
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
        
        $productDetail->save();            
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
        $product = Product::where('delflag', 0)
                        ->where('company_id', Auth::user()->company_id)
                        ->where('id', $id)
                        ->first();
        
        $detail = ProductDetail::where('delflag',0)
                                ->where('id', $did)
                                ->orderBy('id','desc')->first();

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

        $product = Product::where('delflag', 0)
                        ->where('company_id', Auth::user()->company_id)
                        ->where('id', $id)
                        ->first();

        $detail = ProductDetail::where('delflag',0)
                                ->where('id', $did)
                                ->orderBy('id','desc')->first();

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
    public function destroy($id, $did)
    {
        $detail = ProductDetail::where('delflag',0)
                                ->where('company_id', Auth::user()->company_id)
                                ->where('id', $did)
                                ->orderBy('id','desc')->first();
        $detail->delflag=1;
        $detail->save();
        

        return redirect("/admin/product/$detail->productifo_id/detail")
                        ->withSuccess("场地细节 '$did' 已经被删除.");        
    }

    public function search(Request $request, $id)
    {
        $searchCondition=$this->_searchCondition;

        foreach (array_keys($this->_searchCondition) as $field) {
            $searchCondition[$field] = $request->get($field);
        }

        $products = Product::where('company_id',Auth::user()->company_id)
                            ->where('areaname_id', $searchCondition['areaname_id'])
                            ->where('producttype_id', $searchCondition['producttype_id']);
       
        if ($searchCondition['productname']){
            $products=$products->where('productname','like', '%'.$searchCondition['productname'].'%');
        }

        $products =$products->orderBy('id', 'desc')
                            ->paginate(config('subscribesystem.per_page'));

        return view('admin.product.search',compact('products','searchCondition'));
    }

}
