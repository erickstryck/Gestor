<?php
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'ProdutosView.php'); 

class Produtos extends GenericController {
	private $produtosView; 

	public function __construct() {
		$this->produtosView = new ProdutosView(); 
	}

	public function novoProdutoView(){
		$this->produtosView->novoProdutoView(); 
	}

	public function cadastro( $arg){
		Lumine::import("Produto"); 
		Lumine::import("CategoriaHasProduto");

		$produto = new Produto(); 

		$produto->naoControlarEstoque = (empty($arg['naoControlarEstoque'])) ? false : true ;
		$produto->arquivar            = (empty($arg['arquivar'])) ? false : true ;

		$produto->precoCusto = $arg['precoCusto'];
		$produto->precoVenda = $arg['precoVenda'];
		$produto->eanGtin = $arg['eanGtin'];
		$produto->excecaoIpi = $arg['excecaoIpi'];
		$produto->estoqueMinimo = $arg['estoqueMinimo'];
		$produto->palavraChave = $arg['palavraChave'];
		$produto->ncm = $arg['ncm'];
		$produto->anotacoesInternas = $arg['anotacoesInternas'];
		$produto->nome = $arg['nome'];
		$produto->codigoPersonalizado = $arg['codigoPersonalizado'];
		$produto->margemLucro = $arg['margemLucro'];
		$produto->inforNfe = $arg['inforNfe'];

		//Apenas iniciando o estoque atual com zero. 
		$produto->estoqueAtual = 0; 

		//associando produto a empresa corrente da sessão. 
		$produto->empresaId = $_SESSION['empresaId'];
		$produto->insert(); 

		if( $arg['categoriaId'] != ""){
			$associativa = new CategoriaHasProduto(); 
			$associativa->produtoId = $produto->id; 
			$associativa->categoriaId = (int) $arg['categoriaId'];

			$associativa->insert(); 
		}
		
		//Em formato JSON, envie se a execução da inserção foi bem sucedida. 
		$this->produtosView->sendAjax(array('status' => true) ); 
	}

	public function delete($arg){
		Lumine::import("Produto"); 
		$produto = new Produto(); 
		$produto->get((int) $arg['id']);

		//Desativando o registro no banco. 
		$produto->ativo = 0;  
		$produto->update(); 

		$this->produtosView->sendAjax(array('status' => true, 'msg' => $arg['id'])); 
	}
}