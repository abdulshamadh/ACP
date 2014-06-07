/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/


// Declaring required variables
var digits = "0123456789";
// non-digit characters which are allowed in phone numbers
var phoneNumberDelimiters = "()- ";
// characters which are allowed in international phone numbers
// (a leading + is OK)
var validWorldPhoneChars = phoneNumberDelimiters + "+";
// Minimum no of digits in an international phone no.
var minDigitsInIPhoneNumber = 10;

function isInteger(s)
{
    var i;
    for (i = 0; i < s.length; i++)
    {
        // Check that current character is number.
        var c = s.charAt(i);
        if (((c < "0") || (c > "9")))
            return false;
    }
    // All characters are numbers.
    return true;
}
function trim(s)
{
    var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not a whitespace, append to returnString.
    for (i = 0; i < s.length; i++)
    {
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (c != " ")
            returnString += c;
    }
    return returnString;
}
function stripCharsInBag(s, bag)
{
    var i;
    var returnString = "";
    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.
    for (i = 0; i < s.length; i++)
    {
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1)
            returnString += c;
    }
    return returnString;
}



$(document).ready(function() {
    //global vars
    var form = $("#registerForm");
    var address = $("#address");
    var addressInfo = $("#addressInfo");

    var phone = $("#phone");
    var phoneInfo = $("#phoneInfo");
    var username = $("#username");
    var usernameInfo = $("#usernameInfo");
    var email = $("#email");
    var emailInfo = $("#emailInfo");
    var pass1 = $("#pass1");
    var pass1Info = $("#pass1Info");
    var pass2 = $("#pass2");
    var pass2Info = $("#pass2Info");
    var agree = $("#agree");
    var user_code = $("#user_code");
    var captcha = $("#captcha-form");
    var captchaInfo = $("#captchaInfo");

    //On blur
    phone.blur(validatePhone);
    address.blur(validateAddress);
    username.blur(validateUserName);
    email.blur(validateEmail);
    pass1.blur(validatePass1);
    pass2.blur(validatePass2);
    user_code.blur(accessCode_validation);
    captcha.blur(validateCaptcha);
    //On key press
    phone.keyup(validatePhone);
    username.keyup(validateUserName);
    email.keyup(validateEmail);
    address.keyup(validateAddress);
    pass1.keyup(validatePass1);
    pass2.keyup(validatePass2);
    user_code.keyup(accessCode_validation);
    captcha.keyup(validateCaptcha);

    //on focus
    pass1.focus(validateUser);
    pass2.focus(validateUser);
    //On Submitting
    form.submit(function() {
        if (validateUser() & validateAgree() & validatePhone() & validateUserName() & validateAddress() & validateEmail() & validatePass1() & validatePass2() & validateCaptcha())
        {

            return true;

        }
        else
        {

            return false;
        }
    });

    //validation functions
    function validateAgree() {

        if (agree.attr('checked') == false) {
            alert("Please agree with the Terms and Conditions!");
            return false;
        }
        //if it's valid
        else {
            return true;
        }
    }

    function validateUser() {
        var f = email_validation(email.val());
        if (f == 1)
            return true;
        else
            return false;
    }


    function validatePhone() {
        var strPhone = $("#phone").val();
        if (phone.val().length < 1) {
            phone.addClass("error");
            phoneInfo.text("Please fill out the phone number!");
            phoneInfo.addClass("error");
            return false;
        }
        else
        {
            var bracket = 3
            var f = 1
            strPhone = trim(strPhone)
            if (strPhone.indexOf("+") > 1)
                f = 1
            if (strPhone.indexOf("-") != -1)
                bracket = bracket + 1
            if (strPhone.indexOf("(") != -1 && strPhone.indexOf("(") > bracket)
                f = 1
            var brchr = strPhone.indexOf("(")
            if (strPhone.indexOf("(") != -1 && strPhone.charAt(brchr + 2) != ")")
                f = 1
            if (strPhone.indexOf("(") == -1 && strPhone.indexOf(")") != -1)
                f = 1
            s = stripCharsInBag(strPhone, validWorldPhoneChars);
            if (isInteger(s) && s.length >= minDigitsInIPhoneNumber)
            {
                phone.removeClass("error");
                phoneInfo.text("What's your Phone Number ?");
                phoneInfo.removeClass("error");
                return true;
            }
            else
            {
                f = 1
            }
            if (f == 1)
            {
                phone.addClass("error");
                phoneInfo.text("Invalid phone number!");
                phoneInfo.addClass("error");
                return false;
            }
        }
    }

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
            emailInfo.text("Type a valid e-mail please :P");
            emailInfo.addClass("error");
            return false;
        }
    }

    function validateAddress() {
        //if it's NOT valid

        if (address.val().length < 1) {
            address.addClass("error");
            addressInfo.text("Please enter the valid address!");
            addressInfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            address.removeClass("error");
            addressInfo.text("What's your Address?");
            addressInfo.removeClass("error");
            return true;
        }
    }

    function validateUserName() {
        //if it's NOT valid

        if (username.val().length < 4) {
            username.addClass("error");
            usernameInfo.text("We want user name with more than 3 letters!");
            usernameInfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            username.removeClass("error");
            usernameInfo.text("What's your user name?");
            usernameInfo.removeClass("error");
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

    function validateCaptcha() {
        if (captcha.val().length < 1) {
            captcha.addClass("error");
            captchaInfo.text("Please type captcha!");
            captchaInfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            captcha.removeClass("error");
            captchaInfo.text("Type captcha here");
            captchaInfo.removeClass("error");
            return true;
        }
    }

}
);

//ajax script for validating user
var f = 0;
function email_validation(email1)
{
    var email = $("#email");
    var emailInfo = $("#emailInfo");
    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            if (xmlhttp.responseText == 1)
            {
                email.addClass("error");
                emailInfo.text("Email is Invalid or already exist!");
                emailInfo.addClass("error");
                f = 2;
            }
            //if it's valid
            else {
                email.removeClass("error");
                emailInfo.text("What's your Email?");
                emailInfo.removeClass("error");
                f = 1;
            }
        }
    }
    xmlhttp.open("GET", "user_check_ajax.php?email=" + email1, true);
    xmlhttp.send();
    return f;
}


//ajax script for validating user
var f1 = 0;
function accessCode_validation()
{
    var user_code = $("#user_code");
    var user_codeInfo = $("#user_codeInfo");

    var id = $("#id").val();
    var accesscode = $("#access_code").val();
    var role = $("#role").val();
    var usercode = $("#user_code").val();


    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function()
    {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            if (xmlhttp.responseText == 1)
            {
                user_code.addClass("error");
                user_codeInfo.text("Invalid Access Code!");
                user_codeInfo.addClass("error");
                f1 = 2;
            }
            //if it's valid
            else {
                user_code.removeClass("error");
                user_codeInfo.text("What's your Access Code?");
                user_codeInfo.removeClass("error");
                f1 = 1;
            }
        }
    }
    xmlhttp.open("GET", "access_code_check_ajax.php?id=" + id + "&accesscode=" + accesscode + "&usercode=" + usercode + "&role=" + role, true);
    xmlhttp.send();
    return f1;
}
