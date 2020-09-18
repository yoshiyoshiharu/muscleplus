@extends('layouts.app')

@section('title' , '記録一覧')

@section('content')
<div class="container mt-5">
  @include('common.errors')
  <form class="form-group" style="width:80%;margin:0 auto;" action="{{route('posts.update' , ['post' => $post])}}" method="post">
    {{csrf_field()}}
    {{method_field('patch')}}
    <p>記録する部位を選択してください</p>
    <div class="tags">
      @foreach($tags as $tag)
      <div class="checkbox">
        <label>
          <input type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id , $tags_id) ? "checked" : ""}}> <span class="tag-name" >{{$tag->name}}</span>
        </label>
      </div>
      @endforeach
    </div>
    <textarea class="form-control mx-auto" name="body" placeholder="記録内容..." style="width:100%;height:150px;" >{{old('body' , $post->body)}}</textarea>
    <button type="submit" class="btn btn-warning btn-block mt-5 mx-auto" style="width:100px;">変更する</button>
  </form>
</div>
@endsection
