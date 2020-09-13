<div class="card-body pl-4">
  <span class="btn-like" data-id="{{$post->id}}" data-url="{{config('app.url')}}">
    <i class="fa-heart
    <?php if($post->likedBy(Auth::user())->count() > 0){
      echo ' active fas';
    }else{
      echo ' far';
    } ?>">
    </i>
  </span>
  <span class="likes-count">{{$post->likes->count()}}</span>
</div>
