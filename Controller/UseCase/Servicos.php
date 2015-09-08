<?php
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'ServicosView.php'); 

class Servicos extends GenericController {
	private $servicosView; 

	public function __construct() {
		$this->servicosView = new ServicosView(); 
	}

	public function novoServicoView(){
		$this->servicosView->novoServicoView(); 
	}

	public function cadastro($arg){
		//Roteiro: 
		//Validar os dados que estão vindo da visão ( fazer isso depois )
		//Armazenar os dados no banco
		//Enviar confirmação de sucesso ou falha via JSON.
		Lumine::import("Servico"); 
		$servico = new Servico(); 

		$servico->nomeServico = $arg['nome_servico']; 
		$servico->preco = $arg['preco']; 
		$servico->palavraChave = $arg['palavra_chave']; 
		$servico->empresaId = $_SESSION['empresa_id']; 

		$servico->insert(); 
		//Enviar essa linha apenas se tudo acima estiver sido feito corretamente. 
		$this->servicosView->sendAjax(array('status' => true) );
	}

	public function deletar($arg){
		Lumine::import("Servico"); 
		$Servico = new Servico(); 
		$Servico->get((int) $arg['id']);

		//Desativando o registro no banco. 
		$Servico->ativo = 0;  
		$Servico->update(); 

		$this->servicosView->sendAjax(array('status' => true, 'msg' => $arg['id'])); 
	}

}
