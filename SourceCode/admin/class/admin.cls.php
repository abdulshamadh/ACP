<?php

/* * ******************************************
 * File - admin.cls.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the class file for performing admin based queries
 * ****************************************** */

class Admin {

    var $dbclass;
    var $post;
    var $get;
    var $request;
    var $files;

    function Admin(&$dbObj) {
        $this->dbclass = &$dbObj;
        $this->post = &$_POST;
        $this->get = &$_GET;
        $this->request = &$_REQUEST;
        $this->files = &$_FILES;
    }

    /** function to login in to the system * */
    function AdminLogin() {

        global $lang;

        $UserName = trim(Request::get('txtEmail', '', 'P'));
        $PassWord = trim(Request::get('txtPassword', '', 'P'));
        $select = "SELECT * FROM admin WHERE email_address  = '" . mysql_escape_string($UserName) . "' AND password='" . md5($PassWord) . "' AND active  = '1' AND contact_name = 'Administrator'";
        $adminDetails = $this->dbclass->select($select);

        if (is_array($adminDetails) and count($adminDetails) > 0) {

            $_SESSION['SESS_ADMINID'] = $adminDetails[0]['user_id'];
            $_SESSION['SESS_ADMINNAME'] = $adminDetails[0]['contact_name'];
            $_SESSION['SESS_EMAIL'] = $adminDetails[0]['email_address'];


            $select = "SELECT `key`,`value` FROM settings";
            $settingDetails = $this->dbclass->select($select);

            $generalSettings = array();
            for ($i = 0; $i < count($settingDetails); $i++) {
                $generalSettings[$settingDetails[$i]['key']] = $settingDetails[$i]['value'];
            }

            if ($generalSettings['ADMIN_MAIL'] == "" and $generalSettings['SMTP_USERNAME'] == "" and $generalSettings['SMTP_PASSWORD'] == "" and $generalSettings['SMTP_PORT'] == "" and $generalSettings['SMTP_HOST'] == "") {
                $url = "index.php?file=general_settings";
            } else {
                $url = "index.php?file=home";
            }
            fnRedirectUrl($url);
            return true;
        } else {
            $errors['LOGIN_ERROR'] = $lang['T_ADMIN_LOGIN_FAILED'];
            return $errors;
        }
    }

}

?>
