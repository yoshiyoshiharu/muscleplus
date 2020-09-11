<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
use App\User;
use Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
class CommentsController extends Controller
{
    //
  public function __construct(){
    $this->middleware('auth');
  }

  public function store(Request $request){
    $validator = Validator::make($request->all() , [
          'comment' => 'required|string|max:50'
    ]);

    if ($validator->fails())
    {
      return response()->json($validator->errors()->first() , 203);
    }

    $comment = new Comment;
    $comment->comment = $request->comment;
    $comment->post_id = $request->post_id;
    $comment->user_id = Auth::user()->id;
    $comment->save();

    $post_comments = Comment::where('post_id' , $request->post_id)->orderBy('created_at' , 'asc')->get();

    $comments_list = array(); //user_id,user_name,commentの配列
    foreach($post_comments as $post_comment){
      $comment_list['user_id'] = $post_comment->user_id;
      $comment_list['user_name'] = User::find($post_comment->user_id)->name;
      $comment_list['comment'] = $post_comment->comment;
      $comments_list[] = $comment_list;
     }
    return response()->json(['comments' => $comments_list] , 200);
  }

  public function destroy(Comment $comment){
    $comment->delete();
    return redirect('/home');
  }
}
