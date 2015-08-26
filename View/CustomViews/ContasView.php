<?php
require_once(PATH.'View'.DS.'GenericView.php'); 
require_once(PATH.'Util'.DS.'Convert.php'); 

class ContasView extends GenericView{
	
	public function __construct(){
		parent::__construct($this); 
	}

	public function novoPagamentoView(){
		parent::getTemplateByAction('contasPagar'); 
		Lumine::import("TipoDocumento"); 
		Lumine::import("PlanoConta"); 
		Lumine::import("Intervalo"); 
		Lumine::import("CadastrarVezes"); 

		$tipoDocumento = new TipoDocumento(); 
		$plano = new PlanoConta(); 
		$intervalo = new Intervalo(); 
		$vezes = new CadastrarVezes(); 

		$tipoDocumento->find(); 

		while($tipoDocumento->fetch()){
			parent::$templator->setVariable('tipo_documento.id',$tipoDocumento->id); 
			parent::$templator->setVariable('tipo_documento.des',$tipoDocumento->des);

			parent::$templator->addBlock('tipo_documento'); 
		}

		$plano->find(); 

		while($plano->fetch()){
			parent::$templator->setVariable('plano_conta.id',$plano->id); 
			parent::$templator->setVariable('plano_conta.des',$plano->des);

			parent::$templator->addBlock('plano_conta'); 
		}

		$intervalo->find(); 

		while($intervalo->fetch()){
			parent::$templator->setVariable('intervalo.id',$intervalo->id); 
			parent::$templator->setVariable('intervalo.des',$intervalo->des);

			parent::$templator->addBlock('intervalo'); 
		}

		$vezes->find(); 

		while($vezes->fetch()){
			parent::$templator->setVariable('cadastrar_vezes.id',$vezes->id); 
			parent::$templator->setVariable('cadastrar_vezes.des',$vezes->des);

			parent::$templator->addBlock('cadastrar_vezes'); 
		}

	

		parent::show(); 
	}


}