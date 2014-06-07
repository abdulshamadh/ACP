<?php

/* * ******************************************
 * File - config.cls.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the class file for performing general actions of web site from front end panel
 * ****************************************** */

// GENERAL SETTINGS
error_reporting(E_ALL ^ E_NOTICE); // display all errors except notices
//error_reporting(0);
@ini_set('display_errors', '1'); // display all errors
@ini_set('register_globals', 'Off'); // make globals off runtime
@set_magic_quotes_runtime(FALSE);

// OLDER VERSION MAPPING
if (empty($_SERVER)) {
    $_GET = &$HTTP_GET_VARS;
    $_POST = &$HTTP_POST_VARS;
    $_SERVER = &$HTTP_SERVER_VARS;
}

// SITE CONFIGURATION
$path_http = pathinfo('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
$cfg['server']['path'] = $path_http["dirname"];         // server path is defined here
$arrDirPath = explode("/", $path_http["dirname"]);


if ($arrDirPath[count($arrDirPath) - 1] == "admin" or $arrDirPath[count($arrDirPath) - 1] == "cron" or $arrDirPath[count($arrDirPath) - 1] == "install") {
    // server root path is deined here
    $cfg['server']['root'] = substr(getcwd(), 0, (strlen(getcwd()) - strlen($arrDirPath[count($arrDirPath) - 1])));
    //$cfg['server']['root1'] = getcwd()."/";       // server root path is deined here
} else {
    $cfg['server']['root'] = getcwd() . "/";       // server root path is deined here
    $path_https = pathinfo('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
}

$path_https = pathinfo('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
define('SERVER_PATH', $cfg['server']['path'] . "/");
define('SERVER_ROOT_PATH', $cfg['server']['root']);

// TEMPLATE PATH 
define('TEMPLATE_ROOT_PATH', SERVER_ROOT_PATH . 'modules/');
define('TEMPLATE_PATH', SERVER_ROOT_PATH . 'modules/');
define('TEMPLATE_TOP_PATH', TEMPLATE_PATH . 'top/');
define('TEMPLATE_LEFT_PATH', TEMPLATE_PATH . 'left/');
define('TEMPLATE_RIGHT_PATH', TEMPLATE_PATH . 'right/');
define('TEMPLATE_MIDDLE_PATH', TEMPLATE_PATH . 'middle/');
define('TEMPLATE_BOTTOM_PATH', TEMPLATE_PATH . 'bottom/');

define('TEMPLATE_ADMIN_PATH', SERVER_ROOT_PATH . 'admin/modules/');
define('TEMPLATE_ADMIN_ROOT_PATH', SERVER_ROOT_PATH . 'admin/modules/');
define('TEMPLATE_ADMIN_TOP_PATH', TEMPLATE_ADMIN_PATH . 'top/');
define('TEMPLATE_ADMIN_LEFT_PATH', TEMPLATE_ADMIN_PATH . 'left/');
define('TEMPLATE_ADMIN_RIGHT_PATH', TEMPLATE_ADMIN_PATH . 'right/');
define('TEMPLATE_ADMIN_MIDDLE_PATH', TEMPLATE_ADMIN_PATH . 'middle/');
define('TEMPLATE_ADMIN_BOTTOM_PATH', TEMPLATE_ADMIN_PATH . 'bottom/');

define('SITE_PATH', realpath('../'));
define('ADMIN_SITE_PATH', realpath('.') . "/");

// CSS PATH 
define('CSS_PATH', SERVER_PATH . 'css/');
define('CSS_ADMIN_PATH', SERVER_PATH . 'css/');

// JS PATH 
define('JS_PATH', SERVER_PATH . 'js/');

// CLASS PATH 
define('CLASS_PATH', SERVER_PATH . 'class/');
define('CLASS_ROOT_PATH', SERVER_ROOT_PATH . 'class/');

// VENDOR PATH 
define('VENDOR_PATH', SERVER_PATH . 'vendors/');
define('VENDOR_ROOT_PATH', SERVER_ROOT_PATH . 'vendors/');

// LANGUAGE FILE PATH 
define('LANGUAGE_PATH', SERVER_PATH . 'lang/');
define('LANGUAGE_ROOT_PATH', SERVER_ROOT_PATH . 'lang/');
define('LANGUAGE_ADMIN_ROOT_PATH', SERVER_ROOT_PATH . 'admin/lang/');

// SCRIPT PATH 
define('SCRIPT_PATH', SERVER_PATH . 'scripts/');
define('SCRIPT_ROOT_PATH', SERVER_ROOT_PATH . 'scripts/');

// FUNCTIONS PATH 
define('FUNCTION_PATH', SERVER_PATH . 'functions/');
define('FUNCTION_ROOT_PATH', SERVER_ROOT_PATH . 'functions/');

// SMARTY PATH 
define('SMARTY_PATH', VENDOR_PATH . 'Smarty/');
define('SMARTY_ROOT_PATH', VENDOR_ROOT_PATH . 'Smarty/');

//read file
$path_parts = pathinfo($_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF']);
if ($path_parts['filename'] != "install") {

    if (file_exists(CLASS_ROOT_PATH . 'config.ini')) {

        $fp = fopen(CLASS_ROOT_PATH . 'config.ini', 'r');
        $data = fread($fp, filesize(CLASS_ROOT_PATH . 'config.ini'));
        fclose($fp);
        $server = explode("\n", $data);
        for ($i = 0; $i < count($server); $i++) {

            $details = explode("=", $server[$i]);
            if (count($details) > 1) {
                if (trim($details[0]) == "HOST") {
                    $db_host = trim($details[1]);
                }
                if (trim($details[0]) == "USERNAME") {
                    $db_user = trim($details[1]);
                }
                if (trim($details[0]) == "PASSWORD") {
                    $db_pwd = trim($details[1]);
                }
                if (trim($details[0]) == "DATABASE") {
                    $db_name = trim($details[1]);
                }
            }
        }
    } else {
        header("location:" . SERVER_PATH . "install.php");
        exit;
    }
}
define(DB_HOSTNAME, $db_host);
define(DB_USERNAME, $db_user);
define(DB_PASSWORD, $db_pwd);
define(DB_DATABASENAME, $db_name);

// IMAGE PATH
define(IMAGE_PATH, SERVER_PATH . 'images/');
define(IMAGE_ROOT_PATH, SERVER_ROOT_PATH . 'images/');

// FOR PAGING
define('REC_LIMIT', 10);

// For Number of Records per Page
define('REC_RECLIMIT', 20);

// For Number of Records per Page
define('ADMIN_REC_RECLIMIT', 20);

//gettting page limit
define('ADMIN_REC_LIMIT', 10);
define('ADMIN_PAGE_LIMIT', 5);

// PAGE SETTING - FRONT-END
define(NOIMG, '12');
define(NOPHOTO, '10');
?>
