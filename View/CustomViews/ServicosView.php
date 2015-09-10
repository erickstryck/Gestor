<?php
require_once(PATH.'View'.DS.'GenericView.php'); 
require_once(PATH.'Util'.DS.'Convert.php'); 

class ServicosView extends GenericView{
	
	public function __construct(){
		parent::__construct($this); 
	}

	public function novoServicoView(){
		parent::getTemplateByAction('novoServico');

		Lumine::import("Servico"); 
		$servico = new Servico(); 

		$servico->where("empresa_id = ". $_SESSION['empresaId']." and ativo = 1")->find();

		
		while($servico->fetch()){
			parent::$templator->setVariable('servico.id', $servico->id);
			parent::$templator->setVariable('servico.nome_servico', $servico->nomeServico); 
			parent::$templator->setVariable('servico.palavra_chave', $servico->palavraChave); 
			parent::$templator->setVariable('servico.preco', $servico->preco); 

			parent::$templator->addBlock('row'); 
		} 
		parent::show(); 
	}
}