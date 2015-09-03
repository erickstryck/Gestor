<?php
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'CategoriasView.php'); 

class Categorias extends GenericController {
	private $categoriasView; 

	public function __construct() {
		$this->categoriasView = new CategoriasView(); 
	}

	public function novaCategoriaView(){
		$this->categoriasView->novaCategoriaView(); 
	}

	public function cadastro($arg){
		//Roteiro: 
		//Validar os dados que estão vindo da visão ( fazer isso depois )
		//Armazenar os dados no banco
		//Enviar confirmação de sucesso ou falha via JSON. 
		
		Lumine::import("Categoria"); 

		$categoria = new Categoria(); 

		$categoria->nomeCategoria = 		$arg['nome_categoria']; 
		$categoria->margemLucro   = (float) $arg['margem_lucro']; 
		$categoria->empresaId     = 		$_SESSION['empresa_id']; 

		$categoria->insert(); 

		//Enviar essa linha apenas se tudo acima estiver sido feito corretamente. 
		$this->categoriasView->sendAjax(array('status' => true) );
	}

}
