<?php
/* * ******************************************
 * File - edituser.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing edit user based files
 * ****************************************** */
include_once('no_entry.php');
include_once('class/users.cls.php');
$loginDetails = $_SESSION;
?>
<script type="text/javascript" src = "<?php echo JS_PATH ?>jquery.js"></script>	
<script type="text/javascript" src = "<?php echo JS_PATH ?>edituser_validation.js"></script>
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
                                            <?php
                                            if (isset($_GET['user_id'])) {
                                                $result = select_users($_GET['user_id']);
                                            }
                                            ?>
                                            <?php if (isset($_POST['edituser'])): ?>
                                                <div id="error" class="valid">
                                                    <ul>
                                                        <?php $msg = user_updation($_GET['user_id'], $_POST['email'], $_POST['status']); ?>
                                                        <li>
                                                            <strong><?php echo $msg; ?></strong>			
                                                        </li>
                                                    </ul>
                                                </div>
                                            <?php endif ?>
                                            <form method="post" id="editUserForm" action="">	
                                                <div>
                                                    <label for="email">E-mail</label>
                                                    <input id="email" name="email" type="text" value="<?php echo $result[0]['email']; ?>" readonly="readonly"/>
                                                    <span id="emailInfo">Valid E-mail please.</span>
                                                </div>							
                                                <div>
                                                    <label for="status">Status</label>
                                                    <input style="border:0px;" id="status" name="status" type="radio" value="1" <?php
                                                    if ($result[0]['status'] == 1) {
                                                        echo "Checked";
                                                    }
                                                    ?> />Active
                                                    <input style="border:0px;" id="status" name="status" type="radio" value="0" <?php
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


