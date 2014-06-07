<?php

/**
 * Class Validation used to validate all the forms in the site side
 * @package PHP Validation 
 * @author Abdul Shamadhu
 */
// Used Forms: Add account form
class Validation {
    /*
     * Function used to validate the number and it must not exceed 9 characters
     * name: validateRouting
     * @access public
     * param int
     * @return boolean
     */

    function validateRouting($input = '') {
        //if it's NOT valid
        if (strlen($input) != 9)
            return false;
        //if it's valid
        else
            return true;
    }

    /*
     * Function used to validate whether the input is empty or not
     * name: validateEmpty
     * @access public
     * param int
     * @return boolean
     */

    function validateEmpty($input = '') {
        //if it's NOT valid
        if (strlen($input) < 1)
            return false;
        //if it's valid
        else
            return true;
    }

    /*
     * Function used to validate the phone number
     * name: validatePhone
     * @access public
     * param int
     * @return boolean
     */

    function validatePhone($phone) {
        //if it's NOT valid
        if (strlen($phone) < 10)
            return false;
        //if it's valid
        else
            return true;
    }

    /*
     * Function used to validate the text address
     * name: validateAddress
     * @access public
     * param int
     * @return boolean
     */

    function validateAddress($address) {
        //if it's NOT valid
        if (strlen($address) < 1)
            return false;
        //if it's valid
        else
            return true;
    }

    /*
     * Function used to validate the email address
     * name: validateEmail
     * @access public
     * param int
     * @return boolean
     */

    function validateEmail($email) {
        return preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $email);
    }

    /*
     * Function used to validate the Name
     * name: validateName
     * @access public
     * param int
     * @return boolean
     */

    function validateName($name) {
        //if it's NOT valid
        if (strlen($name) < 4)
            return false;
        //if it's valid
        else
            return true;
    }

    /*
     * Function used to validate Region
     * name: validateRegion
     * @access public
     * param int
     * @return boolean
     */

    function validateRegion($region) {
        //if it's NOT valid
        if (strlen($region) == 'Select Region')
            return false;
        //if it's valid
        else
            return true;
    }

    /*
     * Function used to validate Country
     * name: validateCountry
     * @access public
     * param int
     * @return boolean
     */

    function validateCountry($country) {
        //if it's NOT valid
        if (strlen($country) == 'Select Country')
            return false;
        //if it's valid
        else
            return true;
    }

    /*
     * Function used to validate City
     * name: validateCity
     * @access public
     * param int
     * @return boolean
     */

    function validateCity($city) {
        //if it's NOT valid
        if (strlen($city) == 'Select Nearest Division')
            return false;
        //if it's valid
        else
            return true;
    }

    /*
     * Function used to validate Zip
     * name: validateZip
     * @access public
     * param int
     * @return boolean
     */

    function validateZip($zip) {
        //if it's NOT valid
        if (strlen($zip) < 1)
            return false;
        //if it's valid
        else
            return true;
    }

    /*
     * Function used to validate UserName
     * name: validateUserName
     * @access public
     * param int
     * @return boolean
     */

    function validateUserName($name) {
        //if it's NOT valid
        if (strlen($name) < 4)
            return false;
        //if it's valid
        else
            return true;
    }

    /*
     * Function used to validate two passwords
     * name: validatePasswords
     * @access public
     * param int
     * param int
     * @return boolean
     */

    function validatePasswords($pass1, $pass2) {
        //if DOESN'T MATCH
        if (strpos($pass1, ' ') !== false)
            return false;
        //if are valid
        return $pass1 == $pass2 && strlen($pass1) >= 5;
    }

    /*
     * Function used to validate subject
     * name: validateSubject
     * @access public
     * param int
     * param int
     * @return boolean
     */

    function validateSubject($subject) {
        //if it's NOT valid
        if (strlen($subject) < 4)
            return false;
        //if it's valid
        else
            return true;
    }

    /*
     * Function used to validate details
     * name: validateDetails
     * @access public
     * param int
     * param int
     * @return boolean
     */

    function validateDetails($details) {
        //if it's NOT valid
        if (strlen($details) < 1)
            return false;
        //if it's valid
        else
            return true;
    }

}

// END Validation Class

/* End of file Validation.cls.php */
/* Location: ./class/Validation.cls.php */
