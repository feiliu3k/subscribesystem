<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use App\Models\Company;

class CompanyController extends Controller
{
    protected $fields = [
        'companyname' => '',
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
        $companies = Company::orderBy('id','desc')->get();
        return view('admin.company.index')->withCompanies($companies);
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

        return view('admin.company.create', $data);
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
            'companyname' => 'required|unique:company|max:255'           
        ]);

        $company = new Company();
        foreach (array_keys($this->fields) as $field) {
            $company->$field = $request->get($field);
        }
        $company->save();

        return redirect('/admin/company')
                        ->withSuccess("公司/单位 '$company->companyname' 新建成功.");
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
        $company = Company::findOrFail($id);
        $data = ['id' => $id];
        foreach (array_keys($this->fields) as $field) {
            $data[$field] = old($field, $company->$field);
        }

        return view('admin.company.edit', $data);
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
            'companyname' => 'required|unique:company|max:255'           
        ]);
        $company = Company::findOrFail($id);

        foreach (array_keys($this->fields) as $field) {
            $company->$field = $request->get($field);
        }

        $company->save();

        return redirect("/admin/company")
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
        $company = Company::findOrFail($id);
        $company->delete();

        return redirect('/admin/company')
                        ->withSuccess("'$company->companyname' .已经被删除.");
    }
}
