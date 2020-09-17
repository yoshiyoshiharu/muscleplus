<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate()
    {
        $email = 'guest@guest.com';
        $password = 'guestpass';

        if (\Auth::attempt(['email' => $email, 'password' => $password])) {
            // 認証に成功した
            return redirect('/home');
        }
        return back();
    }

    public function redirectToFacebook(){
      return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(){
      try{
        $fUser = Socialite::driver('facebook')->stateless()->user();
      } catch (Exception $e){
        return redirect('/login')->withErrors('ユーザ情報の取得に失敗しました。' , 'facebook');
      }

      $user = User::where(['email' => $fUser->getEmail()])->first();

      //登録済み
      if($user){
        \Auth::login($user);
        return redirect('/home');
      }
      //未登録
       else {
        $user = new User;
        $user->name = $fUser->getName();
        $user->email = $fUser->getEmail();

        $img = file_get_contents($fUser->avatar_original);
        if ($img !== false) {
          $file_name = $fUser->id . '.jpg';
          Storage::put('public/user_images/' . $file_name, $img);
          $user->profile_photo = $file_name;
        }

        $user->password = \Hash::make(uniqid());
        $user->save();

        \Auth::login($user);
        return redirect('/home');
      }
    }
}
