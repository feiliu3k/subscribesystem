<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator, Auth, Redirect;

use App\Models\Customer;

class CustomerController extends Controller
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
        $customers = Customer::where('delflag',0)->orderBy('id','desc')->get();
        return view('admin.customer.index')->withCustomers($customers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        if (Gate::denies('create-customer')) {
            abort(403,'你无权进行此操作！');
        }     
        $customer=new Customer();
        return view('admin.customer.create',compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('create-customer')) {
            abort(403,'你无权进行此操作！');
        }
        
        $this->validate($request, [
            'customername' => 'required|string|max:255',
            'customeraccount' => 'required|string|max:255|unique:customer',
            'newpassword' => 'required|string|min:6|confirmed',
        ]);
        if ($request->newpassword==$request->newpassword_confirmation){
            $customer = new Customer();
            $customer->customername=$request->customername;
            $customer->customeraccount=$request->customeraccount;
            $customer->email=$request->email;
            $customer->sex= $request->sex;
            $customer->cellphone= $request->cellphone;
            $customer->IDCard= $request->IDCard;
            $customer->credit= $request->credit;
            $customer->password= bcrypt($request->newpassword);
            $customer->save();
            return redirect('/admin/customer')
                            ->withSuccess("客户 '$customer->customername' 新建成功.");
        }else{
            return back()->withSuccess("用户添加失败，密码不一致.");
        }
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if (Gate::denies('modify-customer')) {
            abort(403,'你无权进行此操作！');
        }        
        $customer = Customer::findOrFail($id);
        return view('admin.customer.edit', compact('customer'));
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
        if (Gate::denies('modify-customer')) {
            abort(403,'你无权进行此操作！');
        } 
        $this->validate($request, [            
            'customername' => 'required|string|max:255',                              
        ]);

        $customer = Customer::findOrFail($id); 
        $customer->customername=$request->customername;
        $customer->email=$request->email;
        $customer->sex= $request->sex;
        $customer->cellphone= $request->cellphone;
        $customer->IDCard= $request->IDCard;            
        $customer->credit= $request->credit;       
        $customer->save();               

        return redirect("/admin/customer/$id/edit")
                        ->withSuccess("客户 '$customer->customername' 更新成功.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::denies('delete-customer')) {
            abort(403,'你无权进行此操作！');
        } 
        
        $customer = Customer::findOrFail($id);
        $customer->delflag=1;
        $customer->save();

        return redirect('/admin/customer')
                        ->withSuccess("客户 '$customer->customername' 已经被删除.");
    }
   
}
