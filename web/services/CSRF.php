<?php
    
    class CSRF{

        public function generateToken(){

            if(isset($_SESSION)){
                $_SESSION['token'] = bin2hex(random_bytes(32));
                return $_SESSION['token'];
            }
            throw new Exception('500');
        }
        
        public function verifyToken(){

            if (!hash_equals($_SESSION['token'], $_POST['csrf'])){
                throw new Exception('400');                
            }

            unset($_POST['csrf']);
        }
    }
?>