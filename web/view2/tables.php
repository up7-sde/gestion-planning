<!doctype html>
<html lang="en">
  
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/web/static/icons/favicon-cube.ico">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Fugaz+One" rel="stylesheet"> 
    <link href="/web/static/css/style.css" rel="stylesheet"/>

    <title>Up7-SDE | <?=$this->title?></title>
  </head>

  <body style="padding-top:56px;" class="bg-light">
  
    <div class="container">
    
      <?=$this->viewEngine->generateNavbar($this->namespace, $user);?>

      <div class="card align-self-center mt-5 mb-1">
      <div class="card-body">

        <?=$this->viewEngine->generateTitle($this->title, $titleButton);?>
        
        <?=$this->viewEngine->generateMessage($this->messenger->pop());?>

        <div class="responsive-table">
        <?=$this->viewEngine->generateTable2($this->namespace, $this->data, $tableAction, $this->auth->isUserAdmin());?>
        </div>
        
      </div>

      
    </div>
    <a href="http://www.github.com/up7-sde/gestion-planning" target="_blank">The Company© 2018</a>
     
    <!-- Optional JavaScript -->
    <!-- Optional JavaScript -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="/web/static/javascript/tableFeatures.js"></script>
    <script src="/web/static/javascript/alerts.js"></script>
  </body>
</html>