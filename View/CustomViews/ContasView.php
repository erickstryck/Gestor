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
		Lumine::import("Contato"); 
		Lumine::import("CadastrarVezes"); 

		$tipoDocumento = new TipoDocumento(); 
		$plano = new PlanoConta(); 
		$intervalo = new Intervalo(); 
		$vezes = new CadastrarVezes(); 

		$tipoDocumento->find(); 

		while($tipoDocumento->fetch()){
			parent::$templator->setVariable('tipo_documento.id',$tipoDocumento->id); 
			parent::$templator->setVariable('tipo_documento.des',Convert::toUTF_8($tipoDocumento->des));

			parent::$templator->addBlock('tipo_documento'); 
		}

		$plano->where('id <= 38')->find(); 

		while($plano->fetch()){
			parent::$templator->setVariable('plano_conta.id',$plano->id); 
			parent::$templator->setVariable('plano_conta.des',Convert::toUTF_8(( ($plano->label)? '--'.$plano->des.'--' : $plano->des ) ));
			parent::$templator->setVariable('disabled', (($plano->label)? 'disabled' : '' ) ); 
			parent::$templator->addBlock('plano_conta'); 
		}

		$intervalo->find(); 

		while($intervalo->fetch()){
			parent::$templator->setVariable('intervalo.id',(int) $intervalo->id); 
			parent::$templator->setVariable('intervalo.des',Convert::toUTF_8($intervalo->des));

			parent::$templator->addBlock('intervalo'); 
		}

		$vezes->find(); 

		while($vezes->fetch()){
			parent::$templator->setVariable('cadastrar_vezes.id',$vezes->id); 
			parent::$templator->setVariable('cadastrar_vezes.des',Convert::toUTF_8($vezes->des)); 
			parent::$templator->addBlock('cadastrar_vezes'); 
		}

		$contato = new Contato(); 
		$contato->where("empresa_id = ". (int) $_SESSION['empresa_id'] )->find(); 

		while($contato->fetch()){
			parent::$templator->setVariable('contato.id',$contato->id); 
			parent::$templator->setVariable('contato.des',Convert::toUTF_8($contato->nomeFantasia)); 
			parent::$templator->addBlock('contato'); 
		}


		//Adicionando data atual para o lançamento: 
	 	parent::$templator->setVariable('date_now', date('Y-m-d')); 

		parent::show(); 
	}


}