<?php
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'ContasView.php'); 

class Contas extends GenericController {
	private $contasView; 

	public function __construct() {
		$this->contasView = new ContasView(); 
	}

	// Isso aqui é uma fachada
	/**
     * @Permissao({"administrador"})
     */
	public function novoPagamentoView(){
		$this->contasView->novoPagamentoView(); 
	}

	// Isso aqui é uma fachada
	/**
     * @Permissao({"administrador"})
     */
	public function novoRecebimentoView(){
		$this->contasView->novoRecebimentoView(); 
	}

	/**
     * @Permissao({"administrador"})
     */
	public function cadastroPagamento($arg){
	 	//Depois tratar a entrada de dados aqui.
		Lumine::import("Conta"); 
		$conta = new Conta(); 
		$conta = self::cadastra($conta,$arg); 

	 	//registrando se a conta já 
		$conta->paga = (!empty($arg['paga']))? 1 : 0; 
	 	$conta->receber = 0;// Essa conta não é para receber, então adiciona-se 0 sinalizando que é para pagamento.  
	 	$conta->insert(); 

	 	$this->contasView->sendAjax(array('status' => true) ); 
	 }

	 /**
     * @Permissao({"tecnico"})
     */
	 public function alteraPagamento($arg){
	 	//Depois tratar a entrada de dados aqui.
	 	Lumine::import("Conta"); 
	 	$conta = new Conta(); 
	 	$conta->where('empresa_id = '. $_SESSION['empresaId'].' and id = '. (int) $arg['id'])->find(); 
	 	$conta->fetch(true); 

	 	$conta = self::cadastra($conta,$arg); 

	 	//registrando se a conta já 
	 	$conta->paga = (!empty($arg['paga']))? 1 : 0; 
	 	$conta->receber = 0;// Essa conta não é para receber, então adiciona-se 0 sinalizando que é para pagamento.  
	 	$conta->update(); 

	 	$this->contasView->sendAjax(array('status' => true) ); 
	 }

	 /**
     * @Permissao({"administrador"})
     */
	 public function cadastroRecebimento($arg){
	 	//Depois tratar a entrada de dados aqui.
	 	Lumine::import("Conta"); 
	 	$conta = new Conta(); 
	 	$conta = self::cadastra($conta,$arg); 

	 	//registrando se a conta já 
	 	$conta->paga = (!empty($arg['paga']))? 1 : 0; 
	 	$conta->receber = 1;// Essa conta não é para receber, então adiciona-se 0 sinalizando que é para pagamento.  
	 	$conta->insert(); 

	 	$this->contasView->sendAjax(array('status' => true) ); 
	 }

	 /**
     * @Permissao({"administrador"})
     */
	 public function alteraRecebimento($arg){
	 	//Depois tratar a entrada de dados aqui.
	 	Lumine::import("Conta"); 
	 	$conta = new Conta(); 
	 	$conta->where('empresa_id = '. $_SESSION['empresaId'].' and id = '. (int) $arg['id'])->find(); 
	 	$conta->fetch(true); 

	 	$conta = self::cadastra($conta,$arg); 

	 	//registrando se a conta já 
	 	$conta->paga = (!empty($arg['paga']))? 1 : 0; 
	 	$conta->receber = 1;// Essa conta não é para receber, então adiciona-se 0 sinalizando que é para pagamento.  
	 	$conta->update(); 

	 	$this->contasView->sendAjax(array('status' => true) ); 
	 }

	 /**
     * @Permissao({"administrador"})
     */
	 public function delete ($arg){
	 	$id = (int) $arg['id']; 
	 	Lumine::import("Conta"); 
	 	$conta = new Conta(); 

	 	$conta->where('empresa_id = '. $_SESSION['empresaId'].' and id = '. (int) $arg['id'])->find(); 
	 	$conta->fetch(true); 

	 	$conta->ativo = 0; 
	 	$conta->update(); 

	 	$this->contasView->sendAjax(array('status' => true) ); 

	 }


	 /**
     * @Permissao({"administrador"})
     */
	 private function cadastra($conta , $arg){
	 	$conta->descricao  			= $arg['descricao']; 
	 	$conta->dataLancamento  	= $arg['dataLancamento'];
	 	$conta->dataVencimento  	= $arg['dataVencimento'];
	 	$conta->valor  				= $arg['valor'];
	 	$conta->recipienteId        = (int) $arg['recipienteId']; 
	 	$conta->numeroDocumento  	= $arg['numeroDocumento'];
	 	$conta->apenasPrevisao  	= !empty($arg['apenasPrevisao']);
	 	$conta->pagarAgora  		= !empty($arg['pagarAgora']);
	 	$conta->observacoes  		= $arg['observacoes']; 
	 	$conta->palavraChave  		= $arg['palavraChave'];
	 	$conta->empresaId  			= $_SESSION['empresaId']; 
	 	$conta->cadastrarVezesId 	= $arg['cadastrarVezesId'];
	 	$conta->planoContaId  		= $arg['planoContaId'];
	 	$conta->intervaloId  		= $arg['intervaloId'];
	 	$conta->contatoId  			= $arg['contatoId'];

	 	$conta->valorPagamento  	=  (empty($arg['valorPagamento']))? null  : $arg['valorPagamento'];
	 	$conta->dataPagamento 		=  (empty($arg['dataPagamento'])) ? null : $arg['dataPagamento'];

	 	$conta->tipoDocumentoId  	= $arg['tipoDocumentoId'];

	 	return $conta;  
	 }


	 /**
     * @Permissao({"administrador"})
     */
	 public function getObject($arg){
	 	$id = (int) $arg['id']; 
	 	Lumine::import("Conta"); 
	 	$conta = new Conta(); 
	 	$conta->where('empresa_id = '. $_SESSION['empresaId'].' and id = '. (int) $arg['id'])->find(); 
	 	$conta->fetch(true);  

	 	$this->contasView->sendAjax($conta->toArray()); 
	 }

}
