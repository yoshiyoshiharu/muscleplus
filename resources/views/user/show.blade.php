@extends('layouts.app')

@section('title' , 'ユーザ情報')


@section('content')
<div class="container pt-5 m-auto">
  <div class="profile-wrap">
    <div class="row">
      <div class="col-md-6">
        <div class="profile-photo">
        @if($user->profile_photo)
          <img src="{{ asset('storage/user_images/' . $user->profile_photo . '?version=' . $user->profile_photo_version)}}">
        @else
          <img src="{{ asset('images/noimage.png/')}}">
        @endif
        </div>
        <div class="follows">
          <a href="{{route('users.followings' , ['user' => $user])}}">{{$user->followings->count()}}フォロー</a>
          <a href="{{route('users.followers' , ['user' => $user])}}" class="follower-count">{{$user->followers->count()}}フォロワー</a>
        </div>
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
      <div class="col-md-6 profile-top mt-3">
        <div class="profile-details">
          <h1 class="user-name">{{ $user->name}}</h1>
          <p class="profile-phrase">{{$user->phrase}}</p>
        </div>
        @if($user->id !== Auth::user()->id)
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
        @endif
      </div>

    </div>
    <div class="user-graph">
      <h2>記録統計</h2>
      @include('user.graph')
    </div>
    <div class="user-posts">
      <h3>記録一覧</h3>
      @foreach($posts as $post)
      <div class="card-wrap">
        <div class="card mt-5">
          <div class="card-body d-flex justify-content-between">
            <div class="card-left">
              <div class="font-weight-lighter time">
                {{$post->created_at->format('Y/m/d H:i')}}
              </div>
            </div>
            @if($post->user == Auth::user())
            <div class="card-right">
              <a href="{{route('posts.edit' , ['post' => $post])}}"><i class="far fa-edit"></i></a>
              <a href="{{route('posts.delete' , ['post' => $post])}}" onclick="return confirm('記録を削除してもよろしいですか？')"><i class="fas fa-trash-alt"></i></a>
            </div>
            @endif
          </div>
          <div class="card-body pt-0">
            <div class="card-text pl-2 post-body">
              {!! nl2br(e( $post->body )) !!}
            </div>
          </div>
          <div class="card-body pl-4">
            <i class="fas fa-heart" style="color:tomato"></i>
            {{$post->likes->count()}}
          </div>
          <!-- タグ -->
          @include('post.tag')
          <!-- コメント -->
          @include('post.comment')
        </div>
      </div>
      @endforeach
    </div>
  </div>
   {{ $posts->links() }}
</div>

@endsection
