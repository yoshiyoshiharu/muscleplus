@extends('layouts.app')

@section('title' , '記録一覧')

@section('content')
<div class="container mt-5">
  @include('common.errors')
  <form class="form-group" action="{{route('posts.update' , ['post' => $post])}}" method="post">
    {{csrf_field()}}
    {{method_field('patch')}}
    <!-- ここにチェックボックス -->
    <textarea class="form-control mx-auto" name="body" placeholder="記録内容..." style="width:80%;height:150px;" >{{old('body' , $post->body)}}</textarea>
    <button type="submit" class="btn btn-warning btn-block mt-5 mx-auto" style="width:100px;">変更する</button>
  </form>
</div>
@endsection
