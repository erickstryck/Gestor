<?php
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'RecibosView.php'); 

require_once(PATH.'Library'.DS.'dompdf'.DS.'dompdf_config.inc.php'); 
require_once(PATH.'Library'.DS.'MiniTemplator.php'); 

require_once(PATH.'Util'.DS.'Convert.php'); 
require_once(PATH.'Util'.DS.'MoedaExtenso.php');

class Recibos extends GenericController {
	private $recibosView; 

	public function __construct() {
		$this->recibosView = new RecibosView(); 
	}

	public function novoReciboView(){
		$this->recibosView->novoReciboView(); 
	}

	public function cadastro($arg){
		Lumine::import("Recibo"); 

		$recibo = new Recibo(); 

		$recibo->viasId       = $arg['vias_id']; 
		$recibo->emissor      = $arg['emissor'];
		$recibo->valorPago    = $arg['valor_pago']; 
		$recibo->recebidoDe   = $arg['recebi_de']; 
		$recibo->cpfCnpj      = $arg['cpf_cnpj']; 
		$recibo->dataRecibo   = $arg['data_recibo']; 
		$recibo->referente    = $arg['referente']; 
		$recibo->empresaId    = $_SESSION['empresa_id']; 

		//procurando o id do contato para fazer a associação: 
		// Lumine::import("Contato"); 
		// $contato = new Contato(); 

		// $total = $contato->get('nomeFantasia', $arg['recebi_de']); 

		// if($total > 0 ){
		// 	$recibo->contatoId = $contato->id; 
		// }else{
		// 	$recibo->contatoId = null; 
		// }

		$recibo->insert(); 

		$this->recibosView->sendAjax(array('status' => true)); 

	}

	public function gerarRecibo($arg){	
		Lumine::import("Recibo"); 
		$recibo = new Recibo(); 
		$recibo->where("empresa_id = ". $_SESSION['empresa_id']." and recibo.id = ". (int) $arg['codigo'] )->find(); 

		if(count($recibo->allToArray()) == 0 )
			die("O codigo enviado nao corresponde a nenhum recibo valido.");


		$template = new MiniTemplator(); 
		
		$template->readTemplateFromFile(PATH.'templates'.DS.'recibos'.DS.'reciboTemplate'.DS.'index.html'); 
		Lumine::import("Empresa"); 

		switch ($recibo->viasId) {
			case 1:
				$html = self::viaCliente($recibo, $template); 
				break;
			case 2:
				$html = self::viaEmissor($recibo, $template); 
				break;
			case 3:
				$html = self::viaDupla($recibo, $template); 
				break;
			default:
				die("Há algum proglema com esse registro"); 
		}

		$dom = new DOMPDF(); 

		$dom->load_html($html); 
		$dom->set_paper('A4','portrait'); 
		$dom->render(); 

		$dom->stream("recibo".Convert::zeroEsquerda($recibo->id).".pdf"); 
	}

	private function viaCliente($recibo,$template){
		Lumine::import("Empresa"); 
		$empresa = new Empresa(); 
		$empresa->get($_SESSION['empresa_id']); 

		$template->setVariable('numero', "Número - ".Convert::zeroEsquerda($recibo->id)); 
		$template->setVariable('via_quem','Via 1 - Clientes'); 
		$template->setVariable('nome_fantasia', Convert::toUTF_8($empresa->nomeFantasia)); 
		$template->setVariable('cpf',$recibo->cpfCnpj); 
		$template->setVariable('valor', "(".$recibo->valorPago.") ". MoedaExtenso::valorPorExtenso($recibo->valorPago)); 
		$template->setVariable('referente',Convert::toUTF_8($recibo->referente)); 
		$template->setVariable('data', date('Y-m-d')); 
		$template->setVariable('nome_cpf', "".$recibo->emissor." (".$recibo->cpfCnpj.")"); 

		$html; 
		$template->generateOutputToString($html); 
		return $html; 
	}

	private function viaEmissor($recibo, $template){
		Lumine::import("Empresa"); 
		$empresa = new Empresa(); 
		$empresa->get($_SESSION['empresa_id']); 

		$template->setVariable('numero', "Número - ".Convert::zeroEsquerda($recibo->id)); 
		$template->setVariable('via_quem','Via 2 - Emissor'); 
		$template->setVariable('nome_fantasia', Convert::toUTF_8($empresa->nomeFantasia)); 
		$template->setVariable('cpf',$recibo->cpfCnpj); 
		$template->setVariable('valor', "(".$recibo->valorPago.") ". MoedaExtenso::valorPorExtenso($recibo->valorPago)); 
		$template->setVariable('referente',Convert::toUTF_8($recibo->referente)); 
		$template->setVariable('data', date('Y-m-d')); 
		$template->setVariable('nome_cpf', "".$recibo->emissor." (".$recibo->cpfCnpj.")"); 

		$html; 
		$template->generateOutputToString($html); 
		return $html; 
	}

	private function viaDupla($recibo, $template){
		die("O sistema ainda nao esta gerando recibos com via dupla."); 
	}

	public function deletar($arg){
		Lumine::import("Recibo"); 
		$recibo = new Recibo(); 

		$recibo->where("empresa_id = ". $_SESSION['empresa_id']." and id = ". (int) $arg['id'])->find();
		$recibo->fetch(true); 

		if( $recibo->id == null )
			$this->recibosView->sendAjax(array('status' => false, 'msg' => 'Operação ilegal')); 

		//Desativando o registro no banco. 
		$recibo->ativo = 0;  
		$recibo->update(); 

		$this->recibosView->sendAjax(array('status' => true, 'msg' => $arg['id'])); 
	}

	public function getObject($arg){
		$id = (int) $arg['id']; 
		Lumine::import("Recibo"); 
		$recibo = new Recibo(); 

		$recibo->get($id); 

		
		$this->recibosView->sendAjax($recibo->toArray()); 
	}
}
