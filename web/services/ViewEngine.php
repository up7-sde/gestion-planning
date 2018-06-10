<?php
class ViewEngine {
        public function __construct(){
            $this->attributes = Model::$attributes;
        }

        public function generateTable($data, $path){
            
            $table = "";

            if (!isset($data) || !$data || count($data) == 0){
                $table = '<div class="alert alert-warning" role="alert">
                            Pas de données-tableau vide
                        </div>';
            } else {
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
            }
            return $table;
        }

        public function generateForm($inputs, $actions = array('form'=>'/web', 'back' => '/web'), $data=null, $hiddenInput = null){        
            //var_dump($data);   
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
                            <div class="col-sm-10">
                                <input name="' . $key . '" type="number" class="form-control" id="'
                                . $key . '" placeholder="'.$placeholder.'" value="'.$inputValue.'">
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
                        '<fieldset class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-2 pt-0">' .$attributes['alias']. '</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="'.$key.'" id="'.$key.'" value="'.$value[0]['id'].'" '.$checked0.'>
                                        <label class="form-check-label" for="gridRadios1">
                                            '.$value[0]['nom'].'
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="'.$key.'" id="'.$key.'" value="'.$value[1]['id'].'" '.$checked1.'>
                                        <label class="form-check-label" for="gridRadios2">
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
                                <select class="form-control" name="'.$key.'">' .
                                    $inputOptions .
                                '</select>
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

                        $placeholder = $attributes['alias'] ;
                        
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

        public function generateMessage($message){
            if ($message){
                if ($message['status'] == 'success'){
                    return '<div class="alert alert-success" role="alert">'
                    .$message['message'].
                    '</div>';
                }
                return '<div class="alert alert-danger" role="alert">'
                        .$message['message'].
                        '</div>';
            }
            return "";
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
                style="padding-top:36px;">
                <h2 style="padding:0;margin:0">'. $str. '</h2>
                '.$btn.'
            </div><hr/>';
    
            return $title;
        }
}
?>