<?php
/* * ******************************************
 * File - users.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing users based files
 * ****************************************** */
require_once('no_entry.php');
include_once('class/users.cls.php');
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

            <div class="admin_listing">
                <h2 style='align:center;'> User List </h2>
                <table id="theTable" cellpadding="5" cellspacing="5" class="sortable-onload-0 no-arrow rowstyle-alt colstyle-alt paginate-10 max-pages-5 paginationcallback-callbackTest-displayTextInfo">
                    <thead>
                        <tr>
                            <th class="sortable-text">User ID</th>
                            <th class="sortable-text">First Name</th>
                            <th class="sortable-text">Last Name</th>
                            <th class="sortable-text">Email</th>
                            <th class="sortable-text">Subscription</th>
                            <th class="sortable-text">Created On</th>
                            <th class="sortable-text">Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_GET['user_id'])) {
                            echo delete_users($_GET['user_id'], $status);
                        }
                        if (isset($_GET['f']) && $_GET['f'] == 1) {
                            echo "<div class='valid' id='error'><ul><li><strong>User record has been updated successfully.</strong></li></ul></div>";
                        }
                        $result = get_users();
                        if (count($result) > 0) {
                            for ($i = 0; $i < count($result); $i++) {
                                if ($i % 2 == 0) {
                                    ?> <tr> <?php
                                    } else {
                                        ?> <tr class="alt"> <?php
                                    }
                                    ?>		
                                    <td><?php echo $result[$i]['user_id']; ?></td>
                                    <td><?php echo $result[$i]['firstname']; ?></td>
                                    <td><?php echo $result[$i]['lastname']; ?></td>
                                    <td><?php echo $result[$i]['email']; ?></td>
                                    <?php if ($result[$i]['subscription'] == 1) { ?>
                                        <td align="center"><img src="images/subscribe.png" alt="Subscribe" title="Subscribe" height="16" border="0"></td>
                                    <?php } else { ?>
                                        <td align="center"><img src="images/unsubscribe.png" alt="Unsubscribe" title="Unsubscribe" height="16" border="0"></td>
                                    <?php } ?>	
                                    <td><?php echo date('M j, Y', strtotime($result[$i]['created_on'])); ?></td>
                                    <?php if ($result[$i]['status'] == 1) { ?>
                                        <td align="center"><img src="images/active.png" alt="Active" title="Active" height="16" border="0"></td>
                                    <?php } else { ?>
                                        <td align="center"><img src="images/inactive.png" alt="In-Active" title="In-Active" height="16" border="0"></td>
                                    <?php } ?>
                                    <td align="center"><a href="<?php echo $PHP_SELF . "?file=edituser&user_id=" . $result[$i]['user_id']; ?>"><img src="images/edit.png" alt="Edit" title="Edit" height="16" border="0"></a>&nbsp;
                                        <a href="#" onclick="performDelete('<?php echo $PHP_SELF . "?file=users&user_id=" . $result[$i]['user_id']; ?>', '<?php echo $result[$i]['email']; ?>');
                                                return false;"><img src="images/delete.png" alt="Delete" title="Delete" height="16" border="0"></a>
                                    </td>
                                </tr>  
                                <?php
                            }
                        } else {
                            ?>
                            <tr><td colspan="11" align="center">No Records Found</td></tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div align="right">
                    <img src="images/subscribe.png" alt="Subscribe" title="Subscribe" height="16" border="0"> - Subscribe &nbsp;
                    <img src="images/unsubscribe.png" alt="Unsubscribe" title="Unsubscribe" height="16" border="0"> - Unsubscribe &nbsp; 
                    <img src="images/active.png" alt="Active" title="Active" height="16" border="0"> - Active &nbsp; 
                    <img src="images/inactive.png" alt="In-Active" title="In-Active" height="16" border="0"> - In-Active &nbsp;
                    <img src="images/edit.png" alt="Edit" title="Edit" height="16" border="0"> - Edit &nbsp;
                    <img src="images/delete.png" alt="Delete" title="Delete" height="16" border="0"> - Delete
                </div> 
            </div>
            <div class="clear"></div>
            <div style="margin-top: 30px;"></div>

        </div>

    </article>
    <!--End Content-->

</div>
<!-- #main -->
