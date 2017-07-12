<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Buyrecord;
use App\Models\Customer;

use Auth;

class BuyrecordController extends Controller
{
    
    protected $_searchCondition = [
        'productname'=>'',
        'customeraccount'=>'',        
        'usebegindate'=>'',
        'useenddate'=>'',
        'usebegintime'=>'',
        'useendtime'=>''
        
    ];

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $buyrecords = Buyrecord::where('company_id', Auth::user()->company_id)
                            ->with('customer','product', 'detail','company')
                            ->orderBy('buytime','desc')
                            ->paginate(config('subscribesystem.per_page'));
        
        return view('admin.buyrecord.index', compact('buyrecords'));
    }

    public function edit($id)
    {             
        $buyrecord = Buyrecord::where('company_id', Auth::user()->company_id)
                        ->with('customer','product', 'detail','company')
                        ->where('id',$id)
                        ->first();     

        return view('admin.buyrecord.edit', compact('buyrecord'));
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'usebegindate' => 'required|string|max:255',
            'useenddate' => 'required|string|max:255',            
        ]);

        $searchCondition=$this->_searchCondition;

        foreach (array_keys($this->_searchCondition) as $field) {
            $searchCondition[$field] = $request->get($field);
        }

        $buyrecords = Buyrecord::where('buyrecord.company_id', Auth::user()->company_id);
       
        if ($searchCondition['productname']){
            $buyrecords=$buyrecords->join('productifo', 'buyrecord.productifo_id', '=', 'productifo.id')                                    
                                ->where('productifo.productname','like', '%'.$searchCondition['productname'].'%');            
        }

        if ($searchCondition['customeraccount']){
            $buyrecords=$buyrecords->join('customer', 'buyrecord.customer_id', '=', 'customer.id')
                                    ->where('customer.customeraccount','like', '%'.$searchCondition['customeraccount'].'%');           
        }

        $buyrecords=$buyrecords->join('ifodetail', 'buyrecord.ifodetail_id', '=', 'ifodetail.id');

        if ($searchCondition['usebegindate']){
            $buyrecords=$buyrecords->where('ifodetail.usedate','>=', $searchCondition['usebegindate']);
        }

        if ($searchCondition['useenddate']){
            $buyrecords=$buyrecords->where('ifodetail.usedate','<=', $searchCondition['useenddate']);            
        }

        if ($searchCondition['usebegintime']){
            $buyrecords=$buyrecords->where('ifodetail.usebegintime','>=', $searchCondition['usebegintime']);            
        }

        if ($searchCondition['useendtime']){
            $buyrecords=$buyrecords->where('ifodetail.useendtime','<=', $searchCondition['useendtime']);            
        }
        //dd($buyrecords->toSql());
        $buyrecords =$buyrecords->orderBy('buyrecord.id', 'desc')
                            ->paginate(config('subscribesystem.per_page'));


        return view('admin.buyrecord.search',compact('buyrecords','searchCondition'));
    }

    public function consumpt(Request $request)
    {
       $buyrecord = Buyrecord::where('buytoken', $request->buytoken)
                        ->where('id', $request->buyid)
                        ->where('company_id', Auth::user()->company_id)
                        ->first();
        $buyrecord->consumptionflag=1;
        $buyrecord->save();

        return redirect('/admin/buyrecord')
                        ->withSuccess("客户 ".$buyrecord->customer->customername."  的预定记录已经确认.");
    }

    public function overdue(Request $request)
    {
        $buyrecord = Buyrecord::where('buytoken', $request->buytoken)
                        ->where('id', $request->buyid)
                        ->where('company_id', Auth::user()->company_id)
                        ->first();
        $buyrecord->overdueflag=1;
        $buyrecord->save();

        return redirect('/admin/buyrecord')
                        ->withSuccess("客户 ".$buyrecord->customer->customername."  的预定记录已经过期.");
       
    }

    public function cancel(Request $request)
    {
        $buyrecord = Buyrecord::where('buytoken', $request->buytoken)
                        ->where('id', $request->id)
                        ->where('company_id', Auth::user()->company_id)
                        ->first();
        $buyrecord->cancelflag=1;
        $buyrecord->save();

        return redirect('/admin/buyrecord')
                        ->withSuccess("客户 ".$buyrecord->customer->customername."  的预定记录已经取消.");
    }

}
