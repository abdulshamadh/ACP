<?php
/* * ******************************************
 * File - index.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing index based files
 * ****************************************** */
ob_start();
require_once 'global.php';
include_once TEMPLATE_MIDDLE_PATH . 'access_denied.php';
global $dbObj;
if (isset($_SESSION['SESS_USERID'])) {
    $userLogged = $_SESSION['SESS_USERID'];
    $userid = $_SESSION['SESS_ID'];
    $userSubscription = $_SESSION['SESS_SUBSCRIPTION'];
    $userName = $_SESSION['SESS_USERNAME'];
    $userEmail = $_SESSION['SESS_EMAIL'];
}

if ($fileName == "") {
    $title = $lang['T_DOCUMENT_TITLE'];
} elseif ($fileName == "home.php") {
    $title = "Home ~ ACP Computer";
} elseif ($fileName == "manage_plan.php") {
    $title = "Plan Management ~ ACP Computer Management System";
} elseif ($fileName == "change_password.php") {
    $title = "Change Password ~ ACP Computer Management System";
} elseif ($fileName == "general_settings.php") {
    $title = "General Settings ~ ACP Computer Management System";
} elseif ($fileName == "login.php") {
    $title = "Login ~ ACP Computer Login System";
} else {
    $title = $lang['T_DOCUMENT_TITLE'];
}

if (!$AjaxView) {
    include_once("modules/header/header.php");
    ?>
    <div class="clr"></div>
    <div class="middle">	

        <?php
        if ($find) {
            if (isset($_SESSION['SESS_USERID']) && $_SESSION['SESS_USERID'] != '' || $_GET['file'] == 'registration' || $_GET['file'] == 'unsubscribe' || $_GET['file'] == 'thankyou' || $_GET['file'] == 'forgotpassword' || $_GET['file'] == 'remainder_mail' || $_GET['file'] == 'active' || $_GET['file'] == 'forgotsuccess' || $_GET['file'] == 'forgotfailure') {
                if (file_exists(TEMPLATE_MIDDLE_PATH . $fileName))
                    include_once TEMPLATE_MIDDLE_PATH . $fileName;
                else
                    die("File not found " . $fileName);
            } else {
                include_once TEMPLATE_MIDDLE_PATH . 'login.php';
            }
        }

        if (isset($_SESSION['SESS_USERID']) && $_SESSION['SESS_USERID'] != '' || $_GET['file'] == 'registration' || $_GET['file'] == 'unsubscribe' || $_GET['file'] == 'thankyou' || $_GET['file'] == 'forgotpassword' || $_GET['file'] == 'remainder_mail' || $_GET['file'] == 'active' || $_GET['file'] == 'forgotsuccess' || $_GET['file'] == 'forgotfailure') {
            if ($fileName == "") {
                include_once(TEMPLATE_MIDDLE_PATH . 'home.php');
            }
        } else {
            if ($_GET['file'] == 'login')
                include_once TEMPLATE_MIDDLE_PATH . 'middle.php';
            else
                include(TEMPLATE_MIDDLE_PATH . 'home.php');
        }
        ?>

        <div class="clr"></div>
    </div>

    <?php
    include_once("modules/footer/footer.php");
}
else {
    if (file_exists(TEMPLATE_MIDDLE_PATH . $fileName))
        include_once TEMPLATE_MIDDLE_PATH . $fileName;
    else
        die("File not found " . $fileName);
}
?>
