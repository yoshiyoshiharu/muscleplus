@extends('layouts.app')

@section('title' , 'フォロー一覧')

@section('content')

<div class="followings-wrap">
  <div class="container">
    <h1>フォロー中のユーザー一覧</h1>
    @foreach($followings as $user)
      <div class="follow-card">
        <div class="follow-left">
          <a href="{{route('users.show' , ['user' => $user])}}">
          <div class="follow-profile-photo" >
          @if($user->profile_photo)
            <img src="{{ asset('storage/user_images/' . $user->profile_photo . '?version=' . $user->profile_photo_version)}}">
          @else
            <img src="{{ asset('images/noimage.png/')}}">
          @endif
          </div>
        </a>
        <a href="{{route('users.show' , ['user' => $user])}}"><strong>{{$user->name}}</strong></a>
        @if(Auth::user()->isFollowedBy($user))
        <div class="is-followed">
          フォローされています
        </div>
        @endif
        </div>
        <div class="follow-right">
          <?php $whether_follow = (bool)$user->isFollowedBy(Auth::user());?>
          <div class="btn">
            <button class="<?php echo $whether_follow ? 'followed-btn' : 'follow-btn'; ?> follow btn-md shadow-none border border-primary p-2 "
              data-url="{{config('app.url')}}"
              data-id="{{$user->id}}"
              data-followers="{{$user->followers->count()}}">
              <i class="fas
              <?php echo $whether_follow ? 'fa-user-check' : 'fa-user-plus'; ?>"></i>
              <span><?php echo $whether_follow ? 'フォロー中' : 'フォローする'; ?></span>
            </button>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection
