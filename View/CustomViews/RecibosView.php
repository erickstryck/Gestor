<?php
require_once(PATH.'View'.DS.'GenericView.php'); 
require_once(PATH.'Util'.DS.'Convert.php'); 

class RecibosView extends GenericView{
	
	public function __construct(){
		parent::__construct($this); 
	}

	public function novoReciboView(){
		parent::getTemplateByAction('recibo');
		Lumine::import("Contato"); 
		//Pegando os contatos da empresa da sessão corrente: 
		$contato = new Contato(); 
		$contato->where("empresa_id = ". $_SESSION['empresa_id'])->find(); 

		while($contato->fetch()){
			parent::$templator->setVariable('nome', $contato->nomeFantasia); 
			parent::$templator->addBlock('contato'); 
		}

		//Colocando a data atual: 
		parent::$templator->setVariable('data_now', date('Y-m-d')); 

		//Adicionando elementos na tabela: 
		Lumine::import("Recibo"); 
		$recibo = new Recibo(); 
		$recibo->where("empresa_id = ". $_SESSION['empresa_id'])->limit(500)->find(); 

		while($recibo->fetch()){
			parent::$templator->setVariable('recibo.id', Convert::zeroEsquerda($recibo->id));
			parent::$templator->setVariable('recibo.recebido_de', $recibo->recebidoDe);
			parent::$templator->setVariable('recibo.data_recibo', $recibo->dataRecibo);
			parent::$templator->setVariable('recibo.valor', $recibo->valorPago);
			parent::$templator->setVariable('recibo.referente', $recibo->referente); 
			parent::$templator->addBlock('row'); 
		}

		parent::show(); 
	}
}