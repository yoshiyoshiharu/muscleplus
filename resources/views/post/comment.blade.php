<div class="card-body comment-wrap px-4">
  @foreach($post->comments as $comment)
    <div class="card-text mb-2">
      <strong class="mr-2"><a href="/users/{{$comment->user->id}}">{{$comment->user->name}}</a></strong>
      <span>{{$comment->comment}}</span>
      @if($comment->user == Auth::user())
        <a href="{{route('comments.delete' , ['comment' => $comment])}}" onclick="return confirm('コメントを削除してもよろしいですか？')">[x]</a>
      @endif
    </div>
  @endforeach
  <form id="comment-form" class="form-group row align-items-center mx-auto" action="{{route('comments.new')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <input class="form-control col-11" type="text" name="comment" placeholder="コメントを書く...">
    <i id="send-icon" class="fas fa-paper-plane col-1" onclick="event.preventDefault();document.getElementById('comment-form').submit();"></i>
    @if (count($errors))
      <span class="comment-error">{{ $errors->first() }}</span>
    @endif
  </form>
</div>
