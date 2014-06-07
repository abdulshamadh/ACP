<?php
/* * ******************************************
 * File - home.php
 * Created On - 04 March 2013
 * Update On - 
 * Author Name - Abdul Shamadhu
 * Description - This is the php file for performing admin home content based files
 * ****************************************** */
require_once('no_entry.php');
$loginDetails = $_SESSION;
?>
<div id="main" class="fullwidth">

    <!--Begin Content-->
    <article id="content">
        <div class="col-box main-box">
            <div class="middle"> 
                <div id="dcontent">
                    <div class="clr">&nbsp;</div>
                    <center>
                        <u>
                            <font size="4"> Welcome To The Admin Dashboard </font>
                        </u>
                    </center>
                    <div class="clr">&nbsp;</div>

                    <div style="float:left;padding:20px 0px 20px 0px;">
                        <img src="images/administrator.png"> 
                    </div>

                    <div style="float:right;padding:20px 0px 20px 0px;width:450px;">

                        <table cellspacing="20" cellpadding="20" style="float:right;">
                            <tbody>
                                <tr>
                                    <td nowrap="" class="logintd"> 
                                        <a href="<?php SERVER_PATH; ?>index.php?file=home">
                                            <img class="loginimg" src="images/home.png"> 
                                            <p class="loginptab">Home</p>
                                        </a>
                                    </td>	

                                    <td nowrap="" class="logintd"> 
                                        <a href="<?php SERVER_PATH; ?>index.php?file=admin">
                                            <img class="loginimg" src="images/password.png"> 
                                            <p class="loginptab">Manage Admin</p>
                                        </a>
                                    </td>						
                                </tr>

                                <tr>					
                                    <td nowrap="" class="logintd"> 
                                        <a href="<?php SERVER_PATH; ?>index.php?file=users">
                                            <img class="loginimg" src="images/users.png"> 
                                            <p class="loginptab">Manage Users</p>
                                        </a>
                                    </td>

                                    <td nowrap="" class="logintd"> 
                                        <a href="<?php SERVER_PATH; ?>index.php?file=subscribers">
                                            <img class="loginimg" src="images/subscription.png"> 
                                            <p class="loginptab">Manage Subscribers</p>
                                        </a>
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

