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
              <a class="forget">Forgot password?</a>
            </div>
            <div class="other-login">
              <div class="box-title"><span>Log in directly with </span></div>
            </div>
            <div class="social">
              <a class="fb"><img src="public/dashboard/images/ic-facebook.png" alt="Facebook"></a>
              <a class="g-signin2 google " data-onsuccess="onSignIn"><img src="public/dashboard/images/ic-google.png" alt="Google"></a>
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
              <a class="forget">Forgot password?</a>
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
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script>
  //loginGoogle - OT1
  function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    $.ajax({
      url: 'dashboard/login-google.html',
      type: 'POST',
      dataType: 'html',
      data: {email:profile.getEmail()},
      success: function(data) {
        // $('#messageSignIn').html(data);
        alert(data);
      }
    });
  }
</script>

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
    var emailSignIn = $('#emailSignIn').val();
    var passwordSignIn = $('#passwordSignIn').val();
    if(emailSignIn == "" || passwordSignIn == "" ){
      $('#messageSignIn').html('Email or password is null');
      return false;
    }
    if(emailSignIn != "" || passwordSignIn != "" )
    {
      $.ajax({
        url: 'dashboard/checklogin.html',
        type: 'POST',
        dataType: 'json',
        data: {email:emailSignIn, password:passwordSignIn},
        success: function(data) {
          $('#messageSignIn').html(data.message);
          alert(data.message);
        }
      });
      // return false;
    }
  }

</script>
