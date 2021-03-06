<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use App\Models\Area;

class AreaController extends Controller
{
    protected $fields = [
        'areaname' => '',
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
        
        //dd(Auth::user()->roles->first()->permissions);
        $areas = Area::where('delflag',0)->orderBy('id','desc')->get();        
        return view('admin.area.index')->withAreas($areas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('create-meta')) {
            abort(403,'你无权进行此操作！');
        }
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }

        return view('admin.area.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('create-meta')) {
            abort(403,'你无权进行此操作！');
        }
        $this->validate($request, [
            'areaname' => 'required|unique:areaname|max:255'           
        ]);
  
        $area = new Area();
        foreach (array_keys($this->fields) as $field) {
            $area->$field = $request->get($field);
        }
        $area->save();

        return redirect('/admin/area')
                        ->withSuccess("区域 '$area->areaname' 新建成功.");
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::denies('modify-meta')) {
            abort(403,'你无权进行此操作！');
        }
        $area = Area::findOrFail($id);
       
        $data = ['id' => $id];
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $area->$field);
        }

        return view('admin.area.edit', $data);
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
        if (Gate::denies('modify-meta')) {
            abort(403,'你无权进行此操作！');
        }
        $this->validate($request, [
            'areaname' => 'required|unique:areaname|max:255'           
        ]);
        $area = Area::findOrFail($id);

        foreach (array_keys($this->fields) as $field) {
            $area->$field = $request->get($field);
        }

        $area->save();

        return redirect("/admin/area")
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
        if (Gate::denies('delete-meta')) {
            abort(403,'你无权进行此操作！');
        }
        $area = Area::findOrFail($id);
        $area->delflag=1;
        $area->save();

        return redirect('/admin/area')
                        ->withSuccess("'$area->areaname' .已经被删除.");
    }
}
