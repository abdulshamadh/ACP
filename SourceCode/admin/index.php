<?php
/* * ******************************************
 * File - index.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the class file for performing index based files included
 * ****************************************** */
ob_start();
require_once 'global.php';

if (isset($_SESSION['SESS_ADMINID'])) {
    $adminLogged = $_SESSION['SESS_ADMINID'];
    $adminName = $_SESSION['SESS_ADMINNAME'];
}

if ($fileName == "") {
    $title = $lang['T_DOCUMENT_TITLE'];
} elseif ($fileName == "home.php") {
    $title = "Home ~ ACP Computer";
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

    <div class="middle <?php if ($adminLogged != '') { ?> container1 <?php } ?>">	

        <?php
        if ($find) {
            if (isset($_SESSION['SESS_ADMINID']) && $_SESSION['SESS_ADMINID'] != '') {
                if (file_exists(TEMPLATE_ADMIN_MIDDLE_PATH . $fileName))
                    include_once TEMPLATE_ADMIN_MIDDLE_PATH . $fileName;
                else
                    die("File not found " . $fileName);
            } else {
                include_once TEMPLATE_ADMIN_MIDDLE_PATH . 'login.php';
            }
        }

        if (isset($_SESSION['SESS_ADMINID']) && $_SESSION['SESS_ADMINID'] != '') {
            if ($fileName == "")
                include_once(TEMPLATE_ADMIN_MIDDLE_PATH . 'home.php');
        } else {
            include(TEMPLATE_ADMIN_MIDDLE_PATH . 'middle.php');
        }
        ?>

        <div class="clr"></div>
    </div>

    <?php
    include_once("modules/footer/footer.php");
} else {
    if (file_exists(TEMPLATE_ADMIN_MIDDLE_PATH . $fileName))
        include_once TEMPLATE_ADMIN_MIDDLE_PATH . $fileName;
    else
        die("File not found " . $fileName);
}
?>
