<?php

/* * ******************************************
 * File - db_class.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the class file for performing database based queries
 * ****************************************** */

//_________define class_________________________// 
class dbclass {

    var $CONN;

    function dbclass() { //constructor
        $conn = mysql_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD);
        if (!$conn) {
            $this->error("Connection Attempt Failed");
        }
        if (!mysql_select_db(DB_DATABASENAME, $conn)) {
            $this->error("Database Selection Failed");
        }
        $this->CONN = $conn;
        return true;
    }

    //_____________close connection____________//
    function close() {
        $conn = $this->CONN;
        $close = mysql_close($conn);
        if (!$close) {
            $this->error("Close Connection Failed");
        }
        return true;
    }

    //______________catch error__________________//
    function error($text) {
        $no = mysql_errno();
        $msg = mysql_error();
        echo "<hr><font face=verdana size=2>";
        echo "<b>Custom Message :</b> $text<br><br>";
        echo "<b>Error Number :</b> $no<br><br>";
        echo "<b>Error Message :</b> $msg<br><br>";
        echo "<hr></font>";
        exit;
    }

    //_____________select records___________________//
    function select($sql = "") {
        if (empty($sql)) {
            return false;
        }
        if (!@eregi("^select", $sql)) {
            echo "Wrong Query<hr>$sql<p>";
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = @mysql_query($sql, $conn);
        if ((!$results) or empty($results)) {
            return false;
        }
        $count = 0;
        $data = array();
        while ($row = mysql_fetch_assoc($results)) {
            $data[$count] = $row;
            $count++;
        }
        mysql_free_result($results);
        return $data;
    }

    //_____________select records___________________//
    function select_assoc($sql = "") {
        if (empty($sql)) {
            return false;
        }
        if (!@eregi("^select", $sql)) {
            echo "Wrong Query<hr>$sql<p>";
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = @mysql_query($sql, $conn);
        if ((!$results) or empty($results)) {
            return false;
        }
        $count = 0;
        $data = array();
        while ($row = mysql_fetch_assoc($results)) {
            $data[$count] = $row;
            $count++;
        }
        mysql_free_result($results);
        return $data;
    }

    //__________total rows affected______________________//
    function affected($sql = "") {
        if (empty($sql)) {
            return false;
        }
        if (!@eregi("^select", $sql)) {
            echo "Wrong Query<hr>$sql<p>";
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }

        $conn = $this->CONN;
        $results = @mysql_query($sql, $conn);
        if ((!$results) or (empty($results))) {
            return false;
        }
        $tot = 0;
        $tot = mysql_affected_rows();
        return $tot;
    }

    //________insert record__________________//
    function insert($sql = "") {
        if (empty($sql)) {
            return false;
        }
        if (!@eregi("^insert", $sql)) {
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = @mysql_query($sql, $conn);
        if (!$results) {
            $this->error("Insert Operation Failed..<hr>$sql<hr>");
            return false;
        }
        $id = mysql_insert_id();
        return $id;
    }

    //___________edit and modify record___________________//
    function edit($sql = "") {
        if (empty($sql)) {
            return false;
        }
        if (!@eregi("^update", $sql)) {
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = @mysql_query($sql, $conn);
        $rows = 0;
        $rows = @mysql_affected_rows();
        return $rows;
    }

    //____________generalize for all queries___________//
    function sql_query($sql = "") {

        if (empty($sql)) {
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = mysql_query($sql, $conn) or $this->error("Something Is Wrong With Query<hr>$sql<hr>");

        if (!$results) {
            $this->error("Query Went Bad ! <hr>$sql<hr>");
            return false;
        }
        if (!@eregi("^select", $sql)) {
            return true;
        } else {
            $count = 0;
            $data = array();
            while ($row = mysql_fetch_array($results)) {
                $data[$count] = $row;
                $count++;
            }
            mysql_free_result($results);
            return $data;
        }
    }

    function adder($sql = "") {
        if (empty($sql)) {
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }

        $conn = $this->CONN;
        $results = @mysql_query($sql, $conn);

        if (!$results)
            $id = "";
        else
            $id = mysql_insert_id();
        return $id;
    }

    /**
     * @return array
     * @param string $tablename the tablename
     * @desc check if a table with the given name exists in DB
     */
    function table_exists($tablename) {
        $conn = $this->CONN;

        if (empty($conn)) {
            return false;
        }

        $results = mysql_list_tables(DB_DATABASE) or die("Could Not Access Table List...<hr>" . mysql_error());

        if (!$results) {

            $message = "Query Went Bad!";
            //mysql_close($conn);
            die($message);
            return false;
        } else {

            $count = 0;
            $data = array();
            while ($row = mysql_fetch_array($results)) {
                if ($row[0] == $tablename) {
                    return true;
                    // mysql_close($conn);
                    exit;
                }
            }
            mysql_free_result($results);
            //mysql_close($conn);
            return false;
        }
    }

    function extraqueries($sql = "") {

        if (empty($sql)) {
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = mysql_query($sql, $conn) or $this->error("Something Is Wrong With Query<hr>$sql<hr>");

        if (!$results) {
            $this->error("Query Went Bad ! <hr>$sql<hr>");
            return false;
        } else {
            $count = 0;
            $data = array();
            while ($row = mysql_fetch_array($results)) {
                $data[$count] = $row;
                $count++;
            }
            mysql_free_result($results);
            return $data;
        }
    }

    function db_query($sql = "") {
        if (empty($sql)) {
            return false;
        }
        if (empty($this->CONN)) {
            return false;
        }
        $conn = $this->CONN;
        $results = mysql_query($sql, $conn) or $this->error("Something Is Wrong With Query<hr>$sql<hr>");
        if (!$results) {
            $this->error("Query Went Bad ! <hr>$sql<hr>");
            return false;
        }
        else
            return $results;
    }

    function db_fetch_row($result) {
        return mysql_fetch_row($result);
    }

    function db_fetch_assoc($result) {
        return mysql_fetch_assoc($result);
    }

    function db_free_result($result) {
        @mysql_free_result($result);
    }

    function db_num_rows($result) {
        return mysql_num_rows($result);
    }

    function db_num_fields($result) {
        return mysql_num_fields($result);
    }

    function db_field_name($result) {
        return mysql_field_name($result);
    }

    function db_list_fields($strDatabase, $strDatabaseTable) {
        return @mysql_list_fields($strDatabase, $strDatabaseTable);
    }

    function db_field_type($result) {
        return mysql_field_type($result);
    }

    function db_insert_from_array($arrFieldsValues, $strTable, $strUniqueField = "") {
        if ($strUniqueField) {
            if ($this->db_one_result("SELECT COUNT(*) FROM $strTable WHERE $strUniqueField='$arrFieldsValues[$strUniqueField]'")) {
                return 0;
            }//if
        }//if

        $strQuery = "INSERT INTO $strTable ( ";

        while (@list($strKey, $strValue) = @each($arrFieldsValues)) {
            $arrFieldNames[] = "$strKey";
            $arrFieldValues[] = "'$strValue'";
        }//while

        $strQuery .= implode(",", $arrFieldNames);

        $strQuery .= ") VALUES (" . implode(",", $arrFieldValues) . ")";

        //echo $strQuery;exit;
        if ($this->boolDebug) {
            echo "clsDataBase Class:Executing query $strQuery !! <br>";
        }//if debug mode set then display errors

        $game_id = $this->insert($strQuery);

        return $game_id;
    }

// end of the function db_insert_from_array()
    #####################################################################################################
    # Function Name: string db_combo_from_query($strName, $strValue, $strQuery, $strOption, $strOptValue, 
    # $strClassStyle = "input", $strEvent = "", $strExtraOpt = "", $strExtraVal =  
    # "",$intSize=0,$boolMultiple=0,$intShow = 0)   
    # Created By:     
    # Created on:    
    # Purpose: Member function fills a combo box from supplied sql query    
    # Parameters: string $strName : Name of the drop down box
    #			  string $strValue : The default selected value of the drop down
    #			  string $strQuery : Sql query
    #			  string $strOption : Options of the drop down
    #			  string $strOptValue : Option values of the drop down
    #			  string $strClassStyle : Class style for the drop down 
    #			  string $strEvent : Any Event related code/function call 
    #			  string $strExtraOpt : Extra option for the drop down		
    #			  string $strExtraVal : Value for the extra option of the drop down	
    #			  string $intSize : 
    #			  string $boolMultiple : 
    #			  integer $intShow : show flag tells whether to display drop down or return it as string	
    #			  string $strId : Id Name for Combo that can be used by Javascript
    #			  string $strExtraOptLocation : Postion for Extra option display
    # OUTPUT: Displays or returns string which is responsible for displaying drop down box on page      
    #####################################################################################################

    function db_combo_from_query($strName, $strValue, $strQuery, $strOption, $strOptValue, $strClassStyle = "input", $strEvent = "", $strExtraOpt = "", $strExtraVal = "", $intSize = 0, $boolMultiple = 0, $intShow = 0, $strId = '', $strExtraOptLocation = 'TOP') {
        $strDropDownCode = "<select name=\"$strName\"";
        if ($strId != "")
            $strDropDownCode .= "id=\"$strId\"";
        if ($strClassStyle) {
            $strDropDownCode .= " class=$strClassStyle";
        }//if

        $strDropDownCode .= " $strEvent ";
        if ($intSize) {
            $strDropDownCode .= " size='$intSize' ";
        }
        if ($boolMultiple) {
            $strDropDownCode .= " multiple=true ";
        }
        $strDropDownCode .= ">";

        //$objResultSet = $this->db_query($strQuery);
        $QuotesCategory = $this->select($strQuery);
        //echo "<pre>";print_r($QuotesCategory);
        if ($strExtraOptLocation == "TOP") {
            // Include extra rows in for combo, if any
            if ($strExtraOpt) {
                $strExtraVal = addslashes($strExtraVal);
                if ($strValue == $strExtraVal)
                    $strDropDownCode .= "<option value=\"$strExtraVal\" selected>$strExtraOpt</option>";
                else
                    $strDropDownCode .= "<option value=\"$strExtraVal\" >$strExtraOpt</option>";
            }//if
        }
        // Loop reads values from Database and fills it in combo
        //while ( $arrRow = $this->db_fetch_array() )
        //{
        for ($i = 0; $i < count($QuotesCategory); $i++) {
            $strOpt = $QuotesCategory[$i][$strOption];
            $strOptionValue = $QuotesCategory[$i][$strOptValue];

            $strDropDownCode .= "<option value=\"$strOptionValue\"";

            if ($strValue == $QuotesCategory[$i]['icat_quote_id'])
                $strDropDownCode .= " selected";

            $strDropDownCode .= ">$strOpt</option>";
        }//for

        if ($strExtraOptLocation == "BOTTOM") {
            // Include extra rows in for combo, if any
            if ($strExtraOpt) {
                $strExtraVal = addslashes($strExtraVal);
                if ($strValue == $strExtraVal)
                    $strDropDownCode .= "<option value=\"$strExtraVal\" selected>$strExtraOpt</option>";
                else
                    $strDropDownCode .= "<option value=\"$strExtraVal\" >$strExtraOpt</option>";
            }//if
        }

        $strDropDownCode .= "</select>";

        if ($intShow) {
            echo $strDropDownCode;
        }//if
        else {
            return $strDropDownCode;
        }//else
    }

// end of the function db_combo_from_query()
}

//________ends the class here__________//
?>
