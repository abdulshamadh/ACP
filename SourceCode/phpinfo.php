<html>
    <head>
        <title>New </title>
    </head>
    <body>
        <?php
        ini_set('session.use_only_cookies', 1);
        ini_set('memory_limit', '20M');
        ini_set('session.use_trans_sid', 0);
        $path = getcwd();
        echo $path;
        echo "<br>";
        echo realpath('.');
        phpinfo();
        ?>
    </body>
</html>
