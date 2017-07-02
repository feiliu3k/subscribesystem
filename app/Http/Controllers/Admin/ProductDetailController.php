<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductDetailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id){
        $details = ProductDetail::where('productifo_id',$id)
                                ->where('delflag',0)
                                ->orderBy('usedate','desc')
                                ->get();
       
        return view('admin.productdetail.index',compact('details'));
    }
}
