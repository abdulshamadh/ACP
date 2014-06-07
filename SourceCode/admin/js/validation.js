/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function() {
    //global vars
    var form = $("#customForm");
    var email = $("#email");
    var emailInfo = $("#emailInfo");
    var pass = $("#pass");
    var passInfo = $("#passInfo");
    var pass1 = $("#pass1");
    var pass1Info = $("#pass1Info");
    var pass2 = $("#pass2");
    var pass2Info = $("#pass2Info");

    //On blur
    email.blur(validateEmail);
    pass.blur(validatePass);
    pass1.blur(validatePass1);
    pass2.blur(validatePass2);
    //On key press
    pass.keyup(validatePass);
    pass1.keyup(validatePass1);
    pass2.keyup(validatePass2);
    //On Submitting
    form.submit(function() {
        if (validateEmail() & validatePass() & validatePass1() & validatePass2())
            return true
        else
            return false;
    });

    //validation functions
    function validateEmail() {
        //testing regular expression
        var a = $("#email").val();
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
        //if it's valid email
        if (filter.test(a)) {
            email.removeClass("error");
            emailInfo.text("Valid E-mail please, you will need it to log in!");
            emailInfo.removeClass("error");
            return true;
        }
        //if it's NOT valid
        else {
            email.addClass("error");
            emailInfo.text("Stop cowboy! Type a valid e-mail please :P");
            emailInfo.addClass("error");
            return false;
        }
    }

    function validatePass() {
        //var a = $("#password1");
        //var b = $("#password2");

        //it's NOT valid
        if (pass.val().length < 5) {
            pass.addClass("error");
            passInfo.text("Ey! Remember: At least 5 characters: letters, numbers and '_'");
            passInfo.addClass("error");
            return false;
        }
        //it's valid
        else {
            pass.removeClass("error");
            passInfo.text("At least 5 characters: letters, numbers and '_'");
            passInfo.removeClass("error");
            validatePass1();
            return true;
        }
    }

    function validatePass1() {
        //var a = $("#password1");
        //var b = $("#password2");

        //it's NOT valid
        if (pass1.val().length < 5) {
            pass1.addClass("error");
            pass1Info.text("Ey! Remember: At least 5 characters: letters, numbers and '_'");
            pass1Info.addClass("error");
            return false;
        }
        //it's valid
        else {
            pass1.removeClass("error");
            pass1Info.text("At least 5 characters: letters, numbers and '_'");
            pass1Info.removeClass("error");
            validatePass2();
            return true;
        }
    }
    function validatePass2() {
        //var a = $("#password1");
        //var b = $("#password2");
        //are NOT valid
        if (pass1.val() != pass2.val()) {
            pass2.addClass("error");
            pass2Info.text("Passwords doesn't match!");
            pass2Info.addClass("error");
            return false;
        }
        //are valid
        else {
            pass2.removeClass("error");
            pass2Info.text("Confirm password");
            pass2Info.removeClass("error");
            return true;
        }
    }
}
);

