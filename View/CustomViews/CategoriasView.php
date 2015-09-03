<?php
require_once(PATH.'View'.DS.'GenericView.php'); 
require_once(PATH.'Util'.DS.'Convert.php'); 

class CategoriasView extends GenericView{
	
	public function __construct(){
		parent::__construct($this); 
	}

	public function novaCategoriaView(){
		parent::getTemplateByAction('novaCategoria'); 
		Lumine::import("Categoria"); 

		$categoria = new Categoria();
		$categoria->where("empresa_id = ". $_SESSION['empresa_id'])->find(); 

		
		while($categoria->fetch()){
			parent::$templator->setVariable('catogoria.id', $categoria->id);
			parent::$templator->setVariable('categoria.nome_categoria', $categoria->nomeCategoria); 
			parent::$templator->setVariable('categoria.margem_lucro', Convert::toUpperCase(Convert::toUTF_8($categoria->margemLucro))); 
			parent::$templator->addBlock('row'); 
		} 

		parent::show(); 
	}
}