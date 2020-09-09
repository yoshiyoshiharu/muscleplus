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
