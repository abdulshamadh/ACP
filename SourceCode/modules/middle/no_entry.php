<?php

/* * ******************************************
 * File - no_entry.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing user access control based files
 * ****************************************** */
/** perform action * */
if (!isset($_SESSION['SESS_USERID']) or empty($_SESSION['SESS_USERID']) or $_SESSION['SESS_USERID'] == NULL) {
    fnRedirectUrl(SERVER_PATH . 'index.php');
    die();
}
?>
