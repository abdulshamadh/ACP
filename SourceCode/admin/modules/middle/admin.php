<?php
/* * ******************************************
 * File - admin.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing admin based files
 * ****************************************** */
include_once('no_entry.php');
include_once('class/change_password.cls.php');
$loginDetails = $_SESSION;
?>
<script type="text/javascript" src = "<?php echo JS_PATH ?>jquery.js"></script>	
<script type="text/javascript" src = "<?php echo JS_PATH ?>validation.js"></script>	
<link href="<?php echo CSS_PATH ?>general.css" rel="stylesheet" type="text/css" />
<div id="main" class="fullwidth">

    <!--Begin Content-->
    <article id="content">
        <div class="col-box main-box">
            <div class="middle"> 
                <div id="dcontent">
                    <div class="clr">&nbsp;</div>
                    <div class="clr">&nbsp;</div>
                    <div style="float:left;padding:20px;width:450px;">
                        <table cellspacing="20" cellpadding="20">
                            <tbody>
                                <tr>
                                    <td style="vertical-align:top;">
                                        <div id="container">
                                            <?php if (isset($_POST['change_pass']) && (!validatePasswords($_POST['pass1'], $_POST['pass2']) )): ?>
                                                <div id="error">
                                                    <ul>


                                                        <?php if (!validatePasswords($_POST['pass1'], $_POST['pass2'])): ?>
                                                            <li>
                                                                <strong>Passwords are invalid:</strong> Passwords doesn't match or are invalid!
                                                            </li>
                                                        <?php endif ?>

                                                    </ul>
                                                </div>
                                            <?php elseif (isset($_POST['change_pass'])): ?>
                                                <div id="error" class="valid">
                                                    <ul>
                                                        <li>
                                                            <strong><?php echo change_password($_POST['pass'], $_POST['pass1'], $_SESSION['SESS_ADMINID']); ?></strong>
                                                        </li>
                                                    </ul>
                                                </div>
                                            <?php endif ?>
                                            <form method="post" id="customForm" action="">
                                                <div>
                                                    <label for="email">E-mail</label>
                                                    <input id="email" name="email" type="text" value="<?php echo $_SESSION['SESS_EMAIL']; ?>" readonly="true"/>
                                                    <span id="emailInfo">Valid E-mail please.</span>
                                                </div>
                                                <div>
                                                    <label for="pass">Old Password</label>
                                                    <input id="pass" name="pass" type="password" />
                                                    <span id="passInfo">At least 5 characters: letters, numbers and '_'</span>
                                                </div>
                                                <div>
                                                    <label for="pass1">New Password</label>
                                                    <input id="pass1" name="pass1" type="password" />
                                                    <span id="pass1Info">At least 5 characters: letters, numbers and '_'</span>
                                                </div>
                                                <div>
                                                    <label for="pass2">Confirm Password</label>
                                                    <input id="pass2" name="pass2" type="password" />
                                                    <span id="pass2Info">Confirm password</span>
                                                </div>
                                                <div>
                                                    <input id="change_pass" name="change_pass" type="submit" value="Change Password" />
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="clr">&nbsp;</div>
                </div>
            </div>
            <div class="clear"></div>
            <div style="margin-top: 30px;"></div>

        </div>

    </article>
    <!--End Content-->

</div>
<!-- #main -->
