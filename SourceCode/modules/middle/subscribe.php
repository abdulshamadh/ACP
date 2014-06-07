<?php
/* * ******************************************
 * File - subscribe.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing user subscribe based files
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
                                        <?php if (isset($_POST['edituser'])): ?>
                                            <div id="error" class="valid">
                                                <ul>

                                                    <?php $msg = user_subscription_updation($_GET['user_id'], $_POST['subscription']); ?>
                                                    <li>
                                                        <strong><?php echo $msg; ?></strong>			
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php endif ?>
                                        <form method="post" id="editUserForm" action="">						

                                            <div>
                                                <label for="status">Subscription</label><div class="clr">&nbsp;</div>
                                                <input id="status" name="subscription" type="radio" value="1" <?php
                                                if ($result[0]['subscription'] == 1) {
                                                    echo "Checked";
                                                }
                                                ?> />Subscribe
                                                <input id="status" name="subscription" type="radio" value="0" <?php
                                                if ($result[0]['subscription'] == 0) {
                                                    echo "Checked";
                                                }
                                                ?> />Un-Subscribe
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

