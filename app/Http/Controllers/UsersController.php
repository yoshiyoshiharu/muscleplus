<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;
use Illuminate\Validation\Rule;
class UsersController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }

    public function show(User $user){
      return view('user.show' , ['user' => $user]);
    }

    public function edit(){
      $user = Auth::user();
      return view('user.edit' , ['user' => $user]);
    }

    public function update(Request $request)
    {

        $validator = Validator::make($request->all() , [
              'name' => 'required|string|max:255',
              'password' => 'required|string|min:6|confirmed',
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


        if($request->hasFile('profile_photo')){
          if($request->file('profile_photo')->isValid()){
            $request->profile_photo->storeAs('public/user_images', $user->id . '.jpg');
            $user->profile_photo = $user->id . '.jpg';
          }
        }
        $user->password = bcrypt($request->password);
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
}
