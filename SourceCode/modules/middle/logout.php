<?php
/* * ******************************************
 * File - logout.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This contains the logout form for user called from the logout tab at front site
 * ****************************************** */
/** perform action * */
unset($_SESSION['SESS_USERID']);
unset($_SESSION['SESS_ID']);
unset($_SESSION['SESS_USERNAME']);
unset($_SESSION['SESS_EMAIL']);
unset($_SESSION['SESS_SUBSCRIPTION']);
session_destroy();
header('Location: index.php');
?>
