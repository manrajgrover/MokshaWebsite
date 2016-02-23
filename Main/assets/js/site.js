$(function(){
  var comp;
  var comp_itr;
  $.ajax({
    url:'../../../api/events/categories.php',
    type:'get',
    dataType:'json',
    success:function(r){
      console.log(r);
    },
    error:function(e){
      console.log(e);
    }
  });
  $.ajax({
    url:'../../../api/events/event_list.php',
    type:'get',
    dataType:'json',
    success:function(r){
      console.log(r);
      comp = r;
      $('#event-register>.content>.event>header>h3').text(r[0].name);
      $('#event-register>.content>.event>.section-desc').empty().append('<p>'+r[0].description+'</p>');
      $('#event-register>.content>.rules-prizes>.rules>.section-desc').empty().append(r[0].rules);
      $('#event-register>.content>.rules-prizes>.prizes>.section-desc').empty().append(r[0].prizes);
      $('#event-register>.content>.rules-prizes>.register-btn').attr('data-event',r[0].id);
      $('#event-register>.content>.rules-prizes>.register-btn').attr('data-name',r[0].name);
      $('#event-register>.content>.large-event-pic>img').attr('src',r[0].image_url);
      comp_itr = 0;
    },
    error:function(e){
      console.log(e);
    }
  });

  $('#event-register>.right-clickable-box').click(function(){
    ++comp_itr;
    if(comp_itr==comp.length)
    comp_itr=0;
    $('#event-register>.content>.event>header>h3').text(comp[comp_itr].name);
    $('#event-register>.content>.event>.section-desc').empty().append('<p>'+comp[comp_itr].description+'</p>');
    $('#event-register>.content>.rules-prizes>.rules>.section-desc').empty().append(comp[comp_itr].rules);
    $('#event-register>.content>.rules-prizes>.prizes>.section-desc').empty().append(comp[comp_itr].prizes);
    $('#event-register>.content>.rules-prizes>.register-btn').attr('data-event',comp[comp_itr].id);
    $('#event-register>.content>.rules-prizes>.register-btn').attr('data-name',comp[comp_itr].name);
    $('#event-register>.content>.large-event-pic>img').attr('src',comp[comp_itr].image_url);
  });

  $('#event-register>.left-clickable-box').click(function(){
    --comp_itr;
    if(comp_itr==-1)
    comp_itr=comp.length-1;
    $('#event-register>.content>.event>header>h3').text(comp[comp_itr].name);
    $('#event-register>.content>.event>.section-desc').empty().append('<p>'+comp[comp_itr].description+'</p>');
    $('#event-register>.content>.rules-prizes>.rules>.section-desc').empty().append(comp[comp_itr].rules);
    $('#event-register>.content>.rules-prizes>.prizes>.section-desc').empty().append(comp[comp_itr].prizes);
    $('#event-register>.content>.rules-prizes>.register-btn').attr('data-event',comp[comp_itr].id);
    $('#event-register>.content>.rules-prizes>.register-btn').attr('data-name',comp[comp_itr].name);
    $('#event-register>.content>.large-event-pic>img').attr('src',comp[comp_itr].image_url);
  });

});
