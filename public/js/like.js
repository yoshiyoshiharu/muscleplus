$(function(){
  'use strict';

  $('.btn-like').off().on('click' , function(){
    var $this = $(this);
    var post_id = $this.data('id');
    var app_url = $this.data('url');
    var url = app_url + '/likes/' + post_id;

    $.ajax({
      type:'get' ,
      url : url ,
      data: 'json'
    }).done(function(data){
      $this.children('i').toggleClass('far');
      $this.children('i').toggleClass('fas');
      $this.children('i').toggleClass('active');
      $this.parents('div').children('.likes-count').html(data);
    }).fail(function(msg) {
          console.log('Ajax Error');
      });;
  });
});
