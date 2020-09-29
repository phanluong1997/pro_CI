$(document).ready(function(){
    //show/hide text password signin
    $('.fa-eye').hide();
    $('#check_show_pass_signin').click(function(){
        var attr = $('#passwordSignIn').attr('type');
        if(attr == 'password') {
            $('.fa-eye').show();
            $('.fa-eye-slash').hide();
            $('#passwordSignIn').attr('type', 'text');
        } else {
            $('.fa-eye-slash').show();
            $('.fa-eye').hide();
            $('#passwordSignIn').attr('type', 'password');
        }
    });
    //show/hide text password signin
    $('.ic__eye').hide();
    $('#check_show_pass_signup').click(function(){
        var attr = $('#password').attr('type');
        if(attr == 'password') {
            $('.ic__eye').show();
            $('.ic__eye__hide').hide();
            $('#password').attr('type', 'text');
        } else {
            $('.ic__eye__hide').show();
            $('.ic__eye').hide();
            $('#password').attr('type', 'password');
        }
    });
});
$(function() {
    //otMain - hidden box sign up
    $('#box-signup').hide();
    //hieu - reset input value
    $('#email').val('');
    $('#password').val('');
});
//otMain - show box sign up
function showSignUp() {
    $('#box-signin').hide();
    $('#box-signup').show();
    $('.signinName').removeClass('active');
    $('.signupName').addClass('active');
}
//otMain - show box sign in
function showSignIn() {
    $('#box-signin').show();
    $('#box-signup').hide();
    $('.signinName').addClass('active');
    $('.signupName').removeClass('active');
}
//coppy
function myCopy() {
    var copyText = document.getElementById("fill-copy");
    copyText.select();
    document.execCommand("copy");
}

