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
}
