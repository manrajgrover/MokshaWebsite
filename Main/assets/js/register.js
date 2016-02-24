$(function(){
  $('#event-register>.content>.rules-prizes').on('click','.register-btn',function(){
    var el = $(this);
    $.ajax({
      url:'../../../api/register/new.php',
      type:'get',
      data:{event_id:Number(el.attr('data-event'))},
      dataType:'json',
      success:function(r){
        if(r.errcode==0)
        alert('Successfully registered for '+el.attr('data-name'));
        if(r.errcode==1)
        {
          alert('Please Login to Register for events');
        }
        if(r.errcode==2)
        alert('Already registered for '+el.attr('data-name'));
      },
      error:function(e){
        console.log(e);
      }
    });
  });

  /*$('#event-page>.event>ul').on('click','li',function(){

  });*/

});
