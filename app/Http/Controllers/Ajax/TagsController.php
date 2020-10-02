<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use App\User;
use App\Post;
use Carbon\Carbon;
class TagsController extends Controller
{
    //
    public function index(User $user ,Request $request){//userが渡されて、202008みたいに送られてくる
      //whwerMonth使う
      $year = substr($request->month , 0,4);//最初4文字
      $month = substr($request->month , -2);//後ろ2文字

      $posts = Post::where('user_id' , $user->id)
                    ->whereYear('created_at' , $year)
                    ->whereMonth('created_at' , $month)->get();

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
      //[背中、背中、背中、腕、腕、腹筋、腹筋、腹筋]
      foreach($tags as $tag){
        $tag_name = Tag::find($tag->tag_id);
        $tag_counts[] = $tag_name->name;
      }
      //タグの個数を連想配列にする
      //[背中=>3,腕=>2,腹筋=>3]
      $tag_counts = array_count_values($tag_counts);

      return $tag_counts;
    }

    public function months(User $user){
      /*
      [
       0 => [value =>202009 , name=>2020年09月 ]
       1 => [value =>202010 , name=>2020年010月 ]
       2 => [valie =>202011 , name=>2020年11月　]
      ]
      */
      //はじめてポストしてから今月までの月を202009のような形で返す。
      $firstPost = Post::where('user_id' , $user->id)->orderBy('created_at' , 'asc')->first();
      //最後にポストした日にち
      $lastPost = Post::where('user_id' , $user->id)->orderBy('created_at' , 'desc')->first();
      $firstMonth = new Carbon($firstPost->created_at);
      $firstMonth = $firstMonth->startOfMonth();
      $lastMonth = new Carbon($lastPost->created_at);
      $lastMonth = $lastMonth->startOfMonth();
      //formatは表示するときに使用するので、日時の比較はformatでは行えない
      //firstMonthを1日にもどせばok
      //2020-07-04 23:07:29.0 を 2020-07-01 0:0:0:0に直す

      $months = array();
      $month = $firstMonth;

      for( $i=0; $month <= $lastMonth; $i++){
        $months[$i]['value'] = $month->format('Ym');
        $months[$i]['name'] = $month->format('Y年m月');
        $month->addMonths(1);
      }
      return array_reverse($months);
    }


}
