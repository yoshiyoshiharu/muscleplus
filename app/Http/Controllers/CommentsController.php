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


    $comments = [
                 'user_name' => Auth::user()->name ,
                 'comment' => $comment->comment
               ];
    return response()->json(['comments' => $comments] , 200);
  }

  public function destroy(Comment $comment){
    $comment->delete();
    return redirect('/home');
  }
}
