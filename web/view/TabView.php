<?php ob_start(); ?>
<h1><?=$title ?></h1>
    <?php
    if (!empty($tab))
    {
    ?>
    <!-- le tableau prend toute la largeur avec des options -->
    <div class="table-responsive">
      <table class="table table-dark table-striped">
          <!-- debug a variabiliser -->
          <caption>Liste des XXXX</caption>
          <thead>
              <tr>
                      <th scope="col">#</th>
                  <?php foreach ($tab[0] as $key => $value) { ?>
                      <th scope="col"><?= $key ?></th>
                  <?php } ?>
                      <th>
                          <a class="btn btn-success" href="<?= $prefix ?>nouveau" role="button">New</a>
                      </th>
              </tr>
          </thead>
          <tbody>
              <?php foreach ($tab as $ligne) { ?>
                  <tr>
                      <!-- Debug : voir si on veut utiliser le scope qui pourrait être basé sur l'id-->
                      <th scope="row">X</th>
                      <?php foreach ($ligne as $val) { ?>
                          <td class="casetab"><?= $val ?></td>
                      <?php } ?>
                          <td>
                            <a class="btn btn-primary" href=<?= $prefix . $ligne["id"] ?> role="button">Modifier</a>
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
