<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

use App\Models\Comment;
use App\Models\Product;
use Auth, Response;


class CommentController extends Controller
{
    protected $_searchCondition = [        
        'begintime'=>'',
        'endtime'=>'',
        'customeraccount'=>'',
        'product_id'=>'',
        'content'=>''
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
        $product = Product::where('delflag', 0);
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $product = $product->where('company_id', Auth::user()->company_id);
        }
        $products = $product->get();
        
        $comments = Comment::where('delflag', 0)->with('company', 'product', 'customer');
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $comments = $comments->where('company_id', Auth::user()->company_id);
        }
        
        $comments = $comments->orderBy('id','desc')
                                ->paginate(config('subscribesystem.per_page'));

        return view('admin.comment.index',compact('comments','products'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function comments($product_id)
     {
        $product = Product::where('delflag', 0);
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $product = $product->where('company_id', Auth::user()->company_id);
        }
        $products = $product->get();

         $comments = Comment::where('delflag', 0)->where('productifo_id',$product_id)->with('company', 'product', 'customer');
         if (Auth::user()->managername<>config('subscribesystem.admin')){
             $comments = $comments->where('company_id', Auth::user()->company_id);
         }
         
         $comments = $comments->orderBy('id','desc')
                                 ->paginate(config('subscribesystem.per_page'));
 
         return view('admin.comment.index',compact('comments', 'products'));
        
     }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function verify(Request $request)
    {
        $comment = Comment::findOrFail($request->ucid); 
        $comment->verifyflag = (($comment->verifyflag)==0) ? 1 : 0; 
        $comment->save();

        $response = array(
            'status' => 0,
            'verifyflag'=>$comment->verifyflag,
            'msg' => '审核修改成功！',
        );

        return Response::json( $response );
    }
 
 
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request)
    { 
        $comment = Comment::findOrFail($request->ucid);
        $comment->delflag=1;

        $comment->save();

        $response = array(
            'status' => 'success',
            'msg' => '评论删除成功！',
        );

        return Response::json( $response );
    }

    public function search(Request $request)
    {   
        
        if (Gate::denies('list-comment')) {
            abort(403,'你无权进行此操作！');
        }
        $this->validate($request, [
            'begintime' => 'required|string|max:255',
            'endtime' => 'required|string|max:255',
        ]);

        $searchCondition=$this->_searchCondition;

        foreach (array_keys($this->_searchCondition) as $field) {
            $searchCondition[$field] = $request->get($field);
        }
        
        $product = Product::where('delflag', 0);
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $product = $product->where('company_id', Auth::user()->company_id);
        }
        $products = $product->get();

        $comments = Comment::where('delflag',0)
                            ->whereBetween('sendtime',[$searchCondition['begintime'],$searchCondition['endtime']]);

        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $comments = $comments->where('company_id', Auth::user()->company_id);
        }

        if ($searchCondition['product_id']){
            $comments=$comments->where('productifo_id', $searchCondition['product_id']);
        }

        if ($searchCondition['content']){
            $comments=$comments->where('commentcontent','like', '%'.$searchCondition['content'].'%');
        }

        $comments =$comments->orderBy('sendtime','desc') 
                            ->paginate(config('subscribesystem.per_page'));

        return view('admin.comment.index',compact('comments', 'products', 'searchCondition'));
    }
}
