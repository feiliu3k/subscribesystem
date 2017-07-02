<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\Models\Company;
use App\Models\Area;
use App\Models\ProductType;
use App\Models\ProductFunction;
use App\Models\ProductAddress;
use App\Models\Product;

class ProductController extends Controller
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
    public function index()
    {
        $products = Product::where('company_id', Auth::user()->company_id)
                            ->with('area', 'productType', 'company')
                            ->where('delflag', 0)
                            ->orderBy('created_at','desc')
                            ->paginate(config('subscribesystem.per_page'));
        return view('admin.product.index')->withproducts($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::where('delflag',0)->orderBy('id','desc')->get();       
        $productTypes = ProductType::where('delflag',0)->orderBy('id','desc')->get();
        $productFunctions = ProductFunction::where('delflag',0)->orderBy('id','desc')->get();
        
        $product = new Product();
        return view('admin.product.create',compact('product','areas', 'productTypes', 'productFunctions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [            
            'productname' => 'required|string|max:255',             
        ]);
        
        $product = new Product();
        $product->productname=$request->productname;
        $product->productimg=$request->productimg;
        $product->areaname_id=$request->area_id;
        $product->producttype_id= $request->producttype_id;
        $product->productexplain= $request->productexplain;
        $product->manager_id= Auth::user()->id;
        $product->company_id= Auth::user()->company_id;        
        $product->save();            
        return redirect('/admin/product')
                        ->withSuccess("场地 '$product->productname' 创建成功.");
       
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {             
        $product = Product::where('delflag', 0)
                        ->where('id', $id)
                        ->first();
        $areas = Area::where('delflag',0)->orderBy('id','desc')->get();       
        $productTypes = ProductType::where('delflag',0)->orderBy('id','desc')->get();
        $productFunctions = ProductFunction::where('delflag',0)->orderBy('id','desc')->get();
        
        return view('admin.product.edit', compact('product','areas', 'productTypes', 'productFunctions'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [            
            'productname' => 'required|string|max:255',             
        ]);        
        
        $product = Product::where('delflag', 0)
                        ->where('id', $id)
                        ->first();
        $product->productname=$request->productname;
        $product->productimg=$request->productimg;
        $product->areaname_id=$request->area_id;
        $product->producttype_id= $request->producttype_id;
        $product->productexplain= $request->productexplain;
        $product->manager_id= Auth::user()->id;
        $product->company_id= Auth::user()->company_id;        
        $product->save();    
        
        return redirect("/admin/product/$id/edit")
                        ->withSuccess("场地 '$product->productname' 更新成功.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('delflag', 0)
                        ->where('id', $id)
                        ->first();
        $product->delflag=1;
        $product->save();

        return redirect('/admin/product')
                        ->withSuccess("场地 '$product->productname' 已经被删除.");
    }

    public function getProductAddress($id)
    {
        $product = Product::where('delflag', 0)
                        ->with('address')
                        ->where('id', $id)
                        ->first();
        
        return view('admin.product.address',compact('product'));     
    }

    public function postProductAddress(Request $request)
    {
        $this->validate($request, [            
            'productaddress' => 'required|string|max:255',             
        ]);        
        $product = Product::where('delflag', 0)
                        ->where('id', $request->id)
                        ->first();
        
        $productAddress = null;
        if ($product->address){
            $productAddress=$product->address;
        }else{
            $productAddress=new ProductAddress();
        }
        $productAddress->productifo_id=$request->id;
        $productAddress->productaddress=$request->productaddress;
        $productAddress->longitude=$request->longitude;
        $productAddress->latitude=$request->latitude;
        $productAddress->save();
        return redirect('/admin/product')
                        ->withSuccess("场地 '$product->productname' 的地址修改成功.");
    }
   
   public function destoryProductAddress($id)
    {
     
        $product = Product::where('delflag', 0)
                        ->where('id', $id)
                        ->first();
        $address=$product->address;
        if ($address) 
        {
            $address->delete();
            return redirect('/admin/product')
                            ->withSuccess("场地 '$product->productname' 的地址删除成功.");
        }else
        {
            return redirect('/admin/product')
                            ->withSuccess("场地 '$product->productname' 的地址删除失败.");
        }
    }

}
