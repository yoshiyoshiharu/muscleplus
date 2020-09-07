@extends('layouts.app')

@section('title' , 'ユーザ情報')


@section('content')
<div class="container pt-5 m-auto">
  <div class="profile-wrap">
    <div class="row">
      <div class="col-md-6">
        @if($user->profile_photo)
        <div class="profile-photo">
          <img src="{{ asset('storage/user_images/' . $user->profile_photo)}}">
        </div>
        @else
        <div class="profile-photo">
          <img src="{{ asset('images/noimage.png/')}}">
        </div>
        @endif
        @if($user->id == Auth::user()->id)
        <div class="profile-edit">
          <a href="{{route('users.edit')}}">プロフィール編集</a>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            ログアウト
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </div>
        @endif
      </div>
      <div class="col-md-6">
        <h1 class="user-name">{{ $user->name}}</h1>
      </div>

    </div>
  </div>
</div>

@endsection
