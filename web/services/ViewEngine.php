<?php
class ViewEngine {
        public function __construct(){
            $this->attributes = Model::$attributes;
        }

        public function generateTable($data, $path){
            
            $table = '<div class="table-responsive">
                        <table class="table table-bordered">
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
                    $table = $table . '<td>'. $value .'</td>';
                }
                
                $table = $table . 
                '<td>
                    <a class="btn btn-primary" href="'.$path.'/'.$obs['id'].'?action=edit" role="button"><i class="far fa-edit"></i> Modifier</a>
                    <a class="btn btn-danger" href="'.$path.'/'.$obs['id'].'?action=delete" role="button"><i class="far fa-trash-alt"></i> Supprimer</a>
                </td>';
                
                $table = $table . '</tr>';
            }
            
            $table = $table . 
                    '</tbody>
                </table>
            </div>';
            
            return $table;
        }

        public function generateForm($inputs, $actions = array('form'=>'/web', 'back' => '/web'), $data=null){        
            
            $form = null;
            $form = $form . '<form method="POST" action="'. $actions['form'] .'">';
            
            foreach($inputs as $key => $value){
                $attributes = $this->attributes[$key];

                switch($attributes['inputType']){
                    case 'number':
                        $placeholder = $attributes['default'];
                        $inputValue = $attributes['default'];

                        $form = $form . 
                        '<div class="form-group row">
                            <label for=' . $key . ' class="col-sm-2 col-form-label">' . $attributes['alias'] . '</label>
                            <div class="col-sm-10">
                                <input name="' . $key . '" type="number" class="form-control" id="'
                                . $key . '" placeholder="'.$placeholder.'" value="'.$placeholder.'">
                            </div>
                        </div>'; 
                        break;
                    
                    case 'radio':
                        $form  = $form . 
                        '<fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">' .$attributes['alias']. '</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="'.$key.'" id="'.$key.'" value="'.$value[0]['id'].'">
                                        <label class="form-check-label" for="gridRadios1">
                                            '.$value[0]['nom'].'
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="'.$key.'" id="'.$key.'" value="'.$value[1]['id'].'">
                                        <label class="form-check-label" for="gridRadios2">
                                        '.$value[1]['nom'].'
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>';
                        break;
                    
                    case 'options':
                        $placeholder = $attributes['alias'] ;
                        $inputValue = $attributes['default'];

                        $inputOptions = '<option value="" disabled selected>'. $attributes['alias'].'</option>';

                        foreach ($value as $opt){
                            $inputOptions = $inputOptions . '<option value="' .$opt['id']. '"' . '>' . $opt['nom'] . '</option>';
                        }
                    
                        $form = $form . 
                        '<div class="form-group row">
                            <label for=' . $key . ' class="col-sm-2 col-form-label">' . $attributes['alias'] . '</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="'.$key.'">' .
                                    $inputOptions .
                                '</select>
                            </div>
                        </div>';     
                        break;
                    
                    case 'text': default: 
                        $placeholder = $attributes['alias'] ;
                        $inputValue = $attributes['default'];
                        
                        $form = $form . 
                        '<div class="form-group row">
                        <label for=' . $key . ' class="col-sm-2 col-form-label">' . $attributes['alias'] . 
                        '</label>
                            <div class="col-sm-10">
                                <input name="' . $key . '" type="text" class="form-control" id="'. $key . '" placeholder="'.$placeholder.'" value="'. $inputValue .'">
                            </div>
                        </div>'; 
                        break;
                }      
            }
            $form = $form . 
                '<div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Ok</button>
                        <a href="'. $actions['back'] . '" role="button" class="btn btn-primary"><i class="fas fa-undo-alt"></i> Retour</a>
                    </div>
                </div>
            </form>';

            $form = $form . '</form>';
            return $form;
        }

        public function generateNavbar($user = null, $active = null){

        }

        public function generateTitle($str, $button = null){
            
            $btn = "";

            if ($button['icon'] === 'delete') {
                $btn = '<a class="btn btn-danger" href="'. $button['action'] .'" role="button"><i class="far fa-trash-alt"></i> Supprimer</a>';
            } elseif ($button['icon'] === 'add') {
                $btn = '<a class="btn btn-success" href="'. $button['action'] .'" role="button"><i class="fas fa-plus"></i>  Ajouter</a>';
            }
            $title = 
            '<div class="btn-toolbar justify-content-between" role="toolbar" 
                aria-label="Toolbar with button groups"
                style="padding-top:60px;">
                <h4>'. $str. '</h4>
                '.$btn.'
            </div><hr/>';
    
            return $title;
        }
}

/*

<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Enseignement</label>
  <div class="col-md-4">
    <select id="apogee" name="apogee" class="form-control">
      <?php
        foreach ($labelEnseignement as $e) { ?>
        <option name="apogee" value="<?= $e["id"] ?>"
          <?php
          // S'il y a des données (dans le cas d'une modification)
          if (isset($data))
          {
            // Selectionner le bon élément
            if ($e["id"] == $data["Enseignement_apogee"])
            {
              echo ' selected';
            }
          }
        ?>>
          <?= $e["nom"]?>
        </option>
      <?php } ?>
    </select>
  </div>
</div>

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


<form>
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
            </div>
          </div>
          <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
            </div>
          </div>

          <fieldset class="form-group">
            <div class="row">
              <legend class="col-form-label col-sm-2 pt-0">Radios</legend>
              <div class="col-sm-10">
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                  <label class="form-check-label" for="gridRadios1">
                    First radio
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                  <label class="form-check-label" for="gridRadios2">
                    Second radio
                  </label>
                </div>
              </div>
            </div>
          </fieldset>

          <div class="form-group row">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-success"><i class="fas fa-check"></i> Ok</button>
              <button type="submit" class="btn btn-primary"><i class="fas fa-undo-alt"></i> Retour</button>
            </div>
          </div>
        </form>
  */  
?>