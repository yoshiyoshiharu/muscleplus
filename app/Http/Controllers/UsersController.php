<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Auth;
use Validator;
use Illuminate\Validation\Rule;
class UsersController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }

    public function show(User $user){
      $posts = Post::where('user_id' , $user->id)->latest()->paginate(5);
      return view('user.show' , ['user' => $user , 'posts' => $posts]);
    }

    public function edit(){
      $user = Auth::user();
      return view('user.edit' , ['user' => $user]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all() , [
              'name' => 'required|string|max:255',
              'phrase' => 'string|max:15',
              //ゲストは変更不可
              'email' => [
                Rule::notIn(['guest@guest.com'])
                ]
              ]);

        if ($validator->fails())
        {
          return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->phrase = $request->phrase;


        if($request->hasFile('profile_photo')){
          if($request->file('profile_photo')->isValid()){
            $request->profile_photo->storeAs('public/user_images', $user->id . '.jpg');
            $user->profile_photo = $user->id . '.jpg';
            $user->profile_photo_version = date('YmdHis');
          }
        }
        $user->save();

        return redirect('/users/'.$request->id);
    }

    public function destroy(){
      $user = Auth::user();
      if($user->email === "guest@guest.com"){
        return redirect('/');
      }
      $user->delete();
      return redirect('/');
    }

    public function followings(User $user){
      return view('user.followings' , ['followings' => $user->followings]);
    }

    public function followers(User $user){
      return view('user.followers' , ['followers' => $user->followers]);
    }

    public function FollowOrUnfollow(User $user){
      //Auth::userが$userをフォロー中なら
      if($user->isFollowedBy(Auth::user())){
        //フォローを解除
        Auth::user()->followings()->detach($user);
        return 'unfollow';
      }else{
        //フォローする
        Auth::user()->followings()->attach($user);
        return 'follow';
      }

    }

    public function getUsersBySearchName($name){
      $users = User::where('name', 'like', '%' . $name . '%')->get();
      return response()->json($users);
    }
}
