<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta lang="fr">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!-- CSS Perso -->
    <link href="/web/static/css/style.css" rel="stylesheet"/>
    <title><?= $pageTitle ?></title>
  </head>
  <body>
    <div class="container-fluid">
      <!-- HEADER -->
      <?php if(isset($user)) { ?>
        <div class="row">
          <header class="col-xl-12">
              <?php require('header.php'); ?>
          </header>
        </div>
      <?php } ?>
      <!-- NAVBAR -->
      <?php if(isset($user)) { ?>
        <div class="row">
          <nav class="col-xl-12">
            <?php require('nav.php'); ?>
          </nav>
        </div>
      <?php } ?>
      <!-- ARTICLE -->
      <div class="row">
          <article class="col-xl-12">
            <!-- afficher un message s'il y en a un -->
            <?php if (isset($_SESSION["message"])) { ?>
              <div class="col-xl-12 alert alert-success">
                <strong><?= $_SESSION["message"] ?></strong>
              </div>
            <?php }
            unset($_SESSION["message"]);?>

            <?= $article ?>
          </article>
      </div>
      <!-- FOOTER -->
      <div class="row">
          <footer class="col-xl-12">
            <div class="row">
              <?php require('footer.php'); ?>
            </div>
          </footer>
      </div>

    </div>
    <!-- Sourcer les script JS -->
    <!-- Pour Bootstrapt :jQuery, Popper.js, Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <!-- Script perso -->
    <!-- <script type="text/javascript" src="/web/static/javascript/toggleMenu.js"></script> -->
  </body>
</html>
