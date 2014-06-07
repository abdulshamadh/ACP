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
    var form = $("#editUserForm");
    var firstname = $("#firstname");
    var firstnameInfo = $("#firstnameInfo");
    var lastname = $("#lastname");
    var lastnameInfo = $("#lastnameInfo");
    var pass1 = $("#pass1");
    var pass1Info = $("#pass1Info");
    var pass2 = $("#pass2");
    var pass2Info = $("#pass2Info");
    var email = $("#email");
    var emailInfo = $("#emailInfo");

    //On blur
    firstname.blur(validateFirstName);
    lastname.blur(validateLastName);
    pass1.blur(validatePass1);
    pass2.blur(validatePass2);
    email.blur(validateEmail);

    //On key press
    firstname.keyup(validateFirstName);
    lastname.keyup(validateLastName);
    pass1.keyup(validatePass1);
    pass2.keyup(validatePass2);
    //on change

    //on focus


    //On Submitting
    form.submit(function() {
        if (validateFirstName() & validateLastName() & validateEmail() & validatePass1() & validatePass2())
            return true;
        else
            return false;
    });

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

    function validateFirstName() {
        //if it's NOT valid
        if (firstname.val().length < 4) {
            firstname.addClass("error");
            firstnameInfo.text("We want first name with more than 3 letters!");
            firstnameInfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            firstname.removeClass("error");
            firstnameInfo.text("What's your first name?");
            firstnameInfo.removeClass("error");
            return true;
        }
    }

    function validateLastName() {
        //if it's NOT valid
        if (lastname.val().length < 4) {
            lastname.addClass("error");
            lastnameInfo.text("We want last name with more than 3 letters!");
            lastnameInfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            lastname.removeClass("error");
            lastnameInfo.text("What's your last name?");
            lastnameInfo.removeClass("error");
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
