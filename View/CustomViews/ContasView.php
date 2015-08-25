<?php
require_once(PATH.'View'.DS.'GenericView.php'); 
require_once(PATH.'Util'.DS.'Convert.php'); 

class ContasView extends GenericView{
	
	public function __construct(){
		parent::__construct($this); 
	}

	public function novoPagamentoView(){
		parent::getTemplateByAction('contasPagar'); 
		parent::show(); 
	}


}