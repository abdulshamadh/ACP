<?php

/* * ******************************************
 * File - global.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the class file for performing global based files included
 * ****************************************** */
session_start();
include_once('../class/config.inc.php');

/* DB Class file is included here */
include_once(SERVER_ROOT_PATH . 'class/db_class.php');
$dbObj = new dbclass();

/** common class file * */
include_once('../class/common.cls.php');
$objCommon = new clsCommon($dbObj);

/* Request Class file is included here */
include_once(SERVER_ROOT_PATH . 'class/request.cls.php');

/* Include session functions */
include_once(FUNCTION_ROOT_PATH . 'php_session_functions.php');

/* Include PHP common functions */
include_once(FUNCTION_ROOT_PATH . 'php_comman_functions.php');

/* Include common functions */
include_once(FUNCTION_ROOT_PATH . 'comman_functions.php');

if (isset($_REQUEST['paging']) && $_REQUEST['paging'] != '') {
    $limit = $_REQUEST['paging'];
    $_SESSION['page_no_admin'] = $_REQUEST['paging'];
} else {
    if (isset($_SESSION['page_no_admin']) and $_SESSION['page_no_admin'] != "") {
        $limit = $_SESSION['page_no_admin'];
    } else {
        $limit = 50;
    }
}
/* File name */
if (isset($_REQUEST['file']) and $_REQUEST['file'] != "") {
    $fileName = $_REQUEST['file'] . ".php";
    $find = true;
} else {
    $find = false;
}

$fName = $_REQUEST['file'];

/* Ajax view */
if (isset($_REQUEST['AjaxView']) and $_REQUEST['AjaxView'] != "") {
    $AjaxView = $_REQUEST['AjaxView'];
} else {
    $AjaxView = false;
}

//code to add the language file
if (isset($_REQUEST['lang'])) {
    $_SESSION['lang'] = $_REQUEST['lang'];
}

$lang_file = check_lang(LANGUAGE_ADMIN_ROOT_PATH);
require_once($lang_file);


// pasword protection key
$pass_key = 'rps';
?>
