<?php
require_once(PATH . 'View' . DS . 'GenericView.php');
require_once(PATH . 'Util' . DS . 'Convert.php');

class AutenticarView extends GenericView
{

    public function __construct()
    {
        parent::__construct($this);
    }

    public function loginView($arg){
        parent::getTemplateByAction('login');
        if(!empty($arg['done'])){
        	parent::$templator->setVariable('is_hide',''); 
        	parent::$templator->setVariable('msg','Seu cadastro foi feito com sucesso. Efetue o login com o seu nome de usuário e senha.'); 
        }else{
        	parent::$templator->setVariable('is_hide','hide'); 
        }
        parent::show();
    }
}