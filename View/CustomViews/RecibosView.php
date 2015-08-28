<?php
require_once(PATH.'View'.DS.'GenericView.php'); 
require_once(PATH.'Util'.DS.'Convert.php'); 

class RecibosView extends GenericView{
	
	public function __construct(){
		parent::__construct($this); 
	}

	public function novoReciboView(){
		parent::getTemplateByAction('recibo');
		Lumine::import("Contato"); 
		//Pegando os contatos da empresa da sessão corrente: 
		$contato = new Contato(); 
		$contato->where("empresa_id = ". $_SESSION['empresa_id'])->find(); 

		while($contato->fetch()){
			parent::$templator->setVariable('nome', $contato->nomeFantasia); 
			parent::$templator->addBlock('contato'); 
		}


		//Colocando a data atual: 
		parent::$templator->setVariable('data_now', date('Y-m-d')); 
		parent::show(); 
	}
}