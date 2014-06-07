<?php

/* * ******************************************
 * File - admin.cls.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the class file for performing admin account active based queries
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

        global $lang, $pass_key;

        $UserName = trim(Request::get('txtEmail', '', 'P'));
        $PassWord = trim(Request::get('txtPassword', '', 'P'));
        if (preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $UserName)) {
            $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($pass_key), $PassWord, MCRYPT_MODE_CBC, md5(md5($pass_key))));
            $select = "select user_id,firstname,lastname,email,password,subscription,created_on,status from tbl_users where email  = '" . mysql_escape_string($UserName) . "' AND password='" . $encrypted . "' AND status='1'";

            $userDetails = $this->dbclass->select($select);
            if (is_array($userDetails) and count($userDetails) > 0) {
                $_SESSION['SESS_USERID'] = $userDetails[0]['user_id'];
                $_SESSION['SESS_USERNAME'] = $userDetails[0]['email'];
                $_SESSION['SESS_EMAIL'] = $userDetails[0]['email'];
                $_SESSION['SESS_firstname'] = $userDetails[0]['firstname'];
                $_SESSION['SESS_lastname'] = $userDetails[0]['lastname'];
                $_SESSION['SESS_subscription'] = $userDetails[0]['subscription'];
                $_SESSION['SESS_created_on'] = $userDetails[0]['created_on'];
                $_SESSION['SESS_status'] = $userDetails[0]['status'];
                header('Location: index.php?file=edituser');
                return true;
            } else {
                $errors['LOGIN_ERROR'] = $lang['T_ADMIN_LOGIN_FAILED'];
                return $errors;
            }
        }
    }

}

?>
