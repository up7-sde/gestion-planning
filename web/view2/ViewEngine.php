<?php
class ViewEngine {
        public function __construct(){
            $this->attributes = Model::$attributes;
            $this->tables = Model::$tables;
        }

        public function generateTable($data, $path){
            
            $table = "";

            if (!isset($data) || !$data || count($data) == 0){
                $table = '<div class="alert alert-warning" role="alert">
                            Warning_Pas de données
                            </div>';
            } else {
                $table = '<div class="table-responsive">
                            <table class="table table-striped table-bordered table-sm" 
                            style="font-size:0.8rem;
                            white-space: nowrap;">
                            <thead>
                                <tr>';

                foreach($data[0] as $key => $value){
                    $table = $table . '<th scope="col">'. $key . '</th>';
                }

                $table = $table . '<th scope="col">Actions</th>';
                $table = $table . '</tr></thead>';

                $table = $table . '<tbody>';
                
                foreach($data as $key => $obs){

                    $table = $table . '<tr>';
                    
                    foreach($obs as $key => $value){
                        $table = $table . '<td><span class="badge badge-pill badge-success">32%</span> '. $value .'</td>';
                    }
                    
                    $table = $table . 
                    '<td>
                        <a class="btn btn-primary btn-xs" href="'.$path.'/'.$obs['id'].'?action=edit" role="button"><i class="far fa-edit"></i> Modifier</a>
                        <a id="deleteButton" class="btn btn-danger btn-xs" href="'.$path.'/'.$obs['id'].'?action=delete" role="button"><i class="far fa-trash-alt"></i> Supprimer</a>
                    </td>';
                    
                    $table = $table . '</tr>';
                }
                
                $table = $table . 
                        '</tbody>
                    </table>
                </div>';
            }
            return $table;
        }

        public function generateTable2($name, $data, $path, $admin){
            
            $table = "";
            $model = $this->tables[$name];
         
            if (!isset($data) || !$data || count($data) == 0){
                $table = '<div class="alert alert-warning" role="alert">
                            Warning_Pas de données
                            </div>';
            } else {
                $table = '<table id="table" class="invisible table table-bordered table-sm display w-100" 
                            style="font-size:0.8rem;
                            white-space: nowrap;">
                            <thead>
                                <tr>';

                $table = $table . '<th scope="col">Actions</th>';
                
                foreach($data[0] as $key => $value){
                    if($key !== 'id' && $model[$key]['show']){
                        $table = $table . '<th scope="col">'. $model[$key]['name'] . '</th>';                        
                    }
                }

                
                $table = $table . '</tr></thead>';

                $table = $table . '<tbody>';
                
                foreach($data as $key => $obs){

                    $table = $table . '<tr>';
                    
                    if ($admin) {
                        $table = $table . 
                        '<td>
                            <a class="btn btn-primary btn-xs" href="'.$path.'/'.$obs['id'].'?action=edit" role="button"><i class="far fa-edit"></i></a>
                            <a id="deleteButton" class="btn btn-danger btn-xs" href="'.$path.'/'.$obs['id'].'?action=delete" role="button"><i class="far fa-trash-alt"></i></a>
                        </td>';
                    } else {
                        $table = $table . 
                        '<td>
                            <a class="btn btn-primary btn-xs" href="'.$path.'/'.$obs['id'].'?action=edit" role="button"><i class="far fa-edit"></i></a>
                            <a id="deleteButton" class="btn btn-danger btn-xs disabled" href="#" role="button"><i class="far fa-trash-alt"></i></a>
                        </td>';
                    }
                    

                    foreach($obs as $key => $value){
                        if($key !== 'id' && $model[$key]['show']){

                            

                            /**alignement */
                            $model[$key]['type'] === 1? $align = "tdTxt" : $align = "tdNb";
                            
                            if (($value == "0" || $value == "0%" || $value === null) && $model[$key]['type']===0) {$innerHtml = "-";} else {$innerHtml = $value;}
                            /*création de la données ac align, valeur et eventuellement gauge*/
                            $table = $table . '<td class="'. $align .'">'. $innerHtml .'</td>';
                        }
                    }
                    
                    
                    
                    $table = $table . '</tr>';
                }
                
                $table = $table . 
                        '</tbody>
                    </table>';
            }
            return $table;
        }

