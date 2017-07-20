<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Managerloginlog;
use App\Models\Customerloginlog;

class LogController extends Controller
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
    public function manager()
    {
        if (Gate::denies('list-log')) {
            abort(403,'你无权进行此操作！');
        }
        $logs = Managerloginlog::orderBy('id','desc')
                                ->paginate(config('subscribesystem.per_page'));
        return view('admin.log.manager')->withLogs($logs);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function customer()
    {
        if (Gate::denies('list-log')) {
            abort(403,'你无权进行此操作！');
        }
        $logs = Customerloginlog::orderBy('id','desc')
                                ->paginate(config('subscribesystem.per_page'));
        return view('admin.log.customer')->withLogs($logs);
    }

    public function search(Request $request)
    {
        if ($request->type=='customer'){
            $logs = Customerloginlog::orderBy('id','desc')
                                    ->paginate(config('subscribesystem.per_page'));
            return view('admin.log.customer')->withLogs($logs);
        }else{
            $logs = Managerloginlog::orderBy('id','desc')
                                ->paginate(config('subscribesystem.per_page'));
            return view('admin.log.manager')->withLogs($logs);
        }
    }
}
