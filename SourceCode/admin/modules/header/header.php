<!DOCTYPE html>
<!--Begin Html-->
<html dir="ltr" lang="en-US"><!--Begin Head--><head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <!--Meta Tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php echo $title; ?></title>
        <link href="<?php echo CSS_PATH ?>style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CSS_PATH ?>style_002.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo CSS_PATH ?>styles.css" rel="stylesheet" type="text/css" media="screen"/>
        <!--[if lt IE 7.]>
        <script defer type="text/javascript" src="http://www.acpcomputer.edu.sg/wp-content/plugins/fv-wordpress-flowplayer/js/pngfix.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="http://www.acpcomputer.edu.sg/wp-content/uploads/2012/10/favicon.ico">
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
            <center>
                <div class="wrapper">
                    <div class="header">      
                        <div class="header_r">
                            <?php
                            if ($adminLogged == '') {
                                ?>
                                <span class="headerfont_admin">
                                    <strong><?php echo $lang['T_ADMIN_DASH']; ?></strong>
                                </span>
                            <?php } ?>      
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div id="contents">
                        <?php
                        if ($adminLogged != '') {
                            ?>		
                            <div>
                                <ul class="navigation">
                                    <li style='border-right:1px solid white;'><a href="<?php SERVER_PATH; ?>index.php">Home</a></li>
                                    <li style='border-right:1px solid white;'><a href="<?php SERVER_PATH; ?>index.php?file=admin">Manage Admin</a></li>
                                    <li style='border-right:1px solid white;'><a href="<?php SERVER_PATH; ?>index.php?file=users">Manage Users</a></li>
                                    <li style='border-right:1px solid white;'><a href="<?php SERVER_PATH; ?>index.php?file=subscribers">Manage Subscribers</a></li>
                                    <li style='border-right:1px solid white;'><a href="<?php SERVER_PATH; ?>index.php?file=logout">Logout</a></li>
                                </ul>
                            </div>		
                            <?php
                        }
                        ?>