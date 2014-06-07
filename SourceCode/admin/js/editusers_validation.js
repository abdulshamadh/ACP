/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/
$(document).ready(function() {
    var form = $("#editchangepasswordForm");


    var globalpayuserid = $("#globalpay_userid");
    var globalpayuseridinfo = $("#globalpay_useridinfo");

    var oldpassword = $("#oldpassword");
    var oldpasswordinfo = $("#oldpasswordinfo");
    var globalpayhide_password = $("#globalpayhide_password");



    var newpassword = $("#newpassword");
    var newpasswordinfo = $("#newpasswordinfo");

    var confirmpassword = $("#confirmpassword");
    var confirmpasswordinfo = $("#confirmpasswordinfo");


    //On blur
//	globalpayuserid.blur(validglobalpayuserid);
    oldpassword.blur(validateoldpassword);
    newpassword.blur(validatenewpassword);
    confirmpassword.blur(validateconfirmpassword);


    //On key press
//	globalpayuserid.keyup(validglobalpayuserid);
    oldpassword.keyup(validateoldpassword);
    newpassword.keyup(validatenewpassword);
    confirmpassword.keyup(validateconfirmpassword);


    //On Submitting
    form.submit(function() {
        if (validglobalpayuserid() & validateoldpassword() & validatenewpassword() & validateconfirmpassword())
        {
            return true;

        }
        else
        {

            return false;
        }

    });

    function validglobalpayuserid()
    {
        //if it's NOT valid

        if (globalpayuserid.val().length < 1) {
            globalpayuserid.addClass("error");
            globalpayuseridinfo.text("Please enter the valid UserId!");
            globalpayuseridinfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            globalpayuserid.removeClass("error");
            globalpayuseridinfo.removeClass("error");
            return true;
        }
    }



    function validateoldpassword() {
        //if it's NOT valid

        if (oldpassword.val().length < 1) {
            oldpassword.addClass("error");
            oldpasswordinfo.text("Please enter the Password!");
            oldpasswordinfo.addClass("error");
            return false;
        }
        else if (oldpassword.val() != globalpayhide_password.val())
        {
            oldpassword.addClass("error");
            oldpasswordinfo.text("Please enter the valid oldpassword!");
            oldpasswordinfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            oldpassword.removeClass("error");
            oldpasswordinfo.removeClass("error");
            return true;
        }
    }

    function validatenewpassword() {
        //if it's NOT valid

        if (newpassword.val().length < 1) {
            newpassword.addClass("error");
            newpasswordinfo.text("Please enter the valid password!");
            newpasswordinfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            newpassword.removeClass("error");
            newpasswordinfo.removeClass("error");
            return true;
        }
    }

    function validateconfirmpassword() {
        //if it's NOT valid

        if (confirmpassword.val().length < 1) {
            confirmpassword.addClass("error");
            confirmpasswordinfo.text("Please enter the valid password!");
            confirmpasswordinfo.addClass("error");
            return false;
        }
        //if it's NOT  same as new password
        else if (confirmpassword.val() != newpassword.val())
        {
            confirmpassword.addClass("error");
            confirmpasswordinfo.text("Password doesn't match!");
            confirmpasswordinfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            confirmpassword.removeClass("error");
            confirmpasswordinfo.removeClass("error");
            return true;
        }
    }

}
);
