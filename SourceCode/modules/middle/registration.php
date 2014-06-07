<?php
/* * ******************************************
 * File - registration.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing user register based files
 * ****************************************** */
include_once('session_access.php');
include_once('class/registration.cls.php');
include_once('class/validation.cls.php');
$loginDetails = $_SESSION;
$validation = new Validation();
$request_captcha = htmlspecialchars($_REQUEST['captcha']);
?>
<link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo CSS_PATH ?>jqtransform.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src = "<?php echo JS_PATH ?>jquery.js"></script>	
<script type="text/javascript" src = "<?php echo JS_PATH ?>registration_validation.js"></script>
<script type="text/javascript" src = "<?php echo JS_PATH ?>jquery.jqtransform.js"></script>
<script language="javascript">
    $(function() {
        $('form').jqTransform({imgPath: 'jqtransformplugin/img/'});
    });
</script>
<style>
    .main-box {
        padding: 40px 30px;
        height:610px;
    }
</style>	
<div id="main" class="fullwidth">

    <!--Begin Content-->
    <article id="content">
        <div class="post-content col-box main-box">
            <div id="formcontainer">
                <?php if (isset($_POST['registration']) && (!$validation->validateEmpty($_POST['firstname']) || !$validation->validateEmpty($_POST['lastname']) || !$validation->validateEmail($_POST['email']) || !$validation->validateEmpty($_POST['pass1']) || !$validation->validateEmpty($_POST['pass2']) )): ?>
                    <div id="error">
                        <ul>			
                            <?php if (!$validation->validateEmpty($_POST['firstname'])): ?>
                                <li>
                                    <strong>Invalid First Name:</strong> First Name cannot be left blank
                                </li>
                            <?php endif ?>	

                            <?php if (!$validation->validateEmpty($_POST['lastname'])): ?>
                                <li>
                                    <strong>Invalid Last Name:</strong> Last Name cannot be left blank
                                </li>
                            <?php endif ?>				

                            <?php if (!$validation->validateEmail($_POST['email'])): ?>
                                <li>
                                    <strong>Invalid E-mail:</strong> Type a valid e-mail please
                                </li>
                            <?php endif ?>

                            <?php if (!$validation->validatePasswords($_POST['pass1'], $_POST['pass2'])): ?>
                                <li>
                                    <strong>Passwords are invalid:</strong> Passwords doesn't match or are invalid!
                                </li>
                            <?php endif ?>					

                        </ul>
                    </div>
                <?php elseif (isset($_POST['registration']) && $request_captcha != $_SESSION['captcha']): ?>
                    <div id="error">
                        <ul>
                            <?php unset($_SESSION['captcha']); ?>
                            <li>
                                <strong>Invalid Captcha:</strong> Type a valid captcha please 
                            </li>
                        </ul>
                    </div>
                <?php elseif (isset($_POST['registration'])): ?>
                    <div id="error" class="valid">
                        <ul>
                            <?php
                            if ($_POST['agree'] == 'on')
                                $_POST['agree'] = 1;
                            else
                                $_POST['agree'] = 0;
                            $msg = store_registration_application($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['pass1'], $_POST['agree']);
                            ?>
                            <li>
                                <strong><?php echo $msg; ?></strong>
                            </li>			
                        </ul>
                    <?php endif ?>	
                </div>

                <form method="post" id="registrationForm" action="" class="registrationForm">	
                    <div class="form_content">		
                        <div class="form_inputs">
                            <label>&nbsp;</label>
                            <h1>Registration for Users</h1>
                        </div>	

                        <div class="form_inputs">
                            <label for="firstname">First Name:</label>
                            <input id="firstname" name="firstname" type="text" value="<?php echo $_POST['firstname']; ?>"/>
                            <span id="firstnameInfo"></span>
                        </div>
                        <div class="form_inputs">
                            <label for="lastname">Last Name:</label>
                            <input id="lastname" name="lastname" type="text" value="<?php echo $_POST['lastname']; ?>"/>
                            <span id="lastnameInfo"></span>
                        </div>		
                        <div class="form_inputs">
                            <label for="email">Email:</label>
                            <input id="email" name="email" type="text" value="<?php echo $_POST['email']; ?>"/>
                            <span id="emailInfo"></span>
                        </div>	

                        <div class="form_inputs">
                            <label for="pass1">Password:</label>
                            <input id="pass1" name="pass1" type="password" value="<?php echo $_POST['pass1']; ?>"/>
                            <span id="pass1Info"></span>
                        </div>	

                        <div class="form_inputs">
                            <label for="pass2">Confirm Password:</label>
                            <input id="pass2" name="pass2" type="password" value="<?php echo $_POST['pass2']; ?>"/>
                            <span id="pass2Info"></span>
                        </div>			

                        <div class="form_inputs">
                            <label for="agree"></label>
                            <input type="checkbox" <?php
                            if ($_POST['agree'] == 1) {
                                echo'checked=checked';
                            }
                            ?> name="agree" id="agree" />
                            <span id="agreeInfo">I have subscribe for email notification&nbsp;</span>
                            <span id="subscribeInfo"></span>
                        </div>			
                        <div class="form_inputs">
                            <label for="captcha" style="cursor:pointer;">Write the following word.</label>
                            <div class="captcha_wrap">								
                                <input type="text" name="captcha" id="captcha-form" autocomplete="off" />
                                <span id="captchaInfo"></span><br/>								
                                <img src="<?php SERVER_PATH; ?>includes/captcha.php" id="captcha" /><br/>
                                <a href="javascript:void(1);" onclick="
        document.getElementById('captcha').src = '<?php SERVER_PATH; ?>includes/captcha.php?' + Math.random();
        document.getElementById('captcha-form').focus();"
                                   id="change-image">Not readable? Change text.</a>								
                            </div>				
                        </div>			

                        <div class="form_inputs">
                            <input id="registration" name="registration" type="submit" value=""/>
                            <p class="helptext">Need help? Email us at <a href="mailto:support@acpcomputer.edu.sg">support@acpcomputer.edu.sg </a></p>
                        </div>

                    </div>	
                </form>

                <div class="clear"></div>
                <div style="margin-top: 30px;"></div>

            </div>

    </article>
    <!--End Content-->

</div>
<!-- #main -->