$(document).ready(function() {
    //global vars
    var form = $("#global_rent");
    var global_username = $("#global_username");
    var emailInfo = $("#emailInfo");
    var pass = $("#pass");
    var passInfo = $("#passInfo");
    var pass1 = $("#pass1");
    var pass1Info = $("#pass1Info");
    var pass2 = $("#pass2");
    var pass2Info = $("#pass2Info");

    //On blur
    global_username.blur(validateUsername);
    pass.blur(validatePass);
    pass1.blur(validatePass1);
    pass2.blur(validatePass2);
    //On key press
    global_username.keyup(validateUsername);
    pass.keyup(validatePass);
    pass1.keyup(validatePass1);
    pass2.keyup(validatePass2);
    //On Submitting
    form.submit(function() {
        if (validateUsername() & validatePass() & validatePass1() & validatePass2())
            return true
        else
            return false;
    });

    //validation functions
    function validateUsername() {
        //it's NOT valid
        if (global_username.val().length < 1) {
            global_username.addClass("error");
            emailInfo.text("Please Enter Valid User name");
            emailInfo.addClass("error");
            return false;
        }
        //it's valid
        else {
            global_username.removeClass("error");
            emailInfo.text("Please Enter Valid User name");
            emailInfo.removeClass("error");
            return true;
        }
    }

    function validatePass() {
        //var a = $("#password1");
        //var b = $("#password2");

        //it's NOT valid
        if (pass.val().length < 5) {
            pass.addClass("error");
            passInfo.text("Ey! Remember: At least 5 characters: letters, numbers and '_'");
            passInfo.addClass("error");
            return false;
        }
        //it's valid
        else {
            pass.removeClass("error");
            passInfo.text("At least 5 characters: letters, numbers and '_'");
            passInfo.removeClass("error");
            validatePass1();
            return true;
        }
    }

    function validatePass1() {
        //var a = $("#password1");
        //var b = $("#password2");

        //it's NOT valid
        if (pass1.val().length < 5) {
            pass1.addClass("error");
            pass1Info.text("Ey! Remember: At least 5 characters: letters, numbers and '_'");
            pass1Info.addClass("error");
            return false;
        }
        //it's valid
        else {
            pass1.removeClass("error");
            pass1Info.text("At least 5 characters: letters, numbers and '_'");
            pass1Info.removeClass("error");
            validatePass2();
            return true;
        }
    }
    function validatePass2() {
        //var a = $("#password1");
        //var b = $("#password2");
        //are NOT valid
        if (pass1.val() != pass2.val()) {
            pass2.addClass("error");
            pass2Info.text("Passwords doesn't match!");
            pass2Info.addClass("error");
            return false;
        }
        //are valid
        else {
            pass2.removeClass("error");
            pass2Info.text("Confirm password");
            pass2Info.removeClass("error");
            return true;
        }
    }
}
);
$(document).ready(function() {
    //global vars
    var form = $("#global_subscription");
    var global_username = $("#global_username_sub");
    var emailInfo = $("#emailInfo");
    var pass = $("#pass_sub");
    var passInfo = $("#passInfo");
    var pass1 = $("#pass1_sub");
    var pass1Info = $("#pass1Info");
    var pass2 = $("#pass2_sub");
    var pass2Info = $("#pass2Info");

    //On blur
    global_username.blur(validateUsername);
    pass.blur(validatePass);
    pass1.blur(validatePass1);
    pass2.blur(validatePass2);
    //On key press
    global_username.keyup(validateUsername);
    pass.keyup(validatePass);
    pass1.keyup(validatePass1);
    pass2.keyup(validatePass2);
    //On Submitting
    form.submit(function() {
        if (validateUsername() & validatePass() & validatePass1() & validatePass2())
            return true
        else
            return false;
    });

    //validation functions
    function validateUsername() {
        //it's NOT valid
        if (global_username.val().length < 1) {
            global_username.addClass("error");
            emailInfo.text("Please Enter Valid User name");
            emailInfo.addClass("error");
            return false;
        }
        //it's valid
        else {
            global_username.removeClass("error");
            emailInfo.text("Please Enter Valid User name");
            emailInfo.removeClass("error");
            return true;
        }
    }

    function validatePass() {
        //var a = $("#password1");
        //var b = $("#password2");

        //it's NOT valid
        if (pass.val().length < 5) {
            pass.addClass("error");
            passInfo.text("Ey! Remember: At least 5 characters: letters, numbers and '_'");
            passInfo.addClass("error");
            return false;
        }
        //it's valid
        else {
            pass.removeClass("error");
            passInfo.text("At least 5 characters: letters, numbers and '_'");
            passInfo.removeClass("error");
            validatePass1();
            return true;
        }
    }

    function validatePass1() {
        //var a = $("#password1");
        //var b = $("#password2");

        //it's NOT valid
        if (pass1.val().length < 5) {
            pass1.addClass("error");
            pass1Info.text("Ey! Remember: At least 5 characters: letters, numbers and '_'");
            pass1Info.addClass("error");
            return false;
        }
        //it's valid
        else {
            pass1.removeClass("error");
            pass1Info.text("At least 5 characters: letters, numbers and '_'");
            pass1Info.removeClass("error");
            validatePass2();
            return true;
        }
    }
    function validatePass2() {
        //var a = $("#password1");
        //var b = $("#password2");
        //are NOT valid
        if (pass1.val() != pass2.val()) {
            pass2.addClass("error");
            pass2Info.text("Passwords doesn't match!");
            pass2Info.addClass("error");
            return false;
        }
        //are valid
        else {
            pass2.removeClass("error");
            pass2Info.text("Confirm password");
            pass2Info.removeClass("error");
            return true;
        }
    }
}
);
$(document).ready(function() {
    //global vars
    var form = $("#global_conv");
    var global_username = $("#global_username_conv");
    var emailInfo = $("#emailInfo");
    var pass = $("#pass_conv");
    var passInfo = $("#passInfo");
    var pass1 = $("#pass1_conv");
    var pass1Info = $("#pass1Info");
    var pass2 = $("#pass2_conv");
    var pass2Info = $("#pass2Info");

    //On blur
    global_username.blur(validateUsername);
    pass.blur(validatePass);
    pass1.blur(validatePass1);
    pass2.blur(validatePass2);
    //On key press
    global_username.keyup(validateUsername);
    pass.keyup(validatePass);
    pass1.keyup(validatePass1);
    pass2.keyup(validatePass2);
    //On Submitting
    form.submit(function() {
        if (validateUsername() & validatePass() & validatePass1() & validatePass2())
            return true
        else
            return false;
    });

    //validation functions
    function validateUsername() {
        //it's NOT valid
        if (global_username.val().length < 1) {
            global_username.addClass("error");
            emailInfo.text("Please Enter Valid User name");
            emailInfo.addClass("error");
            return false;
        }
        //it's valid
        else {
            global_username.removeClass("error");
            emailInfo.text("Please Enter Valid User name");
            emailInfo.removeClass("error");
            return true;
        }
    }

    function validatePass() {
        //var a = $("#password1");
        //var b = $("#password2");

        //it's NOT valid
        if (pass.val().length < 5) {
            pass.addClass("error");
            passInfo.text("Ey! Remember: At least 5 characters: letters, numbers and '_'");
            passInfo.addClass("error");
            return false;
        }
        //it's valid
        else {
            pass.removeClass("error");
            passInfo.text("At least 5 characters: letters, numbers and '_'");
            passInfo.removeClass("error");
            validatePass1();
            return true;
        }
    }

    function validatePass1() {
        //var a = $("#password1");
        //var b = $("#password2");

        //it's NOT valid
        if (pass1.val().length < 5) {
            pass1.addClass("error");
            pass1Info.text("Ey! Remember: At least 5 characters: letters, numbers and '_'");
            pass1Info.addClass("error");
            return false;
        }
        //it's valid
        else {
            pass1.removeClass("error");
            pass1Info.text("At least 5 characters: letters, numbers and '_'");
            pass1Info.removeClass("error");
            validatePass2();
            return true;
        }
    }
    function validatePass2() {
        //var a = $("#password1");
        //var b = $("#password2");
        //are NOT valid
        if (pass1.val() != pass2.val()) {
            pass2.addClass("error");
            pass2Info.text("Passwords doesn't match!");
            pass2Info.addClass("error");
            return false;
        }
        //are valid
        else {
            pass2.removeClass("error");
            pass2Info.text("Confirm password");
            pass2Info.removeClass("error");
            return true;
        }
    }
}
);
