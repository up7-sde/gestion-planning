<?php
    
    class CSRF{

        public function generateToken(){

            $_SESSION['token'] = bin2hex(random_bytes(32));
            return $_SESSION['token'];
            
        }
        
        public function verifyToken(){

            if (hash_equals($_SESSION['token'], $_POST['csrf'])){
                unset($_POST['csrf']);
                return TRUE;
            }
            unset($_POST['csrf']);
            return FALSE;
        }
    }
?>