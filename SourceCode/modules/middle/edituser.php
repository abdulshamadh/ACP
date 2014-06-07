<?php
/* * ******************************************
 * File - edit_user.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing user edit / update based files
 * ****************************************** */
include_once('no_entry.php');
include_once('class/edituser.cls.php');
include_once('class/validation.cls.php');
$loginDetails = $_SESSION;

$_GET['user_id'] = $loginDetails['SESS_USERID'];
$validation = new Validation();
?>
<script type="text/javascript" src = "<?php echo JS_PATH ?>jquery.js"></script>	
<script type="text/javascript" src = "<?php echo JS_PATH ?>edituser_validation.js"></script>
<link href="<?php echo CSS_PATH ?>general.css" rel="stylesheet" type="text/css" />
<div id="main" class="fullwidth">

    <!--Begin Content-->
    <article id="content">
        <div class="col-box main-box">

            <?php if ($_GET['f']) { ?>
                <span class='success_msg'>Your information has been updated.</span>
            <?php } ?>

            <div class="middle"> 
                <div id="dcontent">
                    <div class="clr">&nbsp;</div>
                    <div class="clr">&nbsp;</div>
                    <table cellspacing="20" cellpadding="20">
                        <tbody>
                            <tr>
                                <td style="vertical-align:top;">
                                    <div id="container">
                                        <?php
                                        if (isset($_GET['user_id'])) {
                                            $result = select_users($_GET['user_id']);
                                        }
                                        ?>
                                        <?php if (isset($_POST['edituser']) && (!$validation->validateName($_POST['firstname']) || !$validation->validateName($_POST['lastname']) || !$validation->validateName($_POST['firstname']) || !$validation->validatePasswords($_POST['pass1'], $_POST['pass2']) )): ?>
                                            <div id="error">
                                                <ul>							
                                                    <?php if (!$validation->validateName($_POST['firstname'])): ?>
                                                        <li>
                                                            <strong>Invalid First Name:</strong> Stop cowboy! Type a valid First Name please :P
                                                        </li>
                                                    <?php endif ?>

                                                    <?php if (!$validation->validateName($_POST['lastname'])): ?>
                                                        <li>
                                                            <strong>Invalid Last Name:</strong> Stop cowboy! Type a valid Last Name please :P
                                                        </li>
                                                    <?php endif ?>

                                                    <?php if (!$validation->validateEmail($_POST['email'])): ?>
                                                        <li>
                                                            <strong>Invalid Email:</strong> Stop cowboy! Type a valid Email please :P
                                                        </li>
                                                    <?php endif ?>

                                                    <?php if (!$validation->validatePasswords($_POST['pass1'], $_POST['pass2'])): ?>
                                                        <li>
                                                            <strong>Passwords are invalid:</strong> Passwords doesn't match or are invalid!
                                                        </li>
                                                    <?php endif ?>

                                                </ul>
                                            </div>
                                        <?php elseif (isset($_POST['edituser'])): ?>
                                            <div id="error" class="valid">
                                                <ul>

                                                    <?php $msg = user_updation($_GET['user_id'], $_POST['firstname'], $_POST['lastname'], $_POST['pass1'], $_POST['status']); ?>
                                                    <li>
                                                        <strong><?php echo $msg; ?></strong>			
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php endif ?>
                                        <form method="post" id="editUserForm" action="">
                                            <div>
                                                <label for="firstname">First Name</label>
                                                <input id="firstname" name="firstname" type="text" value="<?php echo $result[0]['firstname']; ?>"/>
                                                <span id="firstnameInfo">Valid Name please.</span>
                                            </div>

                                            <div>
                                                <label for="lastname">Last Name</label>
                                                <input id="lastname" name="lastname" type="text" value="<?php echo $result[0]['lastname']; ?>"/>
                                                <span id="lastnameInfo">Valid Name please.</span>
                                            </div>

                                            <div>
                                                <label for="email">E-mail</label>
                                                <input id="email" name="email" type="text" value="<?php echo $result[0]['email']; ?>" readonly="readonly"/>
                                                <span id="emailInfo">Valid E-mail please.</span>
                                            </div>					

                                            <div>
                                                <label for="pass1">Password</label>
                                                <?php
                                                $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($pass_key), base64_decode($result[0]['password']), MCRYPT_MODE_CBC, md5(md5($pass_key))), "\0");
                                                ?>
                                                <input id="pass1" name="pass1" type="password" value="<?php echo $decrypted; ?>"/>
                                                <span id="pass1Info">At least 5 characters: letters, numbers and '_'</span>
                                            </div>
                                            <div>
                                                <label for="pass2">Confirm Password</label>
                                                <input id="pass2" name="pass2" type="password" value="<?php echo $decrypted; ?>" />
                                                <span id="pass2Info">Confirm password</span>
                                            </div>

                                            <div>
                                                <label for="status">Status</label>
                                                <input id="status" name="status" type="radio" value="1" <?php
                                                if ($result[0]['status'] == 1) {
                                                    echo "Checked";
                                                }
                                                ?> />Active
                                                <input id="status" name="status" type="radio" value="0" <?php
                                                if ($result[0]['status'] == 0) {
                                                    echo "Checked";
                                                }
                                                ?> />InActive
                                            </div>

                                            <div>
                                                <input id="edituser" name="edituser" type="submit" value="Save" />
                                            </div>

                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

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

