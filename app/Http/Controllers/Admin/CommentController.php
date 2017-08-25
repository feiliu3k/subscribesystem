<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentController extends Controller
{
    protected $_searchCondition = [
        
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
        $comments = Comment::where('delflag', 0)->with('company', 'product', 'customer');
        if (Auth::user()->managername<>config('subscribesystem.admin')){
            $comments = $comments->where('company_id', Auth::user()->company_id);
        }
        
        $comments = $comments->orderBy('id','desc')
                                ->paginate(config('subscribesystem.per_page'));

        return view('admin.comment.index',compact('comments'));
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
}
