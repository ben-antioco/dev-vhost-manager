<?php

require_once './vendor/autoload.php';

require_once './template/template-index.php'; 

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>VHOST</title>
    
        <script src="./assets/js/plugins/jquery-3.3.1.min.js"></script>
        <script src="./assets/js/plugins/jquery-ui-1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="./assets/lib/fontawesome-5.7.1/css/all.min.css">
        <link rel="stylesheet" href="./dist/app.css">

        <link rel="stylesheet" href="./assets/js/plugins/jodit-3.1.95/jodit.min.css">
        <script src="./assets/js/plugins/jodit-3.1.95/jodit.min.js"></script>     
        
    </head>

    <body>

        <?php require_once './html/nav.php'; ?>

        <?php require_once './html/datas.php'; ?>

        <?php $dbh = null; ?>

        <?php require_once './html/modal.php'; ?>

        <script src="./dist/app.pack.js"></script>

    </body>

</html>


