<?php

/* * ******************************************
 * File - access_denied.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing user access based files
 * ****************************************** */
if ($_SESSION['SESS_ROLE'] == 'landlord') {
    if ($_REQUEST['file'] == 'invite_landlord') {
        fnRedirectUrl(SERVER_PATH . 'index.php');
        die();
    }
}
if ($_SESSION['SESS_ROLE'] == 'tenant') {
    if ($_REQUEST['file'] == 'invite_tenant') {
        fnRedirectUrl(SERVER_PATH . 'index.php');
        die();
    }
}
?>