<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator, Auth, Redirect;

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
}
