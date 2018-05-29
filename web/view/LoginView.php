<?php ob_start(); ?>
<h1>Login</h1>
<form action="/web/auth/login" method="post">
Login: <input type="text" name="name"><br>
Password: <input type="password" name="password"><br>
<input type="submit">
</form><br/>
<?php $article = ob_get_clean(); ?>

<?php require('template/base.php'); ?>
