<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

use App\Models\Company;
use App\Models\Area;
use App\Models\ProductType;
use App\Models\ProductFunction;
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
        $product->areaname_id=$request->areaname_id;
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
        $companies=Company::all();       
        $manager = User::findOrFail($id);
        return view('admin.manager.edit', compact('manager','companies'));
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
            'managername' => 'required|string|max:255',
            'manageraccount' => 'required|string|max:255|unique:manager',
            'password' => 'required|string|min:6|confirmed',                  
        ]);
        $manager = User::findOrFail($id);
        $manager->managername=$request->managername;        
        $manager->email=$request->email;
        $manager->company_id= $request->company_id;
        $manager->cellphone= $request->cellphone;
        $manager->IDCard= $request->IDCard;
        $manager->application_note= $request->application_note;
        $manager->verifyflag= $request->verifyflag;
        $manager->password= bcrypt($request->newpassword);
        $manager->save();        

        return redirect("/admin/manager/$id/edit")
                        ->withSuccess("用户 '$manager->managername' 更新成功.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manager = User::findOrFail($id);
        $manager->delflag=1;
        $manager->save();

        return redirect('/admin/manager')
                        ->withSuccess("用户 '$manager->managername' 已经被删除.");
    }

   

}
