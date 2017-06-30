<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator, Auth, Redirect;

use App\Models\User;
use App\Models\Role;
use App\Models\Company;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getReset()
    {
        return view('admin.reset');
    }

    public function postReset(Request $request)
    {
        $data = $request->all(); //接收所有的数据
        $rules = [
            'oldpassword'=>'required|between:6,20',
            'password'=>'required|between:6,20|confirmed',
        ];
        $messages = [
            'required' => '密码不能为空',
            'between' => '密码必须是6~20位之间',
            'confirmed' => '新密码和确认密码不匹配'
        ];
        $validator = Validator::make($data, $rules, $messages);
        
        $oldpassword=$data['oldpassword'];
        $password=$data['password'];
        $user = Auth::user();
       // dd($user->password);
        $validator->after(function($validator) use ($oldpassword, $user) {
            if (!\Hash::check($oldpassword, $user->password)) { 
                //原始密码和数据库里的密码进行比对
                $validator->errors()->add('oldpassword', '原密码错误'); 
                //错误的话显示原始密码错误
            }
        });
        if ($validator->fails()) {   //判断是否有错误
            return back()->withErrors($validator); 
            //重定向页面，并把错误信息存入一次性session里
        }
        $user->password = bcrypt($password);    //使用bcrypt函数进行新密码加密
        $user->save();

        return Redirect::route('admin.dash');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $managers = User::where('delflag',0)->orderBy('id','desc')->get();
        return view('admin.manager.index')->withManagers($managers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies=Company::all();
        $manager=new User();
        return view('admin.manager.create',compact('manager','companies'));
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
            'managername' => 'required|string|max:255',
            'manageraccount' => 'required|string|max:255|unique:manager',
            'password' => 'required|string|min:6|confirmed',                  
        ]);
        if ($request->newpassword==$request->password_confirmation){
            $manager = new User();
            $manager->managername=$request->managername;
            $manager->manageraccount=$request->manageraccount;
            $manager->email=$request->email;
            $manager->company_id= $request->company_id;
            $manager->cellphone= $request->cellphone;
            $manager->IDCard= $request->IDCard;
            $manager->application_note= $request->application_note;
            $manager->verifyflag= $request->verifyflag;
            $manager->password= bcrypt($request->newpassword);
            $manager->save();            
            return redirect('/admin/manager')
                            ->withSuccess("用户 '$manager->managername' 新建成功.");
        }else{
            return redirect("/admin/manager/$id/edit")
                        ->withSuccess("用户添加失败，密码不一致.");
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRole($id)
    {
        $manager = User::findOrFail($id);
        $mr=$manager->roles;
        $managerRoles=array();
        foreach ($mr as $role){
            $rid=$role->id;
            array_push($managerRoles,$rid);
        }

        $roles = Role::all();

        return view('admin.manager.roles', ['manager'=>$manager,'managerRoles'=>$managerRoles,'roles'=>$roles]);
    }


    public function updateRole(Request $request,$id)
    {
       // dd($request);
        $manager = User::findOrFail($id);
        $roleids=$request->roles;

        $userRoleids=array();
        $manager->roles()->detach();

        if (count($roleids)>0){
            foreach ($roleids as $roleid){
                $manager->assignRole(Role::findOrFail($roleid)->rolename);
            }
        }
        return redirect('/admin/manager')
                        ->withSuccess("用户 '$manager->managername' .角色更改成功！");

    }


    public function changePassword(Request $request)
    {
        $id=$request->id;
        $manager = User::findOrFail($id);

        if ($request->newpassword==$request->password_confirmation){
            $manager->password=bcrypt($request->newpassword);
            $manager->save();
            return redirect("/admin/manager/$id/edit")
                        ->withSuccess("密码成功.");
        }else{
            return redirect("/admin/manager/$id/edit")
                        ->withSuccess("密码不一致.");
        }
    }


   
}
