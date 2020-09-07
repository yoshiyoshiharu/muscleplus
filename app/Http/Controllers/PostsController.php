<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Validator;
use Auth;
class PostsController extends Controller
{
    public function __construct(){
      $this->middleware('auth');
    }

    public function index(){
      $posts = Post::all()->sortByDesc('created_at');
      return view('post.index' , ['posts' => $posts]);

    }

    public function create(){
      return view('post.create');
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
      return redirect('/home');
    }

    public function edit(Post $post){
      return view('post.edit' , ['post' => $post]);
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
      return redirect('/home');
    }

    public function destroy(Post $post){
      $post->delete();
      return redirect('/home');
    }
}
