<?php  
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'OrdemServicoView.php'); 
class OrdemServico extends GenericController{
	private $ordemServicoView; 

	function __construct(){
		$this->ordemServicoView = new OrdemServicoView(); 
	}	

	public function cadastro($arg){
		var_dump($arg); 
	}


	public function novaOrdemView(){
		$this->ordemServicoView->novaOrdemView(); 
	}
}