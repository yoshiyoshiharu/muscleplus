@extends('layouts.app')

@section('title' , '記録一覧')

@section('content')
  <div class="container">
    @foreach($posts as $post)
      <div class="card-wrap">
        <div class="card mt-5">
          <div class="card-body d-flex justify-content-between">
            <div class="card-left">
              <div class="profile-photo" >
                <a href="/users/{{$post->user->id}}">
                  @if($post->user->profile_photo)
                  <img src="{{asset('storage/user_images/' . $post->user->profile_photo)}}">
                  @else
                  <img src="{{asset('images/noimage.png')}}">
                  @endif
                </a>
                <a class="user-name" href="/users/{{$post->user->id}}">{{$post->user->name}}</a>
              </div>
              <div class="font-weight-lighter time">
                {{$post->created_at->format('Y/m/d H:i')}}
              </div>
            </div>
            @if($post->user == Auth::user())
            <div class="card-right">
              <a href="{{route('posts.edit' , ['post' => $post])}}"><i class="far fa-edit"></i></a>
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
            @if($post->likedBy(Auth::user())->count() > 0)
            <!-- いいね済み -->
              <a class="like" href="{{route('likes.delete' , ['like' => $post->likedBy(Auth::user())->firstOrFail() ])}}"><i class="fas fa-heart"></i></a>
            @else
            <!-- いいねまだ -->
              <a class="like" href="{{route('likes.new' , ['post' => $post])}}"><i class="far fa-heart"></i></a>
            @endif
            {{$post->likes->count()}}
          </div>
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
            <form id="comment-form" class="form-group row align-items-center mx-auto" action="{{route('comments.new')}}" method="post">
              {{csrf_field()}}
              <input type="hidden" name="post_id" value="{{$post->id}}">
              <input class="form-control col-11" type="text" name="comment" placeholder="コメントを書く...">
              <i id="send-icon" class="fas fa-paper-plane col-1" onclick="event.preventDefault();document.getElementById('comment-form').submit();"></i>
              @if (count($errors))
                <span class="comment-error">{{ $errors->first() }}</span>
              @endif
            </form>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
