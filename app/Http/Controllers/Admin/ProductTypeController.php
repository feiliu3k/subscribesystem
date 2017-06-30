<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductType;

class ProductTypeController extends Controller
{

    protected $fields = [
        'typename' => '',
        'id' => '',        
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
    public function index()
    {
        $productTypes = ProductType::where('delflag',0)->orderBy('id','desc')->get();        
        return view('admin.producttype.index')->withProductTypes($productTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }

        return view('admin.producttype.create', $data);
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
            'typename' => 'required|string|max:255|unique:producttype',                       
        ]);

        $productType = new ProductType();
        foreach (array_keys($this->fields) as $field) {
            $productType->$field = $request->get($field);
        }
        $productType->save();

        return redirect('/admin/productType')
                        ->withSuccess("区域 '$productType->typename' 新建成功.");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productType = ProductType::findOrFail($id);
        $data = ['id' => $id];
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $productType->$field);
        }

        return view('admin.producttype.edit', $data);
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
            'typename' => 'required|string|max:255|unique:producttype',                       
        ]);
        $productType = ProductType::findOrFail($id);

        foreach (array_keys($this->fields) as $field) {
            $productType->$field = $request->get($field);
        }

        $productType->save();

        return redirect("/admin/productType")
                        ->withSuccess("更新成功.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productType = ProductType::findOrFail($id);
        $productType->delflag=1;
        $productType->save();

        return redirect('/admin/productType')
                        ->withSuccess("'$productType->typename' .已经被删除.");
    }
}
