@extends('layouts.app')

@section('title' , '記録一覧')

@section('content')
  <div class="container">
    <div class="row">
      <div class="search-wrapper col-md-4 order-md-1 mt-5">
        <div class="user-search-form">
          <div class="form-group row">
            <input id="search-input" type="text" class="form-control col-10" placeholder="ユーザ名を検索する">
            <div class="search-btn btn btn-primary col-2" data-url={{config('app.url')}}>
              検索
            </div>
          </div>
        </div>
        <div id="search-users">

        </div>
        <div class="search-user-template search-user-card" style="display:none;">
          <a href=""><img src="{{asset('images/noimage.png')}}"></a>
          <a href=""><strong></strong></a>
          <p></p>
        </div>
      </div>
      <div class="card-wrap col-md-8 order-md-0">
        @foreach($posts as $post)
        <div class="card mt-5">
          @include('post.card')

          @include('post.like')

          @include('post.tag')

          @include('post.comment')
        </div>
        @endforeach
      </div>

    </div>

  </div>
@endsection
