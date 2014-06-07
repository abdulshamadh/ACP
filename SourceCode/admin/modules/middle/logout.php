<?php

/* * ******************************************
 * File - logout.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This contains the logout form for user called from the logout tab at admin site
 * ****************************************** */
/** perform action * */
unset($_SESSION['SESS_ADMINID']);
unset($_SESSION['SESS_ADMINNAME']);
unset($_SESSION['SESS_EMAIL']);
session_destroy();
fnRedirectUrl('index.php');
die();
?>