<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Validator;
use Auth;
class PostsController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $posts = Post::all()->sortByDesc('created_at');
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
      $tags =  Tag::all();
      return view('post.edit' , ['post' => $post , 'tags' => $tags]);
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
