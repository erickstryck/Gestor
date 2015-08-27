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

	public function cadastroPagamento($arg){
	 	//Depois tratar a entrada de dados aqui. 
	 	Lumine::import("Conta"); 
	 	$conta = new Conta(); 
	 	$conta = self::casdatra($conta); 

	 	//registrando se a conta já 
	 	$conta->paga = (empty($arg['pagar_agora']) ? 1 : 0 ); 
	 	$conta->receber = 0;// Essa conta não é para receber, então adiciona-se 0 sinalizando que é para pagamento.  
	}

	private function cadastra($conta , $arg){
		$conta->descricao  			= $arg['descricao']; 
		$conta->dataLancamento  	= $arg['data_lacamento']; 
		$conta->dataVencimento  	= $arg['data_vencimento']; 
		$conta->valor  				= $arg['valor_cobrado']; 
		$conta->isCaixaInterno  	= ( (strcmp($arg['is_caixa_interno'],'1') == 0)  ? 1 : 0 ); 
		$conta->numeroDocumento  	= $arg['numero_documento']; 
		$conta->apenasPrevisao  	= !empty($arg['apenas_previsao']); 
		$conta->pagarAgora  		= !empty($arg['pagar_agora']); 
		$conta->observacoes  		= $arg['observacoes']; 
		$conta->palavraChave  		= $arg['palavra_chave']; 
		$conta->empresaId  			= $_SESSION['empresa_id']; 
		$conta->cadastraVezesId 	= $arg['cadastrar_vezes_id']; 
		$conta->planoContaId  		= $arg['plano_conta_id']; 
		$conta->intervaloId  		= $arg['intervalo_id']; 
		$conta->contatoId  			= $arg['contato_id']; 

		$conta->valorPagamento  	= $arg['valor_pagamento']; 
		$conta->dataPagamento 		= $arg['data_pagamento']; 

		$conta->tipoDocumentoId  	= $arg['tipo_documento_id'];

		return $conta;  
	}

}
