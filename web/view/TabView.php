<?php ob_start(); ?>
<h1><?=$title ?></h1>
    <?php
    if (!empty($tab))
    {
    ?>
    <!-- le tableau prend toute la largeur avec des options -->
    <div class="table-responsive">
      <table class="table table-dark table-striped">
          <caption>Liste des enseignements</caption>
          <thead>
              <tr>
                <?php
                  // Obtenir le lien d'ajout pour le type (ex : /ajouter/service)
                  if (isset($prefix)) $link = '"/ajouter'. $prefix .'"';
                  else $link = "#";
                ?>
                      <th scope="col">#</th>
                  <?php foreach ($tab[0] as $key => $value) { ?>
                      <th scope="col"><?= $key ?></th>
                  <?php } ?>
                      <th>
                          <a class="btn btn-success" href=<?= $link ?> role="button">New</a>
                      </th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($tab as $ligne) { ?>
                  <tr>
                    <?php
                      // Obtenir le lien de modification pour chaque enregistrement
                      if (isset($prefix)) $link = '"'.$prefix . $ligne["id"].'"';
                      else $link = "#";
                    ?>
                      <!-- Debug : voir si on veut utiliser le scope qui pourrait être basé sur l'id-->
                      <th scope="row">X</th>
                      <?php foreach ($ligne as $val) { ?>
                          <td class="casetab"><?= $val ?></td>
                      <?php } ?>
                          <td>
                            <a class="btn btn-primary" href=<?= $link ?> role="button">Modifier</a>
                          </td>
                  </tr>
              <?php } ?>
          </tbody>
      </table>
    </div>
    <?php
    }
    else
    {
    ?>
        <p>Tableau vide<p>
<?php } ?>

<?php $article = ob_get_clean(); ?>

<?php require('template/base.php'); ?>
