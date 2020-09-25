
<div id="myModalLogin" class="modal fade" role="dialog">
  <div class="modal-dialog modalLogin">
    <div class="modal-content">
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="boxTitle">
          <a onclick="showSignIn()" class="signinName active">Sign In</a>
          <a onclick="showSignUp()" class="signupName">Sign Up</a>
        </div>
        <!-- signin content -->
        <div id="box-signin">
          <div class="logo">
            <img src="https://bc.game/img/mainlogo.5c3409cd.svg" alt="Logo">
          </div>
          <div class="slogn">Game of Boosting your Cryptocurrency</div>
          <form name="info" onsubmit="return checkLogin();" action="dashboard/login.html" id="myFormLogin"  method="post" class="login__form"><!--  -->
            <div id="messageSignIn" class="text-danger"></div>
            <div class="form-item">
              <input type="text" name="email" placeholder="Email" id="emailSignIn" value="">
            </div>
            <div class="form-item">
              <input type="password" name="password" placeholder="Password" id="passwordSignIn" value="">
              <a class="check_show_pass"><i class="far fa-eye"></i></a>
            </div>
            <div class="form-item btn-box">
              <button type="submit">Sign In</button>
              <a href="dashboard/forget-password.html" class="forget">Forgot password?</a>
            </div>
            <div class="other-login">
              <div class="box-title"><span>Log in directly with </span></div>
            </div>
            <div class="social">
              <a class="fb"><img src="public/dashboard/images/ic-facebook.png" alt="Facebook"></a>
              <a class="google" id="googleSignIn" ><img src="public/dashboard/images/ic-google.png" alt="Google"></a>
            </div>
          </form>
        </div>
        <!-- end signin content -->

        <!-- signup content -->
        <div id="box-signup">
          <div class="logo">
            <img src="https://bc.game/img/mainlogo.5c3409cd.svg" alt="Logo">
          </div>
          <div class="slogn">Game of Boosting your Cryptocurrency</div>
          <form action="dashboard/SignUp.html" method="post" class="login__form">
            <div id="messageSignUp" class="text-danger"></div>
            <div class="form-item">
              <input type="email" name="email" required="" placeholder="Registered Email Address." id="emailSignUp" value="" >
            </div>
            <div class="form-item">
              <input type="password" name="password" required="" pattern=".{8,}" placeholder="Password" id="password" value="">
              <a class="check_show_pass"><i class="far fa-eye"></i></a>
            </div>
            <div class="form-item no-bg checkbox">
              <i class="far fa-check-square"></i>
              <div class="label">I agree with <a class="argument">user agreement</a>, and confirm that I am at least 18 years old</div>
            </div>
            <div class="form-item btn-box">
              <button type="submit" id="ButtonSignUp">Sign Up</button>
              <a href="dashboard/forget-password.html" class="forget">Forgot password?</a>
            </div>
            <div class="other-login">
              <div class="box-title"><span>Log in directly with </span></div>
            </div>
            <div class="social">
              <a class="fb"><img src="public/dashboard/images/ic-facebook.png" alt="Facebook"></a>
              <a class="google"><img src="public/dashboard/images/ic-google.png" alt="Google"></a>
            </div>
          </form>
        </div>
        <!-- end signup content -->
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(function(){
    //OtMain - hidden box sign up
    $('#box-signup').hide();
    //OtMain - reset input value
    $('#email').val('');
    $('#password').val('');
  });
  //OtMain - show box sign up
  function showSignUp(){
    $('#box-signin').hide();
    $('#box-signup').show();
    $('.signinName').removeClass('active');
    $('.signupName').addClass('active');
  }
  //OtMain - show box sign in
  function showSignIn(){
    $('#box-signin').show();
    $('#box-signup').hide();
    $('.signinName').addClass('active');
    $('.signupName').removeClass('active');
  }

  //check ValidateEmail - OT1
  $(document).ready(function(){
    $("#emailSignUp").keyup(function() {
      var email = $(this).val();
      if(email != ''){
        $.post('dashboard/checkEmail.html',{email:email},function(data){
          $('#messageSignUp').html(data);
          if(data != ''){
            $('#ButtonSignUp').attr('disabled','disabled');
          }
          else{
            $('#ButtonSignUp').removeAttr('disabled');
          }
        });
      }
    }); 
  });


  //Sign in - OT1
  function checkLogin(){
    //Get value to input
    var emailSignIn = $('#emailSignIn').val();
    var passwordSignIn = $('#passwordSignIn').val();
    //Check require
    if(emailSignIn == "" || passwordSignIn == "" ){
      $('#messageSignIn').html('Email or password is empty');
      return false;
    }else{
      let result = 1;
      $.ajax({
        async: false,
        url: 'dashboard/checklogin.html',
        type: 'POST',
        dataType: 'json',
        data: {email:emailSignIn, password:passwordSignIn},
        success: function(data) {
          if(data){
            $('#messageSignIn').html(data.message);
            result = 0;
          }
        }
      });
      if(result == 0){ return false; }else{ return true; }
    }
  }

  //Login Google - OTMain + OT1
  function onLoadGoogleCallback(){
    gapi.load('auth2', function() {
      auth2 = gapi.auth2.init({
        client_id: '44392542747-1m64j0mv7ai4rv53bsvffteg5g997t3p.apps.googleusercontent.com',
        cookiepolicy: 'single_host_origin',
        scope: 'profile'
      });

    auth2.attachClickHandler(element, {},
      function(googleUser) {
          var email = googleUser.getBasicProfile().getEmail();
          var fullname = googleUser.getBasicProfile().getName();
          $.ajax({
            url: 'dashboard/login-google.html',
            type: 'POST',
            dataType: 'json',
            data: {email:email,fullname:fullname},
            success: function(data) {
              if(data.result == 0)
              {
                window.location = "<?php base_url().'dashboard'?>";
              } 
            }
          });
        }, function(error) {
          console.log('Sign-in error', error);
        }
      );
    });

    element = document.getElementById('googleSignIn');
  }

</script>
