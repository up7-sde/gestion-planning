<?php ob_start(); ?>
<h1><?= $title ?></h1>

<form method="POST" action="/web/modifier/service" class="form-horizontal">
<fieldset>
<legend>Service</legend>
<!-- permet de passer l'id du service -->
<input type="hidden" name="idService" value=<?= $thisServiceid ?>>

<?php require('view/form/ViewFormEnseignement.php'); ?>
<?php require('view/form/ViewFormEnseignant.php'); ?>
<?php require('view/form/ViewFormTypeService.php'); ?>
<?php require('view/form/ViewFormAnnee.php'); ?>
<?php require('view/form/ViewFormHeure.php'); ?>

<!-- Valider / Annuler -->
<div class="form-group">
  <label class="col-md-4 control-label" for="validerBtn"></label>
  <div class="col-md-8">
    <button id="validerBtn" name="validerBtn" class="btn btn-success">Valider</button>
    <!-- debug : variabliser le lien de retour -->
    <a class="btn btn-primary" href="/web/service" role="button">Retour</a>
  </div>
</div>

</fieldset>
</form>
<?php $article = ob_get_clean(); ?>

<?php require('template/base.php'); ?>