        public function generateForm($inputs = null , $actions = null, $data = null, $hiddenInput = null, $admin = FALSE, $pageType = null){        
            //var_dump($data);   

            !$admin && $pageType !== 'Profil'? $status = "disabled": $status = null;

            $form = null;
            $form = $form . '<form method="POST" action="'. $actions['form'] .'">';
            
            if($hiddenInput!==null){
                $form = $form . '<input type="hidden" name="'.$hiddenInput.'" value="'.$data[0][$hiddenInput].'">';
            }

            foreach($inputs as $key => $value){
                $attributes = $this->attributes[$key];

                switch($attributes['inputType']){
                    case 'number':

                        $inputValue = null;
                        
                        if ($data !== null){
                           
                            $inputValue = $data[0][$attributes['name']];
                        }

                        $placeholder = $attributes['default'];
                        
                        $form = $form . 
                        '<div class="form-group row">
                            <label for=' . $key . ' class="col-sm-2 col-form-label">' . $attributes['alias'] . '</label>
                            <div class="col-sm-10 ">
                                <input name="' . $key . '" type="text" class="form-control" id="'
                                . $key . '" placeholder="'.$placeholder.'" value="'.$inputValue.'" '. $status.'>
                            </div>
                        </div>'; 
                        break;
                    
                    case 'radio':
                        $checked0 = "";
                        $checked1 = "";

                        if ($data !== null) {

                            if ($data[0][$attributes['name']] == $value[1]['id']) {
                                $checked1 = 'checked';
                            } elseif ($data[0][$attributes['name']] == $value[0]['id']){
                                $checked0 = 'checked';
                            }
                        }
             
                        $form  = $form . 
                        '
                        <fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">' .$attributes['alias']. '</legend>
                                <div class="col-sm-10">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="'.$key.'" id="'.$key.'1" value="'.$value[0]['id'].'" '.$checked0.' '.$status.'>
                                        <label class="custom-control-label" for="'.$key.'1">
                                            '.$value[0]['nom'].'
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="'.$key.'" id="'.$key.'2" value="'.$value[1]['id'].'" '.$checked1.' '.$status.'>
                                        <label class="custom-control-label" for="'.$key.'2">
                                        '.$value[1]['nom'].'
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>';
                        break;
                    
                    case 'options':
                        
                        $inputOptions = '<option value="" disabled selected>'. $attributes['alias'].'</option>';

                        foreach ($value as $opt){
                            
                            if ($data !== null && $opt['id'] === $data[0][$attributes['name']]){
                                $inputOptions = $inputOptions . '<option value="' .$opt['id']. '"' . ' selected>' . $opt['nom'] . '</option>';
                                
                            } elseif ($data !== null && isset($data[0][$key]) && $opt['id'] === $data[0][$key]){
                                $inputOptions = $inputOptions . '<option value="' .$opt['id']. '"' . ' selected>' . $opt['nom'] . '</option>';
                                
                            } else {
                                $inputOptions = $inputOptions . '<option value="' .$opt['id']. '"' . '>' . $opt['nom'] . '</option>';                                
                            }
                        }
                    
                        $form = $form . 
                        '<div class="form-group row">
                            <label for=' . $key . ' class="col-sm-2 col-form-label">' . $attributes['alias'] . '</label>
                            <div class="col-sm-10">
                                <select class="form-control custom-select" name="'.$key.'" '.$status.'>' .
                                    $inputOptions .
                                '</select>
                            </div>
                        </div>';     
                        break;
                    
                    case 'area' : 
                        $inputValue = null;
                        
                        if ($data !== null){
                            if (isset($data[0][$attributes['name']])){
                                $inputValue = $data[0][$attributes['name']];
                            } else {
                                $inputValue = $data[0][$key];
                            }
                        }

                        $placeholder = $attributes['default'] ;
                        
                        $form = $form . 
                        '<div class="form-group row">
                        <label for=' . $key . ' class="col-sm-2 col-form-label">' . $attributes['alias'] . 
                        '</label>
                            <div class="col-sm-10">
                                <textarea '.$status.' name="' . $key . '" class="form-control" id="'. $key . '" placeholder="'.$placeholder.'">'. $inputValue .'</textarea>
                            </div>
                        </div>'; 
                        break;

                    case 'color':
                        
                        $inputValue = null;
                        
                        if ($data !== null){
                            if (isset($data[0][$attributes['name']])){
                                $inputValue = $data[0][$attributes['name']];
                            } else {
                                $inputValue = $data[0][$key];
                            }
                        }

                        $placeholder = $attributes['default'] ;
                        
                        $form = $form . 
                        '<div class="form-group row">
                        <label for=' . $key . ' class="col-sm-2 col-form-label">' . $attributes['alias'] . 
                        '</label>
                            <div class="col-sm-10">
                                <input '.$status.' name="' . $key . '" type="color" class="form-control" id="'. $key . '" placeholder="" value="'. $inputValue .'">
                            </div>
                        </div>';
                        break;
                    
                    case 'password':
                        
                        $inputValue = null;
                        
                        if ($data !== null){
                            if (isset($data[0][$attributes['name']])){
                                $inputValue = $data[0][$attributes['name']];
                            } else {
                                $inputValue = $data[0][$key];
                            }
                        }

                        $placeholder = $attributes['default'] ;
                        
                        $form = $form . 
                        '<div class="form-group row">
                        <label for=' . $key . ' class="col-sm-2 col-form-label">' . $attributes['alias'] . 
                        '</label>
                            <div class="col-sm-10">
                                <input '.$status.' name="' . $key . '" type="password" class="form-control" id="'. $key . '" placeholder="'.$placeholder.'" value="'. $inputValue .'">
                            </div>
                        </div>';
                        break;

                    case 'text': default: 

                        $inputValue = null;
                        
                        if ($data !== null){
                            if (isset($data[0][$attributes['name']])){
                                $inputValue = $data[0][$attributes['name']];
                            } else {
                                $inputValue = $data[0][$key];
                            }
                        }

                        $placeholder = $attributes['default'] ;
                        
                        $form = $form . 
                        '<div class="form-group row">
                        <label for=' . $key . ' class="col-sm-2 col-form-label">' . $attributes['alias'] . 
                        '</label>
                            <div class="col-sm-10">
                                <input '. $status .' name="' . $key . '" type="text" class="form-control" id="'. $key . '" placeholder="'.$placeholder.'" value="'. $inputValue .'">
                            </div>
                        </div>'; 
                        break;
                }      
            }

            /*if data delete button*/
            if ($data === null){
                $form = $form . 
                '<div class="form-group row">
                    <div class="col-sm-10">
                        <button ' .$status. ' id="modifyButton" type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Ok</button>
                        <a href="'. $actions['back'] . '" role="button" class="btn btn-primary btn-sm"><i class="fas fa-undo-alt"></i> Retour</a>
                    </div>
                </div>
            </form>';
            } elseif ($data !== null && isset($actions['delete'])) {
                $form = $form . 
                '<div class="form-group row">
                    <div class="col-sm-10">
                        <button '.$status.' id="modifyButton" type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Ok</button>
                        <a href="'. $actions['delete'] . '" role="button" class="btn btn-danger btn-sm '. $status .'"><i class="far fa-trash-alt"></i> Supprimer</a>                        
                        <a href="'. $actions['back'] . '" role="button" class="btn btn-primary btn-sm"><i class="fas fa-undo-alt"></i> Retour</a>
                        </div>
                    </div>
                </form>';
            } else {
                $form = $form . 
                '<div class="form-group row">
                    <div class="col-sm-10">
                        <button '.$status.' id="modifyButton" type="submit" class="btn btn-success btn-sm"><i class="fas fa-check"></i> Ok</button>
                        <a href="'. $actions['back'] . '" role="button" class="btn btn-primary btn-sm"><i class="fas fa-undo-alt"></i> Retour</a>
                    </div>
                </div>
            </form>';
            }

            

            $form = $form . '</form>';
            return $form;

            
        }

