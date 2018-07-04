<?php
    
    class CSRF{
        public function generateToken(){

            if (isset($_SESSION) && !isset($_SESSION['token'])) {
                $_SESSION['token'] = bin2hex(random_bytes(32));
                return $_SESSION['token'];
            }
            return $_SESSION['token']; 
        }
        
        public function verifyToken(){

            if (hash_equals($_SESSION['token'], $_POST['csrf'])){
                unset($_SESSION['token']);
                unset($_POST['csrf']);
                return TRUE;
            }
            unset($_SESSION['token']);
            unset($_POST['csrf']);
            return FALSE;
        }
    }
?>