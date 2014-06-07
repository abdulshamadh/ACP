<?php

/* * ******************************************
 * File - active.cls.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the class file for performing user account active based queries
 * ****************************************** */

function user_active($user_id) {
    $user_id = base64_decode($user_id);
    $db = new dbclass();
    $db->edit("update tbl_users set status=1 where user_id=" . $user_id);
    $db->close();
}

?>