        public function generateNavbar($active, $user){
            
            $user['level'] === 1? $status = null: $status = "disabled";
            $status === null? $href = "/web/utilisateurs?action=show" : $href = "#";

            $nav =     
            '<nav class="navbar fixed-top navbar-expand-lg navbar-dark shadow" style="background-color:'. $user['color'] . '">
            <div class="container-fluid">
            <a class="navbar-brand" style="font-family: \'Fugaz One\', cursive;" href="/web/accueil">
            <i class="fas fa-lg fa-cube"></i>
              Admin-Sde
            </a> 
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav mr-auto">
            

                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Entités
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  
                  <a href="/web/formations?action=show" class="dropdown-item">Formations</a>
                  <a href="/web/enseignants?action=show" class="dropdown-item">Enseignants</a>
                  <a href="/web/enseignements?action=show" class="dropdown-item">Enseignements</a>
                  <a href="/web/cours?action=show" class="dropdown-item">Cours</a>
                       
                </div>
              </li>
              
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Référentiels
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    
                    <a href="/web/referentiels/diplomes?action=show" class="dropdown-item">Diplômes</a>
                    <a href="/web/referentiels/types?action=show" class="dropdown-item">Types de cours</a>
                    <a href="/web/referentiels/statuts?action=show" class="dropdown-item">Statuts Enseignant</a>
                         
                  </div>
                </li>
    
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle '.$status.'" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Routines
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <a href="/web/routines/nvelleannee" class="dropdown-item">Nouvelle année</a>      
                </div>
                </li>
                <li class="nav-item">
                <a href="'.$href.'" class="nav-link '. $status .'">Utilisateurs</a>
                </li>
                </ul>
              
                <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user"></i> '. $user['name'] .'
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                      <a href="/web/profil" class="dropdown-item">Mon profil</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="/web/auth?action=quit"><i class="fas fa-power-off"></i> Déconnexion</a>
                      </div>
                  </li>
                  
                </ul>
            </div>
          </div>
          </nav>';

          $nav = preg_replace('/">'. $active . '/', ' active">'. $active, $nav);
          return $nav;
        
        }

        public function generateScript($data){
            echo '<script>';
            echo 'var data = ' . json_encode($data) . ';';
            echo '</script>';
        }

        public function generateMessage($message){
            if ($message){
                if ($message['status'] == 'success'){
                    return '<div class="alert alert-success alert-dismissible fade show" role="alert"><i class="far fa-check-circle fa-lg"></i> '
                    .$message['message'].
                    '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>';
                }
                return '<div class="alert alert-danger alert-dismissible fade show" role="alert"><i class="fas fa-exclamation-circle fa-lg"></i> '
                        .$message['message'].
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>';
            }
            return "";
        }

        public function generateTitle($str){
            
            return '<h4 class="mb-4"> ' . $str . '</h4>';
                    
        }
}
?>