<?php

####################################     
# File Name: php_session_functions.php
# Created By: Abdul Shamadhu
# Created On: November 24 ,2008
# This file contain some more common php session functions.
####################################
//This file is to manage sessions in the database. Sessions are stored in tblSessions
#############################################################################
# Function Name: fnOnSessionStart()
# Created By: PHP Team   
# Created on: 24 Nov 2008
# Purpose: This function takes save path , session name 
# Parameters: $savePath - save path,$sessionName - session name
# ON SUCCESS: Returns  - 
#############################################################################

function fnOnSessionStart($savePath, $sessionName) {
    error_log($sessionName . " " . session_id());
}

#############################################################################
# Function Name: fnOnSessionEnd()
# Created By: PHP Team   
# Created on: 24 Nov 2005
# Purpose: Nothing needs to be done in this function , since we used persistent connection.
# Parameters: No
# ON SUCCESS: Returns  - No
#############################################################################

function fnOnSessionEnd() {
    // Nothing needs to be done in this function 
    // since we used persistent connection. 
}

#############################################################################
# Function Name: fnOnSessionRead()
# Created By: PHP Team   
# Created on: 24 Nov 2005
# Purpose: get current session.
# Parameters: $key - Key
# ON SUCCESS: Returns  - 
#############################################################################
//get current session
function fnOnSessionRead($key) {
    global $conn;

    error_log($key);

    //get session data from database
    $query = "select SESSION_DATA from tblSessions "
            . "where SESSION_ID  ='$key' "
            . "and SESSION_EXPIRATION > UNIX_TIMESTAMP(now())";
    //echo $query . "<br>" ;	
    $result = $conn->db_query($query);
    $total = $conn->db_num_rows($result);
    if ($total) {
        $row = $conn->db_fetch_array($result);
        $session_data = $row["SESSION_DATA"];
        return($session_data);
    }//IF total 
    else
        return $result;
}

//on_session_reaf 
#############################################################################
# Function Name: fnOnSessionWrite()
# Created By: PHP Team   
# Created on: 24 Nov 2005
# Purpose: insert or update sessions .
# Parameters: $key - Key , $val - Value
# ON SUCCESS: Returns  - 
#############################################################################
//insert or update sessions 
function fnOnSessionWrite($key, $val) {
    global $conn;

    error_log("$key = $value");

    $val = addslashes($val);

    $query = "INSERT INTO tblSessions VALUES('$key','$val',UNIX_TIMESTAMP(date_add(now(), INTERVAL 1 HOUR)),now())";
    $result = $conn->db_query($query);
    $error = $conn->db_get_error_msg();
    //try to insert the session in db if that doesn't succeed, it means 
    // session is already in the table and we try to update 
    if ($error != "0") {
        error_log($error);
        $query1 = "update tblSessions SET SESSION_DATA ='$val', "
                . "session_expiration = unix_timestamp(date_add(now(), interval 1 hour))"
                . "where SESSION_ID ='$key '";
        $conn->db_query($query1);
    }
}

//function
#############################################################################
# Function Name: fnOnSessionDestroy()
# Created By: PHP Team   
# Created on: 24 Nov 2005
# Purpose: delete sessions .
# Parameters: $key - Key
# ON SUCCESS: Returns  - 
#############################################################################
//delete sessions 
function fnOnSessionDestroy($key) {
    global $conn;
    $query = "DELETE from tblSessions where SESSION_ID = '$key' ";
    $conn->db_query($query);
}

#############################################################################
# Function Name: fnOnSessionGc()
# Created By: PHP Team   
# Created on: 24 Nov 2005
# Purpose: delete all expired sessions .
# Parameters: $maxLifetime - Maximum Life Time
# ON SUCCESS: Returns  - 
#############################################################################
//delete all expired sessions
function fnOnSessionGc($maxLifetime) {
    global $conn;
    $query = "DELETE from tblSessions where SESSION_EXPIRATION < unix_timestamp(now())";
    $conn->db_query($query);
}

?>