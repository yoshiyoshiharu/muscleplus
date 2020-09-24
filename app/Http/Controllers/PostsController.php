<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\user;
use Validator;
use Auth;
class PostsController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $followings = Auth::user()->followings;
      $following_ids = array();
      foreach($followings as $following){
        $following_ids[] = $following->id;
      }
      $following_ids[] = Auth::user()->id;//自分の記事も表示
      $posts = Post::whereIn('user_id' , $following_ids)->latest()->paginate(5);
      $tags =  Tag::all();

      return view('post.index' , ['posts' => $posts , 'tags' => $tags]);

    }

    public function create(){
      $tags =  Tag::all();
      return view('post.create' , ['tags' => $tags]);
    }

    public function store(Request $request , Post $post){

      $validator = Validator::make($request->all() , [
            'body' => 'string|max:255|nullable'
      ]);

      if ($validator->fails())
      {
        return redirect()->back()->withErrors($validator->errors())->withInput();
      }

      $post->body = $request->body;
      $post->user_id = Auth::user()->id;

      $post->save();

      $post->tags()->sync($request->tags);
      return redirect('/home');
    }

    public function edit(Post $post){
      $post_tags = $post->tags;
      $tags_id = array();//編集前のタグのidが入った配列
      foreach($post_tags as $post_tag){
        $tags_id[] = $post_tag->id;
      }

      $tags =  Tag::all();//全タグ

      return view('post.edit' , ['post' => $post , 'tags' => $tags , 'tags_id' => $tags_id]);
    }

    public function update(Request $request , Post $post){
      $validator = Validator::make($request->all() , [
            'body' => 'string|max:255|nullable'
      ]);
      if ($validator->fails())
      {
        return redirect()->back()->withErrors($validator->errors())->withInput();
      }

      $post->body = $request->body;
      $post->save();
      $post->tags()->sync($request->tags);
      return redirect('/home');
    }

    public function destroy(Post $post){
      $post->delete();
      return redirect('/home');
    }
}
