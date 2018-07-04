<?php

include_once('model/Model.php');

/*je crois que ce service est inutile car j'ai essayer de poster des balises etc, 
ça passe pas => c'est bootsrap qui fait le boulot*/

class Sanitizer{

    public function filter(){

        foreach($_POST as $key => $value){
    
            switch(Model::$inputs[$key]['inputType']){
                
                case 'number':
                    /*si c'est un float (pas un int)*/
                    if (Model::$inputs[$key]['type'] !== PDO::PARAM_INT){
                        /*incompréhensible mais il faut mettre le flag sinon il enlève les points....???*/
                        $_POST[$key] = filter_var($value, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    } else {
                        $_POST[$key] = filter_var($value, FILTER_SANITIZE_NUMBER_INT);
                    }
                    break;

                case 'email':
                    break;
                    $_POST[$key] = filter_var($value, FILTER_SANITIZE_EMAIL);
                
                case 'text': case 'area': case 'password':
                    $_POST[$key] = filter_var($value, FILTER_SANITIZE_STRING);
                    break;
                /*tout le reste cbon*/
                default : break; 
            }
        }        
    }
}
?>