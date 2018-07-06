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

    <title><?=$this->title?></title>
  </head>

  <body style="padding-top:56px;" class="bg-light">
  
    <div class="container">
    
      <?=$this->viewEngine->generateNavbar($this->namespace, $user);?>

      <div class="card align-self-center mt-5 mb-1">
      <div class="card-body">

        <?=$this->viewEngine->generateTitle($this->title);?>
        
        <?=$this->viewEngine->generateMessage($this->messenger->pop());?>

          <!--
          <div class="btn-toolbar mb-2" role="toolbar" aria-label="Toolbar with button groups">
          
          <div class="input-group input-group-sm mr-2">
            <select name="display" class="custom-select custom-select-sm" id="inlineFormCustomSelect">
              <option class="selected" value="all">Tout</option>
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="30">50</option>
            </select>
          </div>

          
          <div class="btn-group btn-group-sm mr-2" role="group" aria-label="First group">
            <button id="previous" type="button" class="btn btn-outline-transparent"><i class="fas fa-chevron-left"></i></button>
            <button id="next" type="button" class="btn btn-outline-transparent"><i class="fas fa-chevron-right"></i></button>
          </div>

          <div class="btn-group btn-group-sm mr-2" role="group" aria-label="First group">
            <button id="zoomPlus" type="button" class="btn btn-outline-secondary"><i class="fas fa-search-plus"></i></button>
            <button id="zoomMinus" type="button" class="btn btn-outline-secondary"><i class="fas fa-search-minus"></i></button>
          </div>
          
          <div class="btn-group-sm mr-2" role="group" aria-label="Third group">
          <a href="/web/enseignants?action=download" role="button" type="button" class="btn btn-warning"><i class="fas fa-download"></i> CSV</a>
        </div>

        <div class="btn-group-sm mr-2" role="group" aria-label="Third group">
          <button type="button" class="btn btn-warning" data-toggle="tooltip" data-placement="bottom" title="Télécharger"><i class="fas fa-download"></i></button>
        </div>

        
      
      <div class="btn-group-sm mr-2" role="group" aria-label="Third group">
          <button type="button" class="btn btn-success"><i class="fas fa-plus"></i> Ajouter</button>
        </div>

        <div class="btn-group-sm mr-2" role="group" aria-label="Third group">
          <button type="button" class="btn btn-warning"><i class="fas fa-download"></i> Télécharger</button>
        </div>

          <div class="btn-group-sm" role="group" aria-label="Third group">
          <button type="button" class="btn btn-success"><i class="fas fa-plus"></i></button>
        </div>
            
        </div> -->

        <?=$this->viewEngine->generateTable2($this->namespace, $this->data, $tableAction, $this->isUserAdmin());?>
                  
        
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
    <?=$this->viewEngine->generateScript($titleButton)?>
    <script src="/web/static/javascript/tableFeatures.js"></script>
    <script src="/web/static/javascript/alerts.js"></script>
  </body>
</html>