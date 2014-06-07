<?php
/* * ******************************************
 * File - editsubscribercontent.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing edit subscriber content based files
 * ****************************************** */
include_once('no_entry.php');
include_once('class/subscribers.cls.php');
$loginDetails = $_SESSION;
?>
<script type="text/javascript" src = "<?php echo JS_PATH ?>jquery.js"></script>	
<script type="text/javascript" src = "<?php echo JS_PATH ?>editcontent_validation.js"></script>
<link href="<?php echo CSS_PATH ?>general.css" rel="stylesheet" type="text/css" />
<div id="main" class="fullwidth">

    <!--Begin Content-->
    <article id="content">
        <div class="col-box main-box">
            <div class="clr">&nbsp;</div>

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
                                            if (isset($_GET['subscriber_id'])) {
                                                $result = select_subscribers($_GET['subscriber_id']);
                                            }
                                            ?>
                                            <?php if (isset($_POST['editcontent']) && (!validateTitle($_POST['title']) || !validateDescription($_POST['description']))): ?>
                                                <div id="error">
                                                    <ul>

                                                        <?php if (!validateTitle($_POST['title'])): ?>
                                                            <li>
                                                                <strong>Invalid title:</strong> Stop cowboy! Type a valid title please :P
                                                            </li>
                                                        <?php endif ?>

                                                        <?php if (!validateDescription($_POST['description'])): ?>
                                                            <li>
                                                                <strong>Invalid description:</strong> Stop cowboy! Type a valid description please :P
                                                            </li>
                                                        <?php endif ?>					

                                                    </ul>
                                                </div>
                                            <?php elseif (isset($_POST['editcontent'])): ?>
                                                <div id="error" class="valid">
                                                    <ul>
                                                        <?php $msg = content_updation($_GET['subscriber_id'], $_POST['title'], stripslashes($_POST['description']), $_POST['status']); ?>
                                                        <li>
                                                            <strong><?php echo $msg; ?></strong>			
                                                        </li>
                                                    </ul>
                                                </div>
                                            <?php endif ?>
                                            <form method="post" id="editContentForm" action="">
                                                <div>
                                                    <label for="title">Title</label>
                                                    <input id="title" name="title" type="text" value="<?php echo $result[0]['title']; ?>"/>
                                                    <span id="titleInfo">Valid title please.</span>
                                                </div>

                                                <div>
                                                    <label for="description">Description</label>
                                                    <textarea id="description" name="description" type="text"><?php echo $result[0]['description']; ?></textarea>
                                                    <span id="descriptionInfo">Valid description please.</span>
                                                </div>

                                                <div style="display:none;">
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
                                                    <input id="editcontent" name="editcontent" type="submit" value="Save" />
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

