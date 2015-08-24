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

		$produto->naoControlarEstoque = (empty($arg['nao_controlar_estoque'])) ? false : true ; 
		$produto->arquivar            = (empty($arg['arquivar'])) ? false : true ;

		$produto->precoCusto = $arg['preco_custo'];
		$produto->precoVenda = $arg['preco_venda'];
		$produto->eanGtin = $arg['ean_gtin'];
		$produto->excecaoIpi = $arg['excecao_ipi'];
		$produto->estoqueMinimo = $arg['estoque_minimo'];
		$produto->palavraChave = $arg['palavra_chave'];
		$produto->ncm = $arg['ncm'];
		$produto->anotacoesInternas = $arg['anotacoes_internas'];
		$produto->nome = $arg['nome'];
		$produto->codigoPersonalizado = $arg['codigo_personalizado'];
		$produto->margemLucro = $arg['margem_lucro'];
		$produto->inforNfe = $arg['infor_nfe'];

		//Apenas iniciando o estoque atual com zero. 
		$produto->estoqueAtual = 0; 

		//associando produto a empresa corrente da sessão. 
		$produto->empresaId = $_SESSION['empresa_id'];
		$produto->insert(); 

		if( $arg['categoria_id'] != ""){
			$associativa = new CategoriaHasProduto(); 
			$associativa->produtoId = $produto->id; 
			$associativa->categoriaId = (int) $arg['categoria_id'];

			$associativa->insert(); 
		}
		
		//Em formato JSON, envie se a execução da inserção foi bem sucedida. 
		$this->produtosView->sendAjax(array('status' => true) ); 
	}
}