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
          <form class="login__form">
            <div class="form-item">
              <input type="text" name="email" placeholder="Email" id="email" value="">
            </div>
            <div class="form-item">
              <input type="password" name="password" placeholder="Password" id="password" value="">
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
              <a class="google"><img src="public/dashboard/images/ic-google.png" alt="Google"></a>
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
          <form class="login__form">
            <div class="form-item">
              <input type="text" name="email" placeholder="Registered Email Address." id="email" value="">
            </div>
            <div class="form-item">
              <input type="password" name="password" placeholder="Password" id="password" value="">
              <a class="check_show_pass"><i class="far fa-eye"></i></a>
            </div>
            <div class="form-item no-bg checkbox">
              <i class="far fa-check-square"></i>
              <div class="label">I agree with <a class="argument">user agreement</a>, and confirm that I am at least 18 years old</div>
            </div>
            <div class="form-item btn-box">
              <button type="submit">Sign Up</button>
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
<script type="text/javascript">
  $(function(){
    //hieu - hidden box sign up
    $('#box-signup').hide();
    //hieu - reset input value
    $('#email').val('');
    $('#password').val('');
  });
  //hieu - show box sign up
  function showSignUp(){
    $('#box-signin').hide();
    $('#box-signup').show();
    $('.signinName').removeClass('active');
    $('.signupName').addClass('active');
  }
  //hieu - show box sign in
  function showSignIn(){
    $('#box-signin').show();
    $('#box-signup').hide();
    $('.signinName').addClass('active');
    $('.signupName').removeClass('active');
  }
</script>
