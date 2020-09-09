<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use App\User;
class TagsController extends Controller
{
    //
    public function index(User $user){//userが渡される
      //whwerMonth使う
      $posts = $user->posts;
      $post_ids = array();
      foreach($posts as $post){
        $post_ids[] = $post->id; //post_idの配列
      }

      $tags = \DB::table('post_tag')
                ->select('tag_id')
                ->whereIn('post_id' , $post_ids)//post_idが$post_idsに含まれるもの
                ->get();

      $tag_counts = array();
      //配列にタグの名前を入れていく
      foreach($tags as $tag){
        $tag_name = Tag::find($tag->tag_id);
        $tag_counts[] = $tag_name->name;
      }
      //タグの個数を連想配列にする
      $tag_counts = array_count_values($tag_counts);
      return $tag_counts;
    }


}
