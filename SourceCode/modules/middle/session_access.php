<?php

/* * ******************************************
 * File - session_access.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing user session access based files
 * ****************************************** */
if (isset($_SESSION['SESS_USERID']) or ($_SESSION['SESS_USERID']) or $_SESSION['SESS_USERID'] != NULL) {
    fnRedirectUrl(SERVER_PATH . 'index.php');
    die();
}
?>