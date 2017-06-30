<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductFunction;

class ProductFunctionController extends Controller
{

    protected $fields = [
        'functionname' => '',
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
        $productFunctions = ProductFunction::where('delflag',0)->orderBy('id','desc')->get();        
        return view('admin.productfunction.index')->withProductFunctions($productFunctions);
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

        return view('admin.productfunction.create', $data);
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
            'functionname' => 'required|string|max:255|unique:productfunction'                       
        ]);
        $productFunction = new ProductFunction();
        foreach (array_keys($this->fields) as $field) {
            $productFunction->$field = $request->get($field);
        }
        $productFunction->save();

        return redirect('/admin/productFunction')
                        ->withSuccess("区域 '$productFunction->functionname' 新建成功.");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $productFunction = ProductFunction::findOrFail($id);
        $data = ['id' => $id];
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $productFunction->$field);
        }

        return view('admin.productfunction.edit', $data);
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
            'functionname' => 'required|string|max:255|unique:productfunction',                       
        ]);
        $productFunction = ProductFunction::findOrFail($id);

        foreach (array_keys($this->fields) as $field) {
            $productFunction->$field = $request->get($field);
        }

        $productFunction->save();

        return redirect("/admin/productFunction")
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
        $productFunction = ProductFunction::findOrFail($id);
        $productFunction->delflag=1;
        $productFunction->save();

        return redirect('/admin/productFunction')
                        ->withSuccess("'$productFunction->functionname' .已经被删除.");
    }
}
