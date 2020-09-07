<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Post extends Model
{
    protected $fillable = [
      'body'
    ];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function likes(){
      return $this->hasMany('App\Like');
    }

    public function likedBy(User $user){
      return Like::where('user_id', $user->id)->where('post_id', $this->id);
    }



}
