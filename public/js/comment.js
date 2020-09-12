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

    //create
    $('.send-icon').off().on('click' , function(){
      var $this = $(this);
      var $form = $this.parents('#comment-form');
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
          var commentClone = $ul.children('#comment-template').clone();
          commentClone.removeAttr('style');
          commentClone.removeAttr('id');
          commentClone.children('.comment-name').text(data.comments.user_name);
          commentClone.children('.comment').text(data.comments.comment);
          $ul.append(commentClone);

          $form.children('.comment-input').val('');

        }

      }).fail(function(msg){
        console.log('failed!');
        console.log(msg);
      });
    });

    //delete

  });
