<?php
//Configurando a data e hora do servidor: 
date_default_timezone_set('America/Sao_Paulo');

//Criar um arquivo para definições mais tarde. 
define('WWW_ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
define('PATH', WWW_ROOT . DS);
require(WWW_ROOT . DS . 'Persistence' . DS . 'Lumine.php');
require(WWW_ROOT . DS . 'Persistence' . DS . 'lumine-conf.php');
require_once(PATH . 'Controller' . DS . 'MainController.php');
Firewall::filtro();
$cfg = new Lumine_Configuration($lumineConfig);

//Indicando que este script usará sessões em algum momento em sua execução. 
session_start();

//ADICIONANDO O VALOR DO USER_ID SEMPRE EM UM, PELO FATO DE NÃO EXISTIR SISTEMA DE LOGIN AINDA. 
$_SESSION['empresaId'] = 1; //Referencia ao usuário admin que está cadastrado no banco de dados. 

//require_once( WWW_ROOT . DS . 'autoload.php'); 


//(new SecurityFilter())->filteringRequest(); 

//var_dump($_REQUEST); 

if (empty($_REQUEST['uc']) || empty($_REQUEST['a'])) {
    $_REQUEST['uc'] = 'home';
    $_REQUEST['a'] = 'indexView';
}

$_SESSION['Permissao'] = array('administrador');
(new MainController())->findMyController();

//Ainda em digivolvimento
//$mail = new Mail(); 

//$mail->sendEmail("Apenas um texto simples aqui","bsinet@hotmail.com", "Allyson Maciel"); 

