<?php
/* * ******************************************
 * File - subscribers.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing users subscribers based files
 * ****************************************** */
require_once('no_entry.php');
include_once('class/subscribers.cls.php');
$loginDetails = $_SESSION;
date_default_timezone_set('UTC');
?>
<script type="text/javascript" src = "<?php echo JS_PATH ?>tablesort.js"></script>	
<script type="text/javascript" src = "<?php echo JS_PATH ?>paginate.js"></script>
<script type="text/javascript" src = "<?php echo JS_PATH ?>general.js"></script>

<link href="<?php echo CSS_PATH ?>table-sort.css" rel="stylesheet" type="text/css" />
<div id="main" class="fullwidth">

    <!--Begin Content-->
    <article id="content">
        <div class="col-box main-box">
            <div class="clr">&nbsp;</div>
            <div class="admin_addsubtitle">

                <a href="<?php SERVER_PATH; ?>index.php?file=addsubscribercontent">
                    <img border="0" src="images/add.png"> Add Subscriber Content
                </a>&nbsp;&nbsp;&nbsp;&nbsp;

            </div>

            <div class="clr">&nbsp;</div>

            <div class="admin_listing">

                <table id="theTable" cellpadding="5" cellspacing="5" class="sortable-onload-0 no-arrow rowstyle-alt colstyle-alt paginate-5 max-pages-5 paginationcallback-callbackTest-displayTextInfo">
                    <thead>
                        <tr>
                            <th class="sortable-text">ID</th>
                            <th class="sortable-text">Title</th>
                            <th class="sortable-text">Message</th>
                            <th class="sortable-text">Created On</th>
                            <th class="sortable-text">Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['subscriber_id'])) {
                            echo delete_subscriber($_GET['subscriber_id']);
                        }
                        if (isset($_GET['f']) && $_GET['f'] == 1) {
                            echo "<div class='valid' id='error'><ul><li><strong>Subscriber record has been updated successfully.</strong></li></ul></div>";
                        }
                        if (isset($_GET['s']) && $_GET['s'] == 1) {
                            echo "<div class='valid' id='error'><ul><li><strong> All the subscribers mail been sent successfully.</strong></li></ul></div>";
                        }
                        if (isset($_GET['sub_id'])) {
                            echo send_emailsubscribers($_GET['sub_id']);
                        }
                        $result = get_subscribers();
                        if (count($result) > 0) {
                            for ($i = 0; $i < count($result); $i++) {
                                if ($i % 2 == 0) {
                                    ?> <tr> <?php
                                    } else {
                                        ?> <tr class="alt"> <?php
                                    }
                                    ?>			
                                    <td><?php echo $result[$i]['subscriber_id']; ?></td>
                                    <td><?php echo $result[$i]['title']; ?></td>
                                    <?php $shortdesc = myTruncate($result[$i]['description'], 200); ?>
                                    <td><?php echo stripslashes($shortdesc); ?></td>
                                    <td><?php echo date('M j, Y', strtotime($result[$i]['created_on'])); ?></td>
                                    <?php if ($result[$i]['status'] == 1) { ?>
                                        <td align="center"><img src="images/active.png" alt="Active" title="Active" height="16" border="0"></td>
                                    <?php } else { ?>
                                        <td align="center"><img src="images/inactive.png" alt="In-Active" title="In-Active" height="16" border="0"></td>
                                    <?php } ?>
                                    <td align="center">	
                                        <a href="#" onclick="performSubscribers('<?php echo $PHP_SELF . "?file=subscribers&sub_id=" . $result[$i]['subscriber_id']; ?>', '<?php echo $result[$i]['title']; ?>');
                                                return false;"><img src="images/email_send.png" alt="Send Email to All the Subscribers" title="Send Email to All the Subscribers" height="16" border="0"></a>&nbsp;
                                        <a href="<?php echo $PHP_SELF . "?file=editsubscribercontent&subscriber_id=" . $result[$i]['subscriber_id']; ?>"><img src="images/edit.png" alt="Edit" title="Edit" height="16" border="0"></a>&nbsp;
                                        <a href="#" onclick="performDelete('<?php echo $PHP_SELF . "?file=subscribers&subscriber_id=" . $result[$i]['subscriber_id']; ?>', '<?php echo $result[$i]['title']; ?>');
                                                return false;"><img src="images/content_delete.png" alt="Delete" title="Delete" height="16" border="0"></a></td>
                                </tr>  
                                <?php
                            }
                        } else {
                            ?>
                            <tr><td colspan="7" align="center">No Records Found</td></tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>

                <div align="right">
                    <img src="images/active.png" alt="Active" title="Active" height="16" border="0"> - Active &nbsp; 
                    <img src="images/inactive.png" alt="In-Active" title="In-Active" height="16" border="0"> - In-Active &nbsp;
                    <img src="images/email_send.png" alt="Send Email to All the Subscribers" title="Send Email to All the Subscribers" height="16" border="0"> - Send Email to All the Subscribers &nbsp;
                    <img src="images/edit.png" alt="Edit" title="Edit" height="16" border="0"> - Edit &nbsp;
                    <img src="images/content_delete.png" alt="Delete" title="Delete" height="16" border="0"> - Delete
                </div> 
            </div>
            <div class="clear"></div>
            <div style="margin-top: 30px;"></div>

        </div>

    </article>
    <!--End Content-->

</div>
<!-- #main -->
