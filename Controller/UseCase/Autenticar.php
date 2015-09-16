<?php
require_once(PATH . 'Controller' . DS . 'GenericController.php');
require_once(PATH . 'View' . DS . 'CustomViews' . DS . 'AutenticarView.php');

class Autenticar extends GenericController{
    private $autenticarView;

    public function __construct(){
        $this->autenticarView = new AutenticarView();
    }

    public function loginView(){
        $this->autenticarView->loginView();
    }

    public function login($arg){
        
    }

}