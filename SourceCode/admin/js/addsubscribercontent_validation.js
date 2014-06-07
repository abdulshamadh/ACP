/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function() {
    //global vars
    var form = $("#addContentForm");
    var title = $("#title");
    var titleInfo = $("#titleInfo");
    var description = $("#description");
    var descriptionInfo = $("#descriptionInfo");

    //On blur
    title.blur(validateTitle);
    description.blur(validateDescription);

    //On key press
    title.keyup(validateTitle);
    description.keyup(validateDescription);

    //On Submitting
    form.submit(function() {
        if (validateTitle() & validateDescription())
        {
            return true;
        }
        else
        {
            return false;
        }
    });


    function validateTitle() {
        //if it's NOT valid
        if (title.val().length < 4) {
            title.addClass("error");
            titleInfo.text("We want title with more than 3 letters!");
            titleInfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            title.removeClass("error");
            titleInfo.text("What's your title?");
            titleInfo.removeClass("error");
            return true;
        }
    }

    function validateDescription() {
        //if it's NOT valid
        if (description.val().length < 4) {
            description.addClass("error");
            descriptionInfo.text("We want description with more than 3 letters!");
            descriptionInfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            description.removeClass("error");
            descriptionInfo.text("What's your description?");
            descriptionInfo.removeClass("error");
            return true;
        }
    }
}
);

