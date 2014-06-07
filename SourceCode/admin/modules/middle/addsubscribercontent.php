<?php
/* * ******************************************
 * File - addsubscribercontent.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing add subscriber content based files
 * ****************************************** */
include_once('no_entry.php');
include_once('class/subscribers.cls.php');
$loginDetails = $_SESSION;
?>
<script type="text/javascript" src = "<?php echo JS_PATH ?>jquery.js"></script>	
<script type="text/javascript" src = "<?php echo JS_PATH ?>addsubscribercontent_validation.js"></script>
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
                                            <?php if (isset($_POST['addcontent']) && (!validateTitle($_POST['title']) || !validateDescription($_POST['description']))): ?>
                                                <div id="error">
                                                    <ul>

                                                        <?php if (!validateTitle($_POST['title'])): ?>
                                                            <li>
                                                                <strong>Invalid title:</strong> Type a valid title please :P
                                                            </li>
                                                        <?php endif ?>

                                                        <?php if (!validateDescription($_POST['description'])): ?>
                                                            <li>
                                                                <strong>Invalid description:</strong> Type a valid description please :P
                                                            </li>
                                                        <?php endif ?>								

                                                    </ul>
                                                </div>
                                            <?php elseif (isset($_POST['addcontent'])): ?>
                                                <div id="error" class="valid">
                                                    <ul>
                                                        <?php $msg = content_add($_POST['title'], $_POST['description'], $_POST['status']); ?>
                                                        <li>
                                                            <strong><?php echo $msg; ?></strong>			
                                                        </li>
                                                    </ul>
                                                </div>
                                            <?php endif ?>
                                            <form method="post" id="addContentForm" action="">
                                                <div>
                                                    <label for="title">Title</label>
                                                    <input id="title" name="title" type="text" value=""/>
                                                    <span id="titleInfo">Valid title please.</span>
                                                </div>

                                                <div>
                                                    <label for="description">Description</label>
                                                    <textarea id="description" name="description" type="text"></textarea>
                                                    <span id="descriptionInfo">Valid description please.</span>
                                                </div>				

                                                <div>
                                                    <label for="status">Status</label>
                                                    <input id="status" name="status" type="radio" value="1" checked />Active
                                                    <input id="status" name="status" type="radio" value="0" />InActive
                                                </div>

                                                <div>
                                                    <input id="addcontent" name="addcontent" type="submit" value="Create Content" />
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
