<?php

/* * ******************************************
 * File - change_password.cls.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the class file for performing password based queries
 * ****************************************** */

function validateEmail($email) {
    return ereg("^[a-zA-Z0-9]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$", $email);
}

function validatePasswords($pass1, $pass2) {
    //if DOESN'T MATCH
    if (strpos($pass1, ' ') !== false)
        return false;
    //if are valid
    return $pass1 == $pass2 && strlen($pass1) >= 5;
}

function change_password($old_pass, $new_pass, $id) {
    $db = new dbclass();
    $result = $db->select("select * from admin where user_id=" . $id);
    $pass = $result[0]['password'];
    if (md5($old_pass) == $pass) {
        $db->edit("update admin set password='" . md5($new_pass) . "' where user_id=" . $id);
        return "Password Changed.";
    } else {
        return "Password not changed. Please check your old password.";
    }

    $db->close();
}

?>
