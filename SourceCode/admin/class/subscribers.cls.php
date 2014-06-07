<?php

/* * ******************************************
 * File - subscribers.cls.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the class file for performing subscribers based queries
 * ****************************************** */
//Mail Function class File
include("class/emailtemplate.cls.php");

function get_subscribers() {
    $db = new dbclass();
    return $db->select("select * from tbl_subscribers");
}

function delete_subscriber($id) {
    $db = new dbclass();
    $db->db_query("delete from tbl_subscribers where subscriber_id=" . $id);
    $db->close();
    return "<div class='valid' id='error'><ul><li><strong>Subscriber record has been deleted successfully.</strong></li></ul></div>";
}

// Original PHP code by Chirp Internet: www.chirp.com.au 
// Please acknowledge use of this code by including this header. 	
function myTruncate($string, $limit, $break = ".", $pad = "...") {
    // return with no change if string is shorter than $limit 
    if (strlen($string) <= $limit)
        return $string;
    // is $break present between $limit and the end of the string? 
    if (false !== ($breakpoint = strpos($string, $break, $limit))) {
        if ($breakpoint < strlen($string) - 1) {
            $string = substr($string, 0, $breakpoint) . $pad;
        }
    }
    return $string;
}

function validateTitle($title) {
    //if it's NOT valid
    if (strlen($title) < 4)
        return false;
    //if it's valid
    else
        return true;
}

function validateDescription($description) {
    //if it's NOT valid
    if (strlen($description) < 4)
        return false;
    //if it's valid
    else
        return true;
}

function content_add($title, $description, $status) {
    $db = new dbclass();
    $date = date("Y-m-d");
    $db->insert("insert into tbl_subscribers (title,description,created_on,status) values ('" . $title . "','" . $description . "',now()," . $status . ")");
    return "Subscriber Content Created.";
    $db->close();
}

function content_updation($id, $title, $description, $status) {
    $date = date("Y-m-d");
    $db = new dbclass();
    $description = addslashes($description);
    $db->edit("update tbl_subscribers set title='" . $title . "',description='" . $description . "',status=" . $status . " where subscriber_id=" . $id);
    $db->close();
    header("Location: " . $PHP_SELF . "?file=subscribers&f=1");
}

function select_subscribers($id) {
    $db = new dbclass();
    return $db->select("select * from tbl_subscribers where subscriber_id=" . $id);
}

/*
 * Function used to send the mail after cancelled the ACP Computer account
 * name: account_cancellation
 * param string
 * param string
 * @access public
 */

function send_emailsubscribers($id) {
    $mail = new Emailtemplate();
    $db = new dbclass();
    $user_result = $db->select("select user_id,firstname,lastname,email,subscription,status from tbl_users where subscription=1 AND status=1");
    $subscribe_result = $db->select("select subscriber_id,title,description,created_on,status from tbl_subscribers where subscriber_id=" . $id);
    if (count($subscribe_result) > 0) {
        for ($i = 0; $i < count($subscribe_result); $i++) {
            $mailtitle = $subscribe_result[$i]['title'];
            $message = $subscribe_result[$i]['description'];
        }
    }
    if (count($user_result) > 0) {
        for ($i = 0; $i < count($user_result); $i++) {
            $user_id = $user_result[$i]['user_id'];
            $email = $user_result[$i]['email'];
            $name = $user_result[$i]['firstname'];
            $mail->send_mail('support@acpcomputer.edu.sg', $user_id, $email, $name, $mailtitle, $message);
        }
    }
    header("Location: " . $PHP_SELF . "?file=subscribers&s=1");
}

?>
