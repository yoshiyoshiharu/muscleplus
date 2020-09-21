$(function(){
  'use strict';

  $('.search-btn').on('click', function () {
     var $this = $(this);
     var user_name = $('#search-input').val();
     var app_url = $this.data('url');

     if (!user_name) {
         return false;
     }

     $.ajax({
         type: 'GET',
         url: app_url + '/users/index/' + user_name,
         dataType: 'json',
      }).done(function (data){

        $('#search-users').find('.search-user-visible').remove();
        $('#search-users').find('.not-users').remove();
        if(data.length == 0){
          $('#search-users').append('<p class="not-users">ユーザーが見つかりませんでした</p>')
        }

        for(var i=0;i<data.length;i++){

          var searchClone = $('.search-user-template').clone();
          searchClone.removeAttr('style');
          searchClone.removeClass('search-user-template');
          searchClone.addClass('search-user-visible');
          if(data[i].profile_photo){
            searchClone.find('img').attr('src' , app_url + '/storage/user_images/' + data[i].profile_photo);
          }
          searchClone.find('a').attr('href' , app_url + '/users/' + data[i].id);
          searchClone.find('strong').text(data[i].name);
          searchClone.find('p').text(data[i].phrase);
          $('#search-users').append(searchClone);
        }
      }).fail(function () {
        console.log("ajax error");
      });
    });
});
