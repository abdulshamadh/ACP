<?php

/* * ******************************************
 * File - common.cls.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the class file for performing general actions of web site from front end panel
 * ****************************************** */

class clsCommon {

    var $dbclass;
    var $post;
    var $get;
    var $request;
    var $files;

    //constructor to intialize the properties of common class
    function clsCommon(&$dbObj) {
        $this->dbclass = &$dbObj;
        $this->post = &$_POST;
        $this->get = &$_GET;
        $this->request = &$_REQUEST;
        $this->files = &$_FILES;
    }

    /**
     * Function Name: encodedata($content)
     * Purpose: To prevent SQL injection 
     */
    function encodeData($content) {
        return htmlentities(addslashes(trim($content)));
    }

    /**
     * Function Name: decodedata($content)
     * Purpose: Change in content before display.
     */
    function decodeData($content) {
        return htmlspecialchars(html_entity_decode(stripslashes($content)), ENT_QUOTES);
    }

    /**
     * Function Name: decodeData2($content)
     * Purpose: Change in content before display.
     */
    function decodeData2($content) {
        return html_entity_decode(stripslashes($content));
    }

    /**
     * Function Name: checkInstallationProcess()
     * Purpose: check installation process for the  
     */
    function checkInstallationProcess() {
        
    }

}

?>