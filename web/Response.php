<?php
class Response {

    public function render($view, $props){
        include_once('view/'.$view.'View.php');
        die();
    }

    public function force400(){
        header("HTTP/1.1 400 Bad request");
        die();
    }

    public function force401(){
        header("HTTP/1.1 401 Unauthorized");
        die();
    }

    public function force403(){
        /*$this->title = '403 | Forbidden';
        $this->content = '<h1>403 Forbidden</h1>';    
        $this->style = '<link href="/web/static/css/style.css" rel="stylesheet"/>';
        $this->script = null;
        
        include('view/template.php');*/
        header('HTTP/1.1 403 Forbidden');
        die();
    }

    public function force404(){
        $this->title = '404 | Not Found';
        $this->content = '<h1>404 Not found</h1>';    
        $this->style = '<link href="/web/static/css/style.css" rel="stylesheet"/>';
        $this->script = null;
        header('HTTP/1.1 404 Not Found');
        include('view/template.php');
        die();
    }
}
?>