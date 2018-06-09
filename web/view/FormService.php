<?php ob_start(); ?>
<h1><?= $title ?></h1>

<form method="POST" action="<?= $action ?>" class="form-horizontal">
<fieldset>
<legend>Service</legend>

<!-- permet de passer l'id du service et d'afficher un form vide si nouvel ajout -->
<?php if (isset($thisServiceid)) { ?>
  <input type="hidden" name="idService" value=<?= $thisServiceid ?>>
<?php } ?>

<?php require('view/form/ViewFormEnseignement.php'); ?>
<?php require('view/form/ViewFormEnseignant.php'); ?>
<?php require('view/form/ViewFormTypeService.php'); ?>
<?php require('view/form/ViewFormAnnee.php'); ?>
<?php require('view/form/ViewFormHeure.php'); ?>

<!-- Valider / Annuler -->
<div class="form-group">
  <label class="col-md-4 control-label" for="validerBtn"></label>
  <div class="col-md-8">

    <button type="submit" class="btn btn-success"><?= (isset($thisServiceid)) ? "Modifier" : "Ajouter" ?></button>
    <!-- debug : variabliser le lien de retour -->
    <a class="btn btn-primary" href="/web/cours?action=show" role="button">Retour</a>
    <?php if (isset($thisServiceid)) { ?>
      <a class="btn btn-danger" href="/web/cours/<?= $thisServiceid ?>?action=delete" role="button">Supprimer</a>
    <?php } ?>

  </div>
</div>

</fieldset>
</form>
<?php $article = ob_get_clean(); ?>

<?php require('template/base.php'); ?>