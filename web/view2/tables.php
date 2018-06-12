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
    
      <?=$this->viewEngine->generateNavbar($this->namespace, $user);?>

      <h5 class="mt-5 font-weight-bold"><i class="fa fa-list"></i> Tableau</h5>

      <div class="card align-self-center mt-4 mb-2">
        <div class="card-body">

        <?=$this->viewEngine->generateTitle($this->title, $titleButton);?>
        <?=$this->viewEngine->generateMessage($this->messenger->pop());?>

        <div class="btn-toolbar justify-content-between btn-toolbar mb-2" role="toolbar" aria-label="Toolbar with button groups">
          
          <div class="input-group input-group-sm">
            <select class="custom-select custom-select-sm" id="inlineFormCustomSelect">
              <option selected disable>Voir</option>
              <option value="1">10</option>
              <option value="2">20</option>
              <option value="3">50</option>
            </select>
          </div>

          <div class="btn-group btn-group-sm" role="group" aria-label="First group">
            <button type="button" class="btn btn-outline-secondary"><i class="fas fa-search-plus"></i></button>
            <button type="button" class="btn btn-outline-secondary"><i class="fas fa-search-minus"></i></button>
          </div>
      
        </div>

        <?=$this->viewEngine->generateTable($this->data, $tableAction);?>
        
        <nav aria-label="Page navigation example">
          <ul class="pagination pagination-sm justify-content-start">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                <a class="page-link" href="#">Next</a>
              </li>
          </ul>
        </nav>
        
      </div>
      </div>

      <div class="mb-5 small">
      <a href="http://www.github.com/up7-sde/gestion-planning" target="_blank">The Company© 2018</a>
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