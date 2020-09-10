<div class="card-body pl-4">
  <span class="btn-like" data-id="{{$post->id}}">
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

<script>
$(function(){
  'use strict';

  $('.btn-like').off().on('click' , function(){
    var post_id = $(this).data('id');
    var url = '/likes/' + post_id;
    var $this = $(this);

    $.ajax({
      type:'get' ,
      url : url ,
      data: 'json'
    }).then(function(data){
      $this.children('i').toggleClass('far');
      $this.children('i').toggleClass('fas');
      $this.children('i').toggleClass('active');
      $this.parents('div').children('.likes-count').html(data);
    }).fail(function(msg) {
          console.log('Ajax Error');
      });;
  });
});

</script>
