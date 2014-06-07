<?php

/* * ******************************************
 * File - edituser.cls.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - Description - This is the class file for performing user edit/update based queries
 * * ***************************************** */

function validateFirstName($name) {
    //if it's NOT valid
    if (strlen($name) < 4)
        return false;
    //if it's valid
    else
        return true;
}

function validateLastName($name) {
    //if it's NOT valid
    if (strlen($name) < 4)
        return false;
    //if it's valid
    else
        return true;
}

function validatePasswords($pass1, $pass2) {
    //if DOESN'T MATCH
    if (strpos($pass1, ' ') !== false)
        return false;
    //if are valid
    return $pass1 == $pass2 && strlen($pass1) >= 5;
}

function user_updation($id, $firstname, $lastname, $pass, $status) {
    $db = new dbclass();
    global $dbObj, $pass_key;
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($pass_key), $pass, MCRYPT_MODE_CBC, md5(md5($pass_key))));
    $db->edit("update tbl_users set firstname='" . $firstname . "',lastname='" . $lastname . "',password='" . $encrypted . "',status=" . $status . " where user_id=" . $id);
    $db->close();
    header("Location: " . $PHP_SELF . "?file=edituser&f=1");
}

function user_subscription_updation($id, $subscription) {
    $db = new dbclass();
    $db->edit("update tbl_users set subscription='" . $subscription . "' where user_id=" . $id);
    $db->close();
    header("Location: " . $PHP_SELF . "?file=subscribe&f=1");
}

function user_unsubscription_updation($id, $subscription) {
    $db = new dbclass();
    $db->edit("update tbl_users set subscription='" . $subscription . "' where user_id=" . $id);
    $db->close();
    $id = base64_encode($id);
    header("Location: " . $PHP_SELF . "?file=unsubscribe&f=1&user_id=" . $id);
}

function select_users($id) {
    $db = new dbclass();
    return $db->select("select * from tbl_users where user_id=" . $id);
}

?>
