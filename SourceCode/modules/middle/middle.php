<div id="main" class="fullwidth">
    <!--Begin Content-->
    <article id="content">
        <div class="post-content col-box main-box">
            <?php if ($errors['LOGIN_ERROR']) { ?>
                <div class="ERROR">
                    <?php echo $errors['LOGIN_ERROR']; ?>
                </div>
            <?php
            }

            if ($user_message != '') {
                echo $user_message;
            }
            ?>
            <div class="content">
                <div class="left">
                    <div class="login-box">
                        <div class="signin-section">
                            <form name="frmUserLogin" method="post" action="<?php echo $SERVER_PATH; ?>index.php?file=login">
                                <p><label>Email:</label><input type="text" id="txtEmail" name="txtEmail" size="40" maxlength="100" value="<?php echo $login_username; ?>"/></p>
                                <p><label>Password:</label><input type="password" id="txtPassword" name="txtPassword" size="40" maxlength="100" value=""/></p>
                                <input type="hidden" name="hdnAction" id="hdnAction" value="login" />
                                <input type="submit" name="login" class="signin" value=""/>
                            </form>
                            <a href="<?php echo $SERVER_PATH; ?>index.php?file=forgotpassword" class="forgot-pass">Forgot Password</a>
                        </div>    				
                    </div>		
                </div>
            </div>
            <div class="clear"></div>
            <div style="margin-top: 30px;"></div>
        </div>
    </article>
    <!--End Content-->
</div>
<!-- #main -->