<div class="card-body comment-wrap px-4">
  <!-- comment list -->
  <ul id="comment-data">
    @foreach($post->comments as $comment)
    <li class="comment-list">
      <strong class="comment-name">{{$comment->user->name}}</strong>
      <span class="comment">{{$comment->comment}}</span>
    </li>
    @endforeach
    <li class="comment-list" id="comment-template" style="display:none;">
      <strong class="comment-name">hello</strong>
      <span class="comment">hello</span>
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
