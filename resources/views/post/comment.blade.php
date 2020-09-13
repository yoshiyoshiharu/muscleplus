<div class="card-body comment-wrap px-4">
  <!-- comment list -->
  <ul id="comment-data">
    @foreach($post->comments as $comment)
    <li class="comment-list" data-id="{{$comment->id}}">
      <a href="{{route('users.show' , ['user' => $comment->user])}}"><strong class="comment-name">{{$comment->user->name}}</strong></a>
      <span class="comment">{{$comment->comment}}</span>
      @if(Auth::user()->id === $comment->user->id)
        <span class="delete-btn">[x]</span>
        <form class="comment-delete" method="post" style="display:none;">
          {{csrf_field()}}
        </form>
      @endif
    </li>
    @endforeach
    <li class="comment-list" id="comment-template" style="display:none;" data-id="">
      <a href="{{route('users.show' , ['user' => Auth::user()])}}"><strong class="comment-name"></strong></a>
      <span class="comment"></span>
      <span class="delete-btn">[x]</span>
      <form class="comment-delete" method="post" style="display:none;">
        {{csrf_field()}}
      </form>
    </li>
  </ul>
  <!-- comment form -->
  <form id="comment-form" class="form-group row align-items-center mx-auto" method="post">
    {{csrf_field()}}
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <input class="comment-input form-control col-11" type="text" name="comment" placeholder="コメントを書く..." value="">
    <i class="fas fa-paper-plane col-1 send-icon"></i>
    <span class="comment-error"></span>
  </form>
</div>
