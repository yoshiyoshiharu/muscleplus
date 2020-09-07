@extends('layouts.app')

@section('title' , '記録一覧')

@section('content')
<div class="container mt-5">
  <form class="form-group" action="{{route('posts.store')}}" method="post">
    {{csrf_field()}}
    <!-- ここにチェックボックス -->
    <textarea class="form-control mx-auto" name="body" placeholder="記録内容..." style="width:80%;height:150px;"></textarea>
    <button type="submit" class="btn btn-warning btn-block mt-5 mx-auto" style="width:100px;">記録する</button>
  </form>
</div>
@endsection
