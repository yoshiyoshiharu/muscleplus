<div class="card-body d-flex justify-content-between">
  <div class="card-left">
    <div class="profile-photo" >
      <a href="{{route('users.show' , ['user' => $post->user])}}">
        @if($post->user->profile_photo)
        <img src="{{asset('storage/user_images/' . $post->user->profile_photo)}}">
        @else
        <img src="{{asset('images/noimage.png')}}">
        @endif
      </a>
      <a class="user-name" href="{{route('users.show' , ['user' => $post->user])}}">{{$post->user->name}}</a>
    </div>
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
