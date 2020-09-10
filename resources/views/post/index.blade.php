@extends('layouts.app')

@section('title' , '記録一覧')

@section('content')
  <div class="container">
    @foreach($posts as $post)
      <div class="card-wrap">
        <div class="card mt-5">
          @include('post.card')

          @include('post.like')

          @include('post.tag')

          @include('post.comment')
        </div>
      </div>
    @endforeach
  </div>
@endsection
