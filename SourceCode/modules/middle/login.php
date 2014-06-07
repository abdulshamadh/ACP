<?php

/* * ******************************************
 * File - login.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This contains the login form for user called from the login tab at front site
 * ****************************************** */

include_once('session_access.php');
include_once(SERVER_ROOT_PATH . 'class/admin.cls.php');
$objAdmin = new Admin($dbObj);

/** set variables * */
$username = trim(Request::get('txtEmail', '', 'P'));
$password = trim(Request::get('txtPassword', '', 'P'));
$errors = $objAdmin->AdminLogin();
?>
