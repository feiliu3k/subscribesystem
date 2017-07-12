<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Badrecord;
use App\Models\Customer;

use Auth;

class BadrecordController extends Controller
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
        $badrecords = Badrecord::where('company_id', Auth::user()->company_id)
                            ->with('customer','product', 'detail','company')
                            ->orderBy('buytime','desc')
                            ->paginate(config('subscribesystem.per_page'));
        
        return view('admin.badrecord.index', compact('badrecords'));
    }

    public function edit($id)
    {             
        $badrecord = Badrecord::where('company_id', Auth::user()->company_id)
                        ->with('customer','product', 'detail','company')
                        ->where('id',$id)
                        ->first();     

        return view('admin.badrecord.edit', compact('badrecord'));
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

        $badrecords = Badrecord::where('badrecord.company_id', Auth::user()->company_id);
       
        if ($searchCondition['productname']){
            $badrecords=$badrecords->join('productifo', 'badrecord.productifo_id', '=', 'productifo.id')                                    
                                ->where('productifo.productname','like', '%'.$searchCondition['productname'].'%');            
        }

        if ($searchCondition['customeraccount']){
            $badrecords=$badrecords->join('customer', 'badrecord.customer_id', '=', 'customer.id')
                                    ->where('customer.customeraccount','like', '%'.$searchCondition['customeraccount'].'%');           
        }

        $badrecords=$badrecords->join('ifodetail', 'badrecord.ifodetail_id', '=', 'ifodetail.id');

        if ($searchCondition['usebegindate']){
            $badrecords=$badrecords->where('ifodetail.usedate','>=', $searchCondition['usebegindate']);
        }

        if ($searchCondition['useenddate']){
            $badrecords=$badrecords->where('ifodetail.usedate','<=', $searchCondition['useenddate']);            
        }

        if ($searchCondition['usebegintime']){
            $badrecords=$badrecords->where('ifodetail.usebegintime','>=', $searchCondition['usebegintime']);            
        }

        if ($searchCondition['useendtime']){
            $badrecords=$badrecords->where('ifodetail.useendtime','<=', $searchCondition['useendtime']);            
        }
 
        $badrecords =$badrecords->orderBy('badrecord.id', 'desc')
                            ->paginate(config('subscribesystem.per_page'));


        return view('admin.badrecord.search',compact('badrecords','searchCondition'));
    }

   

}
