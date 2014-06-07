<?php
/* * ******************************************
 * File - active.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing user account active based files
 * ****************************************** */
include_once('class/active.cls.php');
$user_id = $_GET['user_id'];
?>
<div id="main" class="fullwidth">

    <!--Begin Content-->
    <article id="content">
        <div class="post-content col-box main-box">
            <div class="clr">&nbsp;</div>

            <div class="middle">
                <div class="contentfont">
                    <?php if ($errors['LOGIN_ERROR']) { ?>
                        <div class="ERROR">
                            <?php echo $errors['LOGIN_ERROR']; ?>
                        </div>
                    <?php } ?>
                    <?php user_active($user_id); ?>
                    <div class="">
                        <?php echo "<span class='success_msg'>User account is activated successfully. Please <a href='index.php?file=login'>login</a> with your account</span>"; ?>
                    </div>
                    <div style="height:15px">&nbsp;</div> 
                </div>		
            </div>    
            <div class="clr">&nbsp;</div>
            <div class="clr">&nbsp;</div>
            <div class="clr">&nbsp;</div>      
            <div style="margin-top: 30px;"></div>
        </div>
    </article>
    <!--End Content-->
</div>
<!-- #main -->