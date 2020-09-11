<div class="card-body comment-wrap px-4">
  <!-- comment list -->
  <ul class="comment-data">
    
    <li class="comment-list" style="display:none;">
      <span class="name"></span>
      <span class="comment"></span>
    </li>
  </ul>
  <!-- comment form -->
  <form class="comment-form form-group row align-items-center mx-auto" method="post">
    {{csrf_field()}}
    <input type="hidden" name="post_id" value="{{$post->id}}">
    <input class="comment-input form-control col-11" type="text" name="comment" placeholder="コメントを書く..." value="">
    <i class="fas fa-paper-plane col-1 send-icon"></i>
    <span class="comment-error"></span>
  </form>
</div>
<script>

  $(function(){
    'use strict';

    // エンターキーの無効化
    $("input"). keydown(function(e) {
               if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
                   return false;
               } else {
                   return true;
               }
           });

    $('.send-icon').off().on('click' , function(){
      var $this = $(this);
      var $form = $this.parents('.comment-form');
      var $ul = $form.prev('ul');
      var url = '/comments';
      $.ajax({
        type:'post' ,
        url: url ,
        data: $form.serialize(),
        dataType:'json',
        timeout: 5000
      }).done(function(data, status, xhr){
        if(xhr.status === 203){
          //validation error
          $form.children('.comment-error').html(data);
        }else if(xhr.status === 200){
          //success
          console.log(data);
          //前のコメントリストを消去
          $ul.find('.comment-visible').remove();

          //受け取ったコメントリストを表示
          for(var i = 0; i < data.comments.length; i++){
            var commentClone = $ul.children('.comment-list').clone(true).removeAttr('style').addClass('comment-visible');
            commentClone.children('.name').first().append(data.comments[i].user_name);
            commentClone.children('.comment').first().append(data.comments[i].comment);
            $ul.append(commentClone);
          }
          $form.children('.comment-input').val('');

        }

      }).fail(function(msg){
        console.log('failed!');
        console.log(msg);
      });
    });

  });
</script>
