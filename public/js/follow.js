$(function(){
  'use strict';

  $('.follow').off().on('click' , function(){
    var $this = $(this);
    var $span = $this.children('span');
    var $i = $this.children('i');
    var app_url = $this.data('url');
    var user_id = $this.data('id');

    var url = app_url + '/users/' + user_id + '/follow';

    console.log(url);
    $.ajax({
      type:'get' ,
      url : url ,
      data: 'json'
    }).done(function(data){
      var followers = $this.data('followers');
      console.log(followers);
      if(data == 'follow'){
        $this.removeClass('follow-btn').addClass('followed-btn');
        $i.removeClass('fa-user-plus').addClass('fa-user-check');
        $span.text('フォロー中');
        $('.follower-count').text(followers+1+'フォロワー');
        $this.data('followers' , followers+1);
      }else if(data == 'unfollow'){
        $this.removeClass('followed-btn').addClass('follow-btn');
        $i.removeClass('fa-user-check').addClass('fa-user-plus');
        $span.text('フォローする');
        $('.follower-count').text(followers-1+'フォロワー');
        $this.data('followers' , followers-1);
      }
    }).fail(function(msg) {
          console.log('Ajax Error');
      });;
  });
});
