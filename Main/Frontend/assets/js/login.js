$('#top').on('click','.login.profile',function(){
  $('#lightbox,#moksha-login').fadeIn();
});

$('#lightbox').click(function(){
  $('#lightbox,#moksha-login').fadeOut();
});

$('#moksha-login').on('click','.head>.tab',function(){
  if(!$(this).hasClass('tab-active'))
  {
    var data_tab = $(this).attr('data-tab');
    $('.tab[data-tab="'+data_tab+'"]').addClass('tab-active').css({'border-width':'1px 1px 0px 1px','width':'calc(50% - 2px)'});
    $('.tab[data-tab!="'+data_tab+'"]').removeClass('tab-active').css({'border-width':'0px 0px 1px 0px','width':'50%'});
    $('#moksha-login>.input-wrap').empty();
    if(data_tab=="LogIn")
    {
      $('#moksha-login>.input-wrap').append('<input id="phone-log" type="text" placeholder="Phone"><br>\
			<input id="passphrase" type="password" placeholder="Password"><br><div id="get-logIn" class="moksha-button">Log In</div>');
    }
    else
    {
      $('#moksha-login>.input-wrap').append('<input id="name-reg" type="text" placeholder="Name"><br>\
			<input id="email-reg" type="text" placeholder="Email"><br>\
			<input id="phone" type="text" placeholder="Phone"><br>\
			<input id="college" type="text" placeholder="College"><br>\
      <input id="passphrase-reg" type="password" placeholder="Password"><br>\
			<div id="get-Register" class="moksha-button">LogIn</div>');
    }

  }
});

$('#moksha-login>.input-wrap').on('click','#get-Register',function(){
  var name = $('#name-reg').val();
  var email = $('#email-reg').val();
  var phone = $('#phone').val();
  var college = $('#college').val();
  var pass = $('#passphrase-reg').val();
  $.ajax({
    url:'http://csinsit.org/moksha2016/account/signup.php',
    type:'get',
    data:{name:name,email:email,pass:pass,phone:phone,college:college},
    dataType:'json',
    success:function(r){
      console.log(r);
    },
    error:function(e){
      console.log(e);

    }
  });
});

$('#moksha-login>.input-wrap').on('click','#get-LogIn',function(){
  var phone = $('#phone-log').val();
  var pass = $('#passphrase').val();
  $.ajax({
    url:'http://csinsit.org/moksha2016/account/login.php',
    type:'get',
    data:{pass:pass,phone:phone},
    dataType:'json',
    success:function(r){
      console.log(r);
    },
    error:function(e){
      console.log(e);

    }
  });
});
