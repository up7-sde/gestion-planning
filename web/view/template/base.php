<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?= $title ?></title>
        <link href="/web/static/css/style.css" rel="stylesheet"/>
        <script type="text/javascript" src="/web/static/javascript/toggleMenu.js"></script>
    </head>
    <body>
        <?php require('header.php'); ?>
        <?php require('nav.php'); ?>
        <?= $article ?>
        <?php require('footer.php'); ?>
    </body>
</html>