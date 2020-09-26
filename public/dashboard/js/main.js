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
//percentage
$(function() {
    $('#txtAmount').keyup(function() {
        var inputTxtAmount = $('#txtAmount').val();
        if (inputTxtAmount > 0) {
            var percentage = ((90 * inputTxtAmount) / 100);
            var amountETH = percentage * 2;
            $('#txtAmountReceive').attr('value', percentage);
            $('#txtETH').attr('value', amountETH);
        } else {
            $('#txtAmountReceive').attr('value', 0);
            $('#txtETH').attr('value', 0);
        }
    });
});