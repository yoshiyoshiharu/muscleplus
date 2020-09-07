<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Auth;
use Validator;
class CommentsController extends Controller
{
    //
  public function __construct(){
    $this->middleware('auth');
  }

  public function store(Request $request){

    $validator = Validator::make($request->all() , [
          'comment' => 'required|string|max:255'
    ]);

    if ($validator->fails())
    {
      return redirect()->back()->withErrors($validator->errors())->withInput();
    }
    $comment = new Comment;
    $comment->comment = $request->comment;
    $comment->post_id = $request->post_id;
    $comment->user_id = Auth::user()->id;
    $comment->save();
    return redirect('/home');
  }

  public function destroy(Comment $comment){
    $comment->delete();
    return redirect('/home');
  }
}
