<?php
class Messenger {

    public function push($message){
        if (isset($_SESSION)) $_SESSION['message'] = $message;
    }

    public function pop(){
        $message = null;
        if (isset($_SESSION) && isset($_SESSION['message'])){
            $message = $_SESSION['message'];
            unset($_SESSION['message']);
            return $message;
        }
        return FALSE;
    }
}
?>