/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function() {
    //global vars
    var form = $("#forgotForm");

    var email = $("#email");
    var emailInfo = $("#emailInfo");

    var captcha = $("#captcha-form");
    var captchaInfo = $("#captchaInfo");

    //On blur
    email.blur(validateEmail);
    captcha.blur(validateCaptcha);

    //On key press
    email.keyup(validateEmail);
    captcha.keyup(validateCaptcha);

    //on focus

    //On Submitting
    form.submit(function() {
        if (validateEmail() & validateCaptcha())
        {
            return true;
        }
        else
        {
            return false;
        }
    });

    function validateEmail() {
        //testing regular expression
        var a = $("#email").val();
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
        //if it's valid email
        if (filter.test(a)) {
            email.removeClass("error");
            emailInfo.text("Your password will be sent to this email");
            emailInfo.removeClass("error");
            return true;
        }
        //if it's NOT valid
        else {
            email.addClass("error");
            emailInfo.text("Enter a valid email address");
            emailInfo.addClass("error");
            return false;
        }
    }
    function validateCaptcha() {
        var captcha = $("#captcha-form");
        if (captcha.val().length < 1) {
            captcha.addClass("error");
            captchaInfo.text("Please type captcha!");
            captchaInfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            captcha.removeClass("error");
            captchaInfo.text("");
            captchaInfo.removeClass("error");
            return true;
        }
    }
}
);
