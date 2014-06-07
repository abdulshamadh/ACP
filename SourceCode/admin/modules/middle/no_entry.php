<?php
/* * ******************************************
 * File - no_entry.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This contains the no entry form for user called from the no entry tab at front site
 * ****************************************** */
/** perform action * */
if (!isset($_SESSION['SESS_ADMINID']) or empty($_SESSION['SESS_ADMINID']) or $_SESSION['SESS_ADMINID'] == NULL) {
    fnRedirectUrl('index.php');
    die();
}
?>