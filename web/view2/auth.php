<!doctype html>
<html lang="en" style="height:100%;">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/web/static/icons/favicon-cube.ico">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <title>Up7-SDE | <?=$this->title?></title>
    
    <link href="https://fonts.googleapis.com/css?family=Fugaz+One" rel="stylesheet">

  </head>

  <body class="bg-light container-fluid d-flex justify-content-center pb-5" style="min-height:100%;">
      <!--logo-->

      <div class="col-md-4 col-sm-5 align-self-center mt-5">

      <h1 style="text-align:center;"><i class="fas fa-2x fa-cube align-self-center"></i></h1>
      <h1 style="font-family: 'Fugaz One', cursive; text-align:center;" class="align-self-center">Admin-Sde</h1>


      <div class="card align-self-center mb-2 mt-5">
        <div class="card-body">

      <h4>Connexion</h4>

      <?=$this->viewEngine->generateMessage($this->messenger->pop());?>

      <form method="post" action="/web/auth">
      <input type="hidden" name="csrf" value="<?php echo $this->csrf->generateToken(); ?>">
      <div class="form-group">
      <label for="inlineFormInputGroupUsername1">Email</label>
      <div class="input-group mb-2 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-at"></i></div>
        </div>
        <input name='email' type="text" class="form-control" id="inlineFormInputGroupUsername1" placeholder="Email">
      </div>
      </div>

      <div class="form-group">
      <label for="inlineFormInputGroupUsername2">Mot de passe</label>
      <div class="input-group mb-4 mr-sm-2">
        <div class="input-group-prepend">
          <div class="input-group-text"><i class="fas fa-lock"></i>
        </div>
        </div>
        <input name='password' type="password" class="form-control" id="inlineFormInputGroupUsername2" placeholder="Mot de passe">
      </div>
      </div>


        <button type="submit" class="btn btn-primary btn-block" class="align-self-center"><i class="fas fa-chevron-right"></i> Se connecter</button>

      </form>

      </div>
      </div>


    <div class="mb-5 small">
    <a href="http://www.github.com/up7-sde/gestion-planning" target="_blank">The Company© 2018</a>
  </div>


      </div>
    </div>
  </div>



    <!-- Optional JavaScript -->
    <!-- Optional JavaScript -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
