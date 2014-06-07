/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/
function performDelete(DestURL, name) {
    var ok = confirm("Are you sure you want to delete " + name + "?");
    if (ok) {
        location.href = DestURL;
    }
    return ok;
}
function performSubscribers(DestURL, name) {
    var ok = confirm("Are you sure you want to send email to all the subscribers " + name + "?");
    if (ok) {
        location.href = DestURL;
    }
    return ok;
}
