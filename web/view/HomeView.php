<?php ob_start(); ?>
<div class="jumbotron">
  <h1 class="display-4">Bienvénu sur SDE-UP7!</h1>
  <p class="lead">Cette application web permet de gérer un planning d'enseingnant d'une université</p>
  <hr class="my-4">
  <p>Elle repose sur la manipulation de Service, d'Enseignement, d'Enseingnant et de Formation</p>
  <p class="lead">
    <a class="btn btn-primary btn-lg" href="#" role="button">Voir le projet sur Git hub</a>
  </p>
</div>
<?php $article = ob_get_clean(); ?>

<?php require('template/base.php'); ?>
