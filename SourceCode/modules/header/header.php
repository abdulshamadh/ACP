<!DOCTYPE html>
<!--Begin Html-->
<html dir="ltr" lang="en-US"><!--Begin Head--><head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <!--Meta Tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>ACP E-learning | LMS | Web Development | Innovate to Succeed</title>
        <link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo CSS_PATH ?>style_002.css" rel="stylesheet" type="text/css" media="screen"/>
        <link rel="shortcut icon" href="http://www.acpcomputer.edu.sg/wp-content/uploads/2012/10/favicon.ico">
        <!--[if lt IE 7.]>
              <script defer type="text/javascript" src="http://www.acpcomputer.edu.sg/wp-content/plugins/fv-wordpress-flowplayer/js/pngfix.js"></script>
              <![endif]-->
        <!--End head-->
    </head>
    <!--Begin Body-->
    <body class="home page page-id-132 page-template page-template-template-home-php wp-front-page">
        <div id="page" class="hfeed">
            <header id="site-head">
                <div class="col-box clearfix">
                    <div class="site-logo">
                        <a href="http://www.acpcomputer.edu.sg/" title="ACP E-learning | LMS | Web Development"><img src="images/acplogo.jpg"></a>
                    </div>
                </div>
                <!--End Header-->
            </header>
            <?php
            if ($userLogged != '') {
                ?>
                <div>
                    <ul class="navigation">
                        <li style='border-right:1px solid white;'><a href="<?php SERVER_PATH; ?>index.php">Home</a></li>
                        <li style='border-right:1px solid white;'><a href="<?php SERVER_PATH; ?>index.php?file=edituser">My Profile</a></li>
                        <li style='border-right:1px solid white;'><a href="<?php SERVER_PATH; ?>index.php?file=subscribe">My Subscription</a></li>
                        <li style='border-right:1px solid white;'><a href="<?php SERVER_PATH; ?>index.php?file=logout">Logout</a></li>
                    </ul>
                </div>	
                <?php
            } else {
                ?>
                <div>
                    <ul class="navigation">
                        <li style='border-right:1px solid white;'><a href="<?php SERVER_PATH; ?>index.php">Home</a></li>
                        <li style='border-right:1px solid white;'><a href="<?php SERVER_PATH; ?>index.php?file=registration">Register</a></li>
                        <li style='border-right:1px solid white;'><a href="<?php SERVER_PATH; ?>index.php?file=login">Login</a></li>
                        <li style='border-right:1px solid white;'><a href="<?php SERVER_PATH; ?>index.php?file=forgotpassword">Forgot Password</a></li>
                    </ul>
                </div>	
                <?php
            }
            ?>