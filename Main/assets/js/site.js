$(function(){
  var comp;
  var comp_itr;
  var field;
  var iterator;
  var loaded = 0;
  var onImg = 1;

  function slideshow(){
    $('img.logo-img').css('display','none');
    $('img.logo-img[data-mok="'+onImg+'"]').css('display','block');
    ++onImg;

    if(onImg==7)
    onImg=1;
    setTimeout(function(){
      slideshow();
    },250);
  }

  $.ajax({
    url:'../../../api/events/getcompetitions.php',
    type:'get',
    dataType:'json',
    success:function(r){
      for (field in r){
        var listParent = $('#event-page>.event[data-for="'+field+'"]>ul');
        for(iterator in r[field]){
          listParent.prepend('<li event-id="'+r[field][iterator].id+'">\> '+r[field][iterator].name+'</li>');
        }
      }
    },
    error:function(e){
      console.log(e);
    }
  });

  $('#event-page>.event>ul').on('click','li',function(){
    var event_id = Number($(this).attr('event-id'));
    if(event_id!=0){
      $.ajax({
        url:'../../../api/events/event_list.php',
        type:'get',
        data:{event_id:event_id},
        dataType:'json',
        success:function(r){
          console.log(r);
          $('#event-register>.content>.event>header>h3').text(r.name);
          $('#event-register>.content>.event>.section-desc').empty().append('<p>'+r.description+'</p>');
          $('#event-register>.content>.rules-prizes>.rules>.section-desc').empty().append(r.rules);
          $('#event-register>.content>.rules-prizes>.prizes>.section-desc').empty().append(r.prizes);
          $('#event-register>.content>.rules-prizes>.register-btn').attr('data-event',r.id);
          $('#event-register>.content>.rules-prizes>.register-btn').attr('data-name',r.name);
          $('#event-register>.content>.large-event-pic>img').attr('src',r.image_url);
          $('#event-register>.content>.large-event-pic>img').load(function(){
            $(this).css('display','block');
          });
          $('#lightbox,#event-register,#closeloginpop').fadeIn();
        },
        error:function(e){
          console.log(e);
        }
      });
    }
  });

  $('.logo-img').load(function(){
    ++loaded;
  });

  slideshow();
});
