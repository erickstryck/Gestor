<?php
require_once(PATH.'View'.DS.'GenericView.php'); 
require_once(PATH.'Util'.DS.'Convert.php'); 

class ClientesView extends GenericView{
	
	public function __construct(){
		parent::__construct($this); 
	}
	
	public function novoContatoView(){
		parent::getTemplateByAction('novoContato'); 
		Lumine::import('Pais'); 
		Lumine::import('Estado'); 
		Lumine::import('IndicadorDeIe'); 
		Lumine::import('Contato'); 
		Lumine::import('Local'); 

		//Fixando descrição de países ao formulário. 
		$pais = new Pais();
		$pais->find(); 

		while($pais->fetch()){
			parent::$templator->setVariable('contato.pais.id', $pais->id);
			parent::$templator->setVariable('contato.pais.des', Convert::toUpperCase(Convert::toUTF_8($pais->des))); 
			parent::$templator->addBlock('contato.pais'); 
		} 

		$estado = new Estado(); 
		$estado->where('pais_id = 33');//A id do Brasil no banco de dados é 33. 
		$estado->find(); 

		while($estado->fetch()){
			parent::$templator->setVariable('contato.estado.id', $estado->id);
			parent::$templator->setVariable('contato.estado.des', Convert::toUpperCase(Convert::toUTF_8($estado->des))); 
			parent::$templator->addBlock('contato.estado'); 
		} 

		$indicadorIe = new IndicadorDeIe(); 
		$indicadorIe->find(); 

		while($indicadorIe->fetch()){
			parent::$templator->setVariable('contato.indicadorIE.id', $indicadorIe->id);
			parent::$templator->setVariable('contato.indicadorIE.des', Convert::toUpperCase(Convert::toUTF_8($indicadorIe->des))); 
			parent::$templator->addBlock('contato.indicadorIE'); 
		} 

		while($estado->fetch()){
			parent::$templator->setVariable('difEnd.estado.id', $estado->id);
			parent::$templator->setVariable('difEnd.estado.des', Convert::toUpperCase(Convert::toUTF_8($estado->des))); 
			parent::$templator->addBlock('difEnd.estado'); 
		} 


		//Anexando registro de contatos que já tem na base de dados. 
		$contato = new Contato();

		$contato->where('empresa_id = '. (int) $_SESSION['empresa_id'])->find(); 

		while( $contato->fetch() ){
			parent::$templator->setVariable('contato.id', $contato->id); 
			parent::$templator->setVariable('contato.nome', $contato->nomeRazaoSocial); 
			parent::$templator->setVariable('contato.cpf_cnpj', $contato->cpfCnpj); 

			$local   = new Local(); 
			$local->where('local.id = '. (int) $contato->localId )->find(); 
			$local->fetch(); 
			
			parent::$templator->setVariable('contato.endereco', Convert::minification($local->endereco,30) ); 
			parent::$templator->setVariable('contato.endereco.tooltip', $local->endereco ); 
			parent::$templator->setVariable('contato.telefone', $contato->telefone); 
			parent::$templator->setVariable('contato.email', $contato->email); 
			
			parent::$templator->addBlock('row'); 
		}

		parent::show(); 
	}
}