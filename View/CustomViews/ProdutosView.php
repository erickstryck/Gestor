<?php
require_once(PATH.'View'.DS.'GenericView.php'); 
require_once(PATH.'Util'.DS.'Convert.php'); 

class ProdutosView extends GenericView{
	
	public function __construct(){
		parent::__construct($this); 
	}

	public function novoProdutoView(){
		parent::getTemplateByAction('novoProduto'); 
		Lumine::import("Categoria");
		Lumine::import("CategoriaHasProduto");  
		Lumine::import("Produto"); 

		$produto = new Produto(); 
		$produto->where(" empresa_id = ". $_SESSION['empresaId']." and ativo = 1")->find(); 

		while($produto->fetch()){
			parent::$templator->setVariable('produto.id', $produto->id);
			parent::$templator->setVariable('produto.nome', $produto->nome);

			//Pegando associação com alguma categoria aqui: 
			$associativa = new CategoriaHasProduto(); 

			$associativa->where('produto_id = '. $produto->id)->find(); 

			$categoria; 
			while($associativa->fetch()){
				$categoria = new Categoria(); 
				$categoria->where('id = '. $associativa->categoriaId)->find(); 
				while($categoria->fetch())
					parent::$templator->setVariable('produto.categoria', $categoria->nomeCategoria);
			}

			
			parent::$templator->setVariable('produto.preco_venda', $produto->precoVenda);
			parent::$templator->setVariable('produto.estoque', '0');
			parent::$templator->setVariable('produto.reserva', '0');
			parent::$templator->setVariable('produto.oc', '0');
			parent::$templator->setVariable('produto.op', '0');
			parent::$templator->setVariable('produto.saldo', '0');
			
			parent::$templator->addBlock('row'); 
		} 


		$categoria = new Categoria(); 
		$categoria->where('empresa_id = '. $_SESSION['empresaId'] )->find(); 

		while($categoria->fetch()){
			parent::$templator->setVariable('categoria.id', $categoria->id);
			parent::$templator->setVariable('categoria.nome_categoria', $categoria->nomeCategoria);
			
			parent::$templator->addBlock('categoria'); 
		}

		parent::show(); 
	}
}