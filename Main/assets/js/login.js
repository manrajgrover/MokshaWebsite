$('#top').on('click','.login.profile',function(){
  $('#lightbox,#moksha-login,#closeloginpop').fadeIn();
});

$('#lightbox').click(function(){
  $('#lightbox,#moksha-login,#closeloginpop,#event-register').fadeOut(function(){
    $('#event-register>.content>.event>header>h3').text('');
    $('#event-register>.content>.event>.section-desc').empty();
    $('#event-register>.content>.rules-prizes>.rules>.section-desc').empty();
    $('#event-register>.content>.rules-prizes>.prizes>.section-desc').empty();
    $('#event-register>.content>.rules-prizes>.register-btn').attr('data-event',-1);
    $('#event-register>.content>.rules-prizes>.register-btn').attr('data-name',null);
    $('#event-register>.content>.large-event-pic>img').css('display','none');
  });

});

$('#closeloginpop').click(function(){
  $('#lightbox,#moksha-login,#closeloginpop,#event-register').fadeOut(function(){
    $('#event-register>.content>.event>header>h3').text('');
    $('#event-register>.content>.event>.section-desc').empty();
    $('#event-register>.content>.rules-prizes>.rules>.section-desc').empty();
    $('#event-register>.content>.rules-prizes>.prizes>.section-desc').empty();
    $('#event-register>.content>.rules-prizes>.register-btn').attr('data-event',-1);
    $('#event-register>.content>.rules-prizes>.register-btn').attr('data-name',null);
    $('#event-register>.content>.large-event-pic>img').css('display','none');
  });
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
      $('#moksha-login>.input-wrap').append('<input id="phone-log" type="text" placeholder="Email/Moksha-ID"><br>\
			<input id="passphrase" type="password" placeholder="Password"><br><div id="get-logIn" class="moksha-button">Log In</div>');
    }
    else
    {
      $('#moksha-login>.input-wrap').append('<input id="name-reg" type="text" placeholder="Name"><br>\
			<input id="email-reg" type="text" placeholder="Email"><br>\
			<input id="phone" type="text" placeholder="Phone"><br>\
			<input id="college" type="text" placeholder="College"><br>\
      <input id="passphrase-reg" type="password" placeholder="Password"><br>\
			<div id="get-Register" class="moksha-button">Register</div>');
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
    url:'../../../api/account/signup.php',
    type:'get',
    data:{name:name,email:email,pass:pass,phone:phone,college:college},
    dataType:'json',
    success:function(r){
      if(r.success==true)
      {
		var moksha_id = parseInt(r.moksha_id);
        alert('Successfully Registered. Your Moksha ID is ' + moksha_id + '. Login to Continue');
      }
      else {
        alert('Invalid or existing Credentials');
      }
    },
    error:function(e){
      console.log(e);
    }
  });
});

$('#moksha-login>.input-wrap').on('click','#get-logIn',function(){
  var phone = $('#phone-log').val();
  var pass = $('#passphrase').val();
  $.ajax({
    url:'../../../api/account/login.php',
    type:'get',
    data:{pass:pass,user_var:phone},
    dataType:'json',
    success:function(r){
      if(r.success==true)
      {
        $('#top').find('.login,.signout').remove();
        $('#top>#panel').append('<div class="signout profile">Signout</div>');
        $('#lightbox,#moksha-login,#closeloginpop').fadeOut();
      }
      else {
        alert('Incorrect Credentials');
      }
    },
    error:function(e){
      console.log(e);

    }
  });
});

$('#top').on('click','.signout.profile',function(){
  $.ajax({
    url:'../../../api/account/signout.php',
    type:'get',
    dataType:'json',
    success:function(r){
      if(r.success==true)
      {
        $('#top').find('.login,.signout').remove();
        $('#top>#panel').append('<div class="login profile">Login</div>');
        $('#lightbox,#moksha-login,#closeloginpop').fadeIn();
      }
    },
    error:function(e){
      console.log(e);
    }
  });
});



$(function(){
  if(!$('#top').find('.signout').length)
  $('#lightbox,#moksha-login,#closeloginpop').fadeIn();
});
