<div class="card-body pt-0">
  @foreach($post->tags as $tag)
    <span class="tag-name parts-{{$tag->id}}">{{$tag->name}}</span>
  @endforeach
</div>
