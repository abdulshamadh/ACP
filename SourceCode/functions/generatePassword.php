<?php
#############################################################################
# Function Name: generatePassword_backup()
# Created By: PHP Team   
# Created on: 21  Sep 2008
# Purpose: Function to check wether given value is blank or not.    
# Parameters: string $strValue : value
# ON SUCCESS: Returns TRUE if value is blank.     
# ON FAILURE: Returns FLASE  if value is not blank.     
#############################################################################
function generatePassword_backup($length = 8) {

    // start with a blank password
    $password = "";

    // define possible characters
    $possible = "0123456789";

    // set up a counter
    $i = 0;

    // add random characters to $password until $length is reached
    while ($i < $length) {

        // pick a random character from the possible ones
        $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);

        // we don't want this character if it's already in the password
        if (!strstr($password, $char)) {
            $password .= $char;
            $i++;
        }
    }

    // done!
    return $password;
}

function generatePassword($length = 8) {
    srand((double) microtime() * 1000000);

    $vowels = array("a", "e", "i", "o", "u");
    $cons = array("b", "c", "d", "g", "h", "j", "k", "l", "m", "n", "p", "r", "s", "t", "u", "v", "w", "tr",
        "cr", "br", "fr", "th", "dr", "ch", "ph", "wr", "st", "sp", "sw", "pr", "sl", "cl");

    $num_vowels = count($vowels);
    $num_cons = count($cons);
    $password = "";

    for ($i = 0; $i < $length; $i++) {
        $password .= $cons[rand(0, $num_cons - 1)] . $vowels[rand(0, $num_vowels - 1)];
    }

    return substr($password, 0, $length);
}

?>