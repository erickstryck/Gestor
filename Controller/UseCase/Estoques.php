<?php
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'EstoquesView.php'); 

class Estoques extends GenericController {
	private $estoquesView; 

	public function __construct() {
		$this->estoquesView = new EstoquesView(); 
	}

	public function novoAjusteView(){
		$this->estoquesView->novoAjusteView(); 
	}

	public function cadastro($arg){
		//Roteiro: 
		//Validar os dados que estão vindo da visão ( fazer isso depois )
		//Armazenar os dados no banco
		//Enviar confirmação de sucesso ou falha via JSON.
		Lumine::import("Produto"); 
		Lumine::import("MudancaEstoque"); 
		Lumine::import("MudancaEstoqueHasContato"); 

		$produto = new Produto; 

		$produto->get('id', $arg['produto_id']); 

		$mudanca = new MudancaEstoque(); 

		$mudanca->dataMudanca   = date('Y-m-d H:i');
		$mudanca->obsGerais     = $arg['obsGerais'];
		$mudanca->tipoAjusteId  = $arg['tipoAjusteId'];
		$mudanca->produtoId     = $produto->id; 
		$mudanca->estoqueAntigo = $produto->estoqueAtual; 

		$novoEstoque = (int) $arg['val_alteracao']; 

		$mudanca->estoqueNovo   = $novoEstoque; 
		$mudanca->insert(); 

		$produto->estoqueAtual  = $novoEstoque; 
		$produto->update(); 

		if(!empty($arg['contatoId'])){
			//Associativa de mudança a um contato
			$associativa                   = new MudancaEstoqueHasContato(); 
			$associativa->contatoId        = (int) $arg['contatoId'];
			$associativa->mudancaEstoqueId = $mudanca->id;
			$associativa->insert();  
			
		}

		//Enviar essa linha apenas se tudo acima estiver sido feito corretamente. 
		$this->estoquesView->sendAjax(array('status' => true) );
	}

}
