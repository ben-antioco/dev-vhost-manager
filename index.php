<?php require_once './template/template-index.php'; ?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <title>VHOST</title>
        <link rel="stylesheet" href="./dist/app.css">
        <script src="./assets/js/plugins/jquery-3.3.1.min.js"></script>
        <script src="./assets/js/plugins/jquery-ui-1.12.1/jquery-ui.min.js"></script>
        <link rel="stylesheet" href="./assets/lib/fontawesome-5.7.1/css/all.min.css">
        
    </head>

    <body>

        <?php require_once './html/nav.php'; ?>

        <?php require_once './html/datas.php'; ?>

        <?php $dbh = null; ?>

        <?php require_once './html/modal.php'; ?>

        <script src="./dist/app.pack.js"></script>

    </body>

</html>


