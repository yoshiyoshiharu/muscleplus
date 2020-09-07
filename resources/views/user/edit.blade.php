@extends('layouts.app')

@section('title' , 'ユーザ編集')

@section('content')
<div class="container mt-5">
  <div class="col-md-offset-2 mb-4 edit-profile-wrapper">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="profile-form-wrap">
          @include('common.errors')
          <form class="edit-user" enctype="multipart/form-data" action="{{route('users.update')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="id" value="{{ $user->id }}" />
            <div class="form-group">
              <p class="mb-1 mt-4">プロフィール写真</p>
              @if ($user->profile_photo)
              <div>
                <img src="{{ asset('storage/user_images/' . $user->profile_photo) }}">
              </div>
              @endif
              <input type="file" name="profile_photo"  value="{{ old('profile_photo',$user->id) }}" accept="image/jpeg,image/gif,image/png" />
            </div>

            <div class="form-group">
              <p class="mb-1 mt-4">ユーザー名</p>
              <input autofocus="autofocus" class="form-control" type="text" value="{{ old('name',$user->name) }}" name="name" />
            </div>

            <div class="form-group">
              <p class="mb-1 mt-4">パスワード</p>
              <input autofocus="autofocus" class="form-control" type="password" name="password" />
            </div>

            <div class="form-group">
              <p class="mb-1 mt-4">パスワード確認</p>
              <input autofocus="autofocus" class="form-control" type="password" name="password_confirmation" />
            </div>

            <input type="submit" value="変更する" class="btn btn-primary" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
