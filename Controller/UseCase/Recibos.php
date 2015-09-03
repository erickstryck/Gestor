<?php
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'RecibosView.php'); 

require_once(PATH.'Library'.DS.'dompdf'.DS.'dompdf_config.inc.php'); 
require_once(PATH.'Library'.DS.'MiniTemplator.php'); 

class Recibos extends GenericController {
	private $recibosView; 

	public function __construct() {
		$this->recibosView = new RecibosView(); 
	}

	public function novoReciboView(){
		$this->recibosView->novoReciboView(); 
	}

	public function cadastro($arg){
		Lumine::import("Recibo"); 

		$recibo = new Recibo(); 

		$recibo->viasId       = $arg['vias_id']; 
		$recibo->emissor      = $arg['emissor'];
		$recibo->valorPago    = $arg['valor_pago']; 
		$recibo->recebidoDe   = $arg['recebi_de']; 
		$recibo->cpfCnpj      = $arg['cpf_cnpj']; 
		$recibo->dataRecibo   = $arg['data_recibo']; 
		$recibo->referente    = $arg['referente']; 
		$recibo->empresaId    = $_SESSION['empresa_id']; 

		//procurando o id do contato para fazer a associação: 
		// Lumine::import("Contato"); 
		// $contato = new Contato(); 

		// $total = $contato->get('nomeFantasia', $arg['recebi_de']); 

		// if($total > 0 ){
		// 	$recibo->contatoId = $contato->id; 
		// }else{
		// 	$recibo->contatoId = null; 
		// }

		$recibo->insert(); 

		$this->recibosView->sendAjax(array('status' => true)); 

	}

	public function gerarRecibo($arg){
		$pdf = new DOMPDF(); 


		var_dump($arg); 	

	}

}
