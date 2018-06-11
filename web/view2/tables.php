<!doctype html>
<html lang="en">
  
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Fugaz+One" rel="stylesheet"> 
    <link href="/web/static/css/style.css" rel="stylesheet"/>

    <title><?=$this->title?></title>
  </head>
  <body style="padding-top:56px;" class="bg-light">

    <div class="container">
    
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark <?=$user['color']?> shadow">
        <div class="container">
        <a class="navbar-brand" style="font-family: 'Fugaz One', cursive;" href="/web/accueil">
        <i class="fas fa-cube"></i>
          Admin-Sde
        </a> 
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/web/accueil">Acceuil</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="/web/formations?action=show">Formations</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/web/enseignants?action=show">Enseignants</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="/web/enseignements?action=show">Enseignements</a>
            </li>
          <li class="nav-item">
          <a class="nav-link" href="/web/cours?action=show">Cours</a>
          </li>
        
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Référentiels
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                
              <a class="dropdown-item" href="/web/referentiels/diplomes?action=show">Diplômes</a>
              <a class="dropdown-item" href="/web/referentiels/types?action=show">Types de cours</a>
              <a class="dropdown-item" href="/web/referentiels/statuts?action=show">Statuts Enseignants</a>
                     
              </div>
            </li>

            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Routines
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#">Nouvelle Année</a>      
            </div>
            </li>

            </ul>
          
            <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Modifier</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="/web/auth?action=quit"><i class="fas fa-power-off"></i> Déconnexion</a>
                  </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-cog"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <div class="dropdown-header">Thème</div>
                  <a class="dropdown-item" href="/web/reglages?color=bg-info"><div class='ColorDiv bg-info'></div> Blue</a>
                  <a class="dropdown-item" href="/web/reglages?color=bg-danger"><div class='ColorDiv bg-danger'></div> Red</a>
                  <a class="dropdown-item" href="/web/reglages?color=bg-success"><div class='ColorDiv bg-success'></div> Green</a>
                  <a class="dropdown-item" href="/web/reglages?color=bg-warning"><div class='ColorDiv bg-warning'></div> Orange</a>
                  <a class="dropdown-item" href="/web/reglages?color=bg-dark"><div class='ColorDiv bg-dark'></div> Black</a>
                </div>
              </li>
            </ul>
        </div>
    </div>
    
      </nav>
      
      <?=$this->viewEngine->generateTitle($this->title, $titleButton);?>
      <?=$this->viewEngine->generateMessage($this->messenger->pop());?>
      <?=$this->viewEngine->generateTable($this->data, $tableAction);?>

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