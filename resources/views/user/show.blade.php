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
    <div class="user-graph">
      @include('user.graph')
    </div>
    <div class="user-posts">
      <h3>記録一覧</h3>
      @foreach($user->posts->sortByDesc('created_at') as $post)
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
              <a href="{{route('posts.delete' , ['post' => $post])}}" onclick="return confirm('記録を削除してもよろしいですか？')"><i class="fas fa-trash"></i></a>
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
          <div class="card-body comment-wrap px-4">
            <!-- コメント -->
            @foreach($post->comments as $comment)
              <div class="card-text mb-2">
                <strong class="mr-2"><a href="/users/{{$comment->user->id}}">{{$comment->user->name}}</a></strong>
                <span>{{$comment->comment}}</span>
                @if($comment->user == Auth::user())
                  <a href="{{route('comments.delete' , ['comment' => $comment])}}" onclick="return confirm('コメントを削除してもよろしいですか？')">[x]</a>
                @endif
              </div>
            @endforeach
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection
