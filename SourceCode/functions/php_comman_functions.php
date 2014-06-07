<?php

####################################     
# File Name: php_comman_functions.php
# Created By: Abdul Shamadhu
# Created On: November 18 ,2008
# Updated By: Abdul Shamadhu
# This file contain some more common php functions.
####################################
#############################################################################
# Function Name: fnTimeDifference()
# Created By: PHP Team   
# Created on: 09 Nov 2005
# Purpose: This function takes two dates, and returns a string representing the amount of
#			    time between them.  The format of the return value is:
#			    33 days, 14 hrs, 33 min, 14 sec    
# Parameters: $datFirst - the first date,$datSecond - the secon date
# ON SUCCESS: Returns $strReturnValue - The time difference between the two dates, in the format     
#############################################################################

function fnTimeDifference($datFirst, $datSecond) {
    $date1 = $datFirst;
    $date2 = $datSecond;

    $dt2 = unixTm($date2);
    $dt1 = unixTm($date1);
    $r = $dt2 - $dt1;

    $dd = floor($r / 86400);

    if ($dd <= 9)
        $dd = "0" . $dd;

    $r = $r % 86400;
    $hh = floor($r / 3600);

    if ($hh <= 9)
        $hh = "0" . $hh;

    $r = $r % 3600;
    $mm = floor($r / 60);

    if ($mm <= 9)
        $mm = "0" . $mm;

    $r = $r % 60;
    $ss = $r;

    if ($ss <= 9)
        $ss = "0" . $ss;

    $retval = "$dd days $hh hours $mm mins $ss sec";

    return $retval;
}

function unixTm($strDT) {
    $arrDT = explode(" ", $strDT);
    $arrD = explode("-", $arrDT[0]);
    $arrT = explode(":", $arrDT[1]);
    return mktime($arrT[0], $arrT[1], $arrT[2], $arrD[1], $arrD[2], $arrD[0]);
}

############################################################################
# Function Name: fnDateDifference()
# Created By: PHP Team   
# Created on: 16 Nov 2005
# Purpose: This function takes two dates, and returns a string representing the amount of
#			    date between them.  The format of the return value is:
#			    3 years, 10 months, 3 days    
# Parameters: $datFirst - the first date,$datSecond - the secon date
# ON SUCCESS: Returns $strReturnValue - The date difference between the two dates, in the format     
#############################################################################

function fnDateDifference($datFirst, $datSecond) {
    // configure the base date here
    list($base_yr, $base_mon, $base_day) = explode("-", $datFirst);
    list($current_yr, $current_mon, $current_day) = explode("-", $datSecond);

    // overflow is always caused by max days of $base_mon
    // so we need to know how many days $base_mon had
    $base_mon_max = date("t", mktime(0, 0, 0, $base_mon, $base_day, $base_yr));

    // days left till the end of that month
    $base_day_diff = $base_mon_max - $base_day;

    // month left till end of that year
    // substract one to handle overflow correctly
    $base_mon_diff = 12 - $base_mon - 1;

    // start on jan 1st of the next year
    $start_day = 1;
    $start_mon = 1;
    $start_yr = $base_yr + 1;

    // difference to that 1st of jan
    $day_diff = ($current_day - $start_day) + 1;  // add today
    $mon_diff = ($current_mon - $start_mon) + 1; // add current month
    $yr_diff = ($current_yr - $start_yr);

    // and add the rest of $base_yr
    $day_diff = $day_diff + $base_day_diff;
    $mon_diff = $mon_diff + $base_mon_diff;

    // handle overflow of days
    if ($day_diff >= $base_mon_max) {
        $day_diff = $day_diff - $base_mon_max;
        $mon_diff = $mon_diff + 1;
    }

    // handle overflow of years
    if ($mon_diff >= 12) {
        $mon_diff = $mon_diff - 12;
        $yr_diff = $yr_diff + 1;
    }

    $retval = $yr_diff . " years, " . $mon_diff . " months and " . $day_diff . " days";

    return $retval;
}

###########################################################################
# Function Name: fnDateValidate()
# Created By: PHP Team   
# Created on: 16 Nov 2005
# Purpose: This function takes dates, and returns a string representing whether date is valid or not   
# Parameters: $dat - the date
# ON SUCCESS: Returns true if date is valid otherwise returns false.     
#############################################################################

function fnDateValidate($dat) {
    list($y, $m, $d) = explode("-", $dat);
    $months = array(1 => "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");

    if ((($y % 4) == 0) && ($m == 2) && ($d > 29))
        $message = "False";

    else if ((($y % 4) > 0) && ($m == 2) && ($d > 28))
        $message = "False";

    else if ((($m == 4) || ($m == 6) || ($m == 9) || ($m == 11) ) && ($d == 31))
        $message = "False";

    else if ($m > 12)
        $message = "False";

    else if ($d > 31)
        $message = "False";
    else
        $message = "True";

    return $message;
}

#############################################################################
# Function Name: fnCheckAge()
# Created By: PHP Team   
# Created on: 09 Nov 2005
# Purpose: This function takes a date & calculate the age based on that and returns true if age is equal or above 18 & false for under 18 ages.
# Parameters: $day - day,$month - month,$year - year
# ON SUCCESS: Returns 1 - if age is equal or above 18 
# ON FAILURE: Returns 0 - if age is below 18     
#############################################################################

function fnCheckAge($day, $month, $year) {
    $NOW_year = date("Y");
    $NOW_month = date("m");
    $NOW_day = date("d");

    if (($NOW_year - $year) > 18) {
        return 1;
    } else if ((($NOW_year - $year) == 18) && ($NOW_month > $month)) {
        return 1;
    } else if ((($NOW_year - $year) == 18) && ($NOW_month == $month) && ($NOW_day >= $day)) {
        return 1;
    } else {
        return 0;
    }
}

#############################################################################
# Function Name: fnCheckAge()
# Created By: PHP Team   
# Created on: 09 Nov 2005
# Purpose: This function takes a date & calculate the age based on that and returns true if age is equal or above 18 & false for under 18 ages.
# Parameters: $day - day,$month - month,$year - year
# ON SUCCESS: Returns 1 - if age is equal or above 18 
# ON FAILURE: Returns 0 - if age is below 18     
#############################################################################

function fnMysqlDump($database) {
    // Set content-type and charset
    //header ('Content-Type: text/html; charset=iso-8859-1');
    // Connect to database
    $db = @mysql_select_db($database);

    if (!empty($db)) {

        // Get all table names from database
        $c = 0;
        $result = mysql_list_tables($database);
        for ($x = 0; $x < mysql_num_rows($result); $x++) {
            $table = mysql_tablename($result, $x);
            if (!empty($table)) {
                $arr_tables[$c] = mysql_tablename($result, $x);
                $c++;
            } //if
        }//for
        // List tables
        $dump = '';
        for ($y = 0; $y < count($arr_tables); $y++) {

            // DB Table name
            $table = $arr_tables[$y];

            // Structure Header
            $structure .= "-- \n";
            $structure .= "-- Table structure for table `{$table}` \n";
            $structure .= "-- \n\n";

            // Dump Structure
            $structure .= "DROP TABLE IF EXISTS `{$table}`; \n";
            $structure .= "CREATE TABLE `{$table}` (\n";
            $result = mysql_db_query($database, "SHOW FIELDS FROM `{$table}`");
            while ($row = mysql_fetch_object($result)) {

                $structure .= "  `{$row->Field}` {$row->Type}";
                $structure .= (!empty($row->Default)) ? " DEFAULT '{$row->Default}'" : false;
                $structure .= ($row->Null != "YES") ? " NOT NULL" : false;
                $structure .= (!empty($row->Extra)) ? " {$row->Extra}" : false;
                $structure .= ",\n";
            }//while

            $structure = ereg_replace(",\n$", "", $structure);

            // Save all Column Indexes in array
            unset($index);
            $result = mysql_db_query($database, "SHOW KEYS FROM `{$table}`");
            while ($row = mysql_fetch_object($result)) {

                if (($row->Key_name == 'PRIMARY') AND ($row->Index_type == 'BTREE')) {
                    $index['PRIMARY'][$row->Key_name] = $row->Column_name;
                }//if

                if (($row->Key_name != 'PRIMARY') AND ($row->Non_unique == '0') AND ($row->Index_type == 'BTREE')) {
                    $index['UNIQUE'][$row->Key_name] = $row->Column_name;
                }//if

                if (($row->Key_name != 'PRIMARY') AND ($row->Non_unique == '1') AND ($row->Index_type == 'BTREE')) {
                    $index['INDEX'][$row->Key_name] = $row->Column_name;
                }//if

                if (($row->Key_name != 'PRIMARY') AND ($row->Non_unique == '1') AND ($row->Index_type == 'FULLTEXT')) {
                    $index['FULLTEXT'][$row->Key_name] = $row->Column_name;
                }//if
            }//while
            // Return all Column Indexes of array
            if (is_array($index)) {
                foreach ($index as $xy => $columns) {

                    $structure .= ",\n";

                    $c = 0;
                    foreach ($columns as $column_key => $column_name) {

                        $c++;

                        $structure .= ($xy == "PRIMARY") ? "  PRIMARY KEY  (`{$column_name}`)" : false;
                        $structure .= ($xy == "UNIQUE") ? "  UNIQUE KEY `{$column_key}` (`{$column_name}`)" : false;
                        $structure .= ($xy == "INDEX") ? "  KEY `{$column_key}` (`{$column_name}`)" : false;
                        $structure .= ($xy == "FULLTEXT") ? "  FULLTEXT `{$column_key}` (`{$column_name}`)" : false;

                        $structure .= ($c < (count($index[$xy]))) ? ",\n" : false;
                    }//for
                }//for
            }//if

            $structure .= "\n);\n\n";

            // Header
            $structure .= "-- \n";
            $structure .= "-- Dumping data for table `$table` \n";
            $structure .= "-- \n\n";

            // Dump data
            unset($data);
            $result = mysql_query("SELECT * FROM `$table`");
            $num_rows = mysql_num_rows($result);
            $num_fields = mysql_num_fields($result);

            for ($i = 0; $i < $num_rows; $i++) {

                $row = mysql_fetch_object($result);
                $data .= "INSERT INTO `$table` (";

                // Field names
                for ($x = 0; $x < $num_fields; $x++) {

                    $field_name = mysql_field_name($result, $x);

                    $data .= "`{$field_name}`";
                    $data .= ($x < ($num_fields - 1)) ? ", " : false;
                }//for

                $data .= ") VALUES (";

                // Values
                for ($x = 0; $x < $num_fields; $x++) {
                    $field_name = mysql_field_name($result, $x);

                    $data .= "'" . str_replace('\"', '"', mysql_escape_string($row->$field_name)) . "'";
                    $data .= ($x < ($num_fields - 1)) ? ", " : false;
                }//for

                $data.= ");\n";
            }//for

            $data.= "\n";

            $dump .= $structure . $data;
            $dump .= "-- --------------------------------------------------------\n\n";
        }

        return $dump;
    }//if
}

//function
#############################################################################
# Function Name: check_lang()
# Created By: PHP Team   
# Created on: 06 May 2009
# Purpose: This function is for check and apply the language
#############################################################################

function check_lang($LANGUAGE_ROOT_PATH) {
    //make sure that we have a language selected by using session .. 
    if (!isset($_SESSION['lang'])) {
        $lang = 'en';
    } else {
        $lang = $_SESSION['lang'];
    }
    //no we return the langauge wanted ! 
    //Returned String Format: dirname/filename.ext 
    return $LANGUAGE_ROOT_PATH . "$dir/$lang.lng";
}

?>