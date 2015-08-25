<?php
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'ContasView.php'); 

class Contas extends GenericController {
	private $contasView; 

	public function __construct() {
		$this->contasView = new ContasView(); 
	}

	// Isso aqui é uma fachada
	public function novoPagamentoView(){
		$this->contasView->novoPagamentoView(); 
	}

	public function cadastro($arg){
		echo("Eu entrei na função de cadastro do pagamento"); 
	}

}
