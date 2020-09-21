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

    public function LikeOrUnlike(Post $post){
      $user_like = Like::where([
        ['user_id' , Auth::user()->id],
        ['post_id' , $post->id]
      ])->first();

      $likes_count = Like::where('post_id' , $post->id)->count();

      if($user_like){
        //delete
        $user_like->delete();
        return $likes_count-1;
      }else{
        //create
        $newlike = new Like;
        $newlike->post_id = $post->id;
        $newlike->user_id = Auth::user()->id;
        $newlike->save();
        return $likes_count+1;
      }

     }


}
