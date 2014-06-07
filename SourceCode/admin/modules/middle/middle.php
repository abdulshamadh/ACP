<div id="main" class="fullwidth">

    <!--Begin Content-->
    <article id="content">
        <div class="post-content col-box main-box">
            <div id="contentbottom">
                <h1><b>Welcome to ACP Computer !!!</b></h1>
            </div>
            <div class="clr">&nbsp;</div>

            <div style="float:left;">
                <img src="images/login.png">
            </div>

            <div class="middle">
                <div class="contentfont">
                    <div class="ERROR" style="padding-top:30px;" align="center" >
                        <strong><?php echo $errors['LOGIN_ERROR']; ?></strong>
                    </div>
                    <div style="height:15px">&nbsp;</div>
                    <table cellspacing="0" cellpadding="0" border="0" class="table_cart_login" align="center">
                        <tr style="background-color:#007EC7;color:#FFF;" align="center"><td>Please login into your site</td></tr>
                        <tr>
                            <td align="center">
                                <table width="90%" cellspacing="10" cellpadding="10" border="0" >    
                                    <tr>
                                        <td height="10" colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" align="center">
                                            <form name="frmUserLogin" method="post" action="<?php echo $SERVER_PATH; ?>index.php?file=login" style="margin:0px">
                                                <input type="hidden" name="task" id="task" value="login"/>
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" align="center">
                                                    <?php
                                                    if ($user_message != '') {
                                                        ?>
                                                        <tr>
                                                            <td class="redtxt" align="center" height="30"  colspan="2" valign="middle"><?php echo $user_message; ?></td>
                                                        </tr> 
                                                        <?php
                                                    }
                                                    ?>
                                                    <tr><td colspan="2" height="5"></td></tr>
                                                    <tr>
                                                        <td align="left" class="contentfont"><strong>Email Address:</strong></td>
                                                        <td align="left"><input type="text" id="txtEmail" name="txtEmail" size="40" maxlength="100" value="<?php echo $login_username; ?>"/></td>
                                                    </tr>
                                                    <tr><td colspan="2" height="5"></td></tr>
                                                    <tr>
                                                        <td align="left" class="contentfont"><strong>Password:</strong></td>
                                                        <td align="left"><input type="password" id="txtPassword" name="txtPassword" size="40" maxlength="100" value=""/></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" height="8"></td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="2" height="10"></td>
                                                    </tr>
                                                    <tr>
                                                        <td align="center" colspan="2"> 
                                                            <input type="hidden" name="hdnAction" id="hdnAction" value="login" />
                                                            <input type="submit" name="login" value="Login"/>
                                                        </td>
                                                    </tr>
                                                </table>                                    
                                            </form>   
                                        </td>    
                                    </tr>
                                    <tr>
                                        <td colspan="2" height="10"></td>
                                    </tr>   
                                </table>
                            </td>
                        </tr>
                    </table>  

                    <div style="height:15px">&nbsp;</div>
                </div>
            </div>      

            <div class="clear"></div>
            <div style="margin-top: 30px;"></div>

        </div>

    </article>
    <!--End Content-->

</div>
<!-- #main -->
