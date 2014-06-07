<?php

/*
 * Function used to send the mail after cancelled the ACP Computer account
 * name: account_cancellation
 * param string
 * param string
 * @access public
 */

function get_users() {
    $db = new dbclass();
    return $db->select("select user_id,firstname,lastname,email,subscription,created_on,status from tbl_users");
}

function delete_users($id) {
    $db = new dbclass();
    $db->db_query("delete from tbl_users where user_id=" . $id);
    $db->close();
    return "<div class='valid' id='error'><ul><li><strong>User record has been deleted successfully.</strong></li></ul></div>";
}

/*
 * Function used to user update the status Active or In-Active
 * name: user_updation
 * param string
 * param string
 * @access public
 */

function user_updation($id, $email, $status, $globalid = '', $newpassword = '') {
    $db = new dbclass();
    $db->edit("update tbl_users set status=" . $status . " where user_id=" . $id);
    $db->close();
    header('Location: index.php?file=users&f=1');
}

/*
 * Function used to select the all the users list from the database
 * name: sent_autopay_email_landlord
 * param string
 * param string
 * @access public
 */

function select_users($id) {
    $db = new dbclass();
    return $db->select("select * from tbl_users where user_id=" . $id);
}

?>
