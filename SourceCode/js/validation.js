/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/
//cancel button function 
function cancel_tenant_change_password()
{
    window.location.href = "index.php?file=profile";
}
//cancel button function 
function cancel_tenantprofile_change_password()
{
    window.location.href = "index.php?file=tenant_profile";
}

$(document).ready(function() {
    //global vars
    var form = $("#changepasswordForm");
    var pass = $("#pass");
    var passInfo = $("#passInfo");
    var pass1 = $("#pass1");
    var pass1Info = $("#pass1Info");
    var pass2 = $("#pass2");
    var pass2Info = $("#pass2Info");

    //On blur
    pass.blur(validatePass);
    pass1.blur(validatePass1);
    pass2.blur(validatePass2);
    //On key press
    pass.keyup(validatePass);
    pass1.keyup(validatePass1);
    pass2.keyup(validatePass2);
    //On Submitting
    form.submit(function() {
        if (validatePass() & validatePass1() & validatePass2())
            return true;
        else
            return false;
    });


    function validatePass() {
        //var a = $("#password1");
        //var b = $("#password2");

        //it's NOT valid
        if (pass.val().length < 5) {
            pass.addClass("error");
            passInfo.text("At least 5 characters: letters, numbers and '_'");
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
            pass1Info.text("At least 5 characters: letters, numbers and '_'");
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
