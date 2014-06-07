<?php
/* * ******************************************
 * File - forgotpassword.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing forgot password based files
 * ****************************************** */
include_once('session_access.php');
include_once('class/forgot.cls.php');
include_once('class/validation.cls.php');
$loginDetails = $_SESSION;
$request_captcha = htmlspecialchars($_REQUEST['captcha']);
$validation = new Validation();
?>
<link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" type="text/css" />
<link href="<?php echo CSS_PATH ?>jqtransform.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src = "<?php echo JS_PATH ?>jquery.js"></script>	
<script type="text/javascript" src = "<?php echo JS_PATH ?>forgot_validation.js"></script>
<script type="text/javascript" src = "<?php echo JS_PATH ?>jquery.jqtransform.js"></script>
<script language="javascript">
    $(function() {
        $('form').jqTransform({imgPath: 'jqtransformplugin/img/'});
    });
</script>
<div id="main" class="fullwidth">

    <!--Begin Content-->
    <article id="content">
        <div class="post-content col-box main-box">
            <div id="formcontainer">
                <?php if (isset($_POST['forgot']) && (!$validation->validateEmail($_POST['email']))): ?>
                    <div id="error">
                        <ul>							

                            <?php if (!$validation->validateEmail($_POST['email'])): ?>
                                <li>
                                    <strong>Invalid E-mail:</strong> Type a valid e-mail please
                                </li>
                            <?php endif ?>								

                        </ul>
                    </div>
                <?php elseif (isset($_POST['forgot']) && $request_captcha != $_SESSION['captcha']): ?>
                    <div id="error">
                        <ul>
                            <?php unset($_SESSION['captcha']); ?>
                            <li>
                                <strong>Invalid Captcha:</strong> Type a valid captcha please
                            </li>
                        </ul>
                    </div>
                <?php elseif (isset($_POST['forgot'])): ?>
                    <div id="error" class="valid">
                        <ul>
                            <?php $msg = forgot_verification($_POST['email']); ?>
                            <li>
                                <strong><?php echo $msg; ?></strong>			
                            </li>
                        </ul>
                    </div>
                <?php endif ?>
                <form method="post" id="forgotForm" action="" class="customForm">
                    <div class="form_content">

                        <div class="form_inputs">
                            <label>&nbsp;</label>
                            <h1>Did you forgot your password?</h1>
                        </div>

                        <div class="form_inputs">												
                            <label for="email">Enter a valid email address</label>
                            <input id="email" name="email" type="text" value="<?php echo $_POST['email']; ?>"/>
                            <span id="emailInfo"></span>
                        </div>		

                        <div class="form_inputs">
                            <label for="captcha">Write the following word</label>
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

                        <div class="submitform_inputs">
                            <input id="forgot" name="forgot" type="submit" class="submit" value=""/>

                        </div>

                    </div>	
                </form>
            </div>
            <div class="clear"></div>
            <div style="margin-top: 30px;"></div>

        </div>

    </article>
    <!--End Content-->

</div>
<!-- #main -->
