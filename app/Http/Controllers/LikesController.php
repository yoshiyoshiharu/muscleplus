<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use Auth;
use App\Post;
class LikesController extends Controller
{
    //
    public function __construct(){
      $this->middleware('auth');
    }
    public function store(Post $post){
      $like = new Like;
      $like->post_id = $post->id;
      $like->user_id = Auth::user()->id;
      $like->save();
      return redirect('/home');
     }

     public function destroy(Like $like){
       $like->delete();
       return redirect('/home');
     }
}
