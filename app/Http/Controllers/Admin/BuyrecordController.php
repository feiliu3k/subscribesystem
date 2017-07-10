<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Buyrecord;

use Auth;

class BuyrecordController extends Controller
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
        $buyrecords = Buyrecord::where('company_id', Auth::user()->company_id)
                            ->with('customer', 'product', 'detail')
                            ->where('buytime', 0)
                            ->orderBy('created_at','desc')
                            ->paginate(config('subscribesystem.per_page'));
        return view('admin.buyrecord.index',compact('buyrecords'));
    }


    public function consumpt($id, $buytoken)
    {
       $buyrecord = Buyrecord::where('buytoken', $buytoken)
                        ->where('id', $id)
                        ->where('company_id', Auth::user()->company_id)
                        ->first();
        $buyrecord->consumptionflag=1;
        $buyrecord->save();

        return redirect('/admin/buyrecord')
                        ->withSuccess("客户 '$buyrecord->customer->customername'  的预定记录已经确认.");
    }

    public function overdue($id, $token)
    {
       $buyrecord = Buyrecord::where('buytoken', $buytoken)
                        ->where('id', $id)
                        ->where('company_id', Auth::user()->company_id)
                        ->first();
        $buyrecord->overdueflag=1;
        $buyrecord->save();

        return redirect('/admin/buyrecord')
                        ->withSuccess("客户 '$buyrecord->customer->customername'  的预定记录已经过期.");
    }

    public function cancel($id, $token)
    {
        $buyrecord = Buyrecord::where('buytoken', $buytoken)
                        ->where('id', $id)
                        ->where('company_id', Auth::user()->company_id)
                        ->first();
        $buyrecord->cancelflag=1;
        $buyrecord->save();

        return redirect('/admin/buyrecord')
                        ->withSuccess("客户 '$buyrecord->customer->customername'  的预定记录已经取消.");
    }


}
