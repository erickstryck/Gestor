<?php
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'ServicosView.php'); 

class Servicos extends GenericController {
	private $servicosView; 

	public function __construct() {
		$this->servicosView = new ServicosView(); 
	}

	public function novoServicoView(){
		$this->servicosView->novoServicoView(); 
	}

	public function cadastro($arg){
		Lumine::import("Servico"); 
		$servico = new Servico();
		$servico->nomeServico = $arg['nomeServico'];
		$servico->preco = $arg['preco']; 
		$servico->palavraChave = $arg['palavraChave'];
		$servico->empresaId = $_SESSION['empresaId'];
		$servico->insert();
		$this->servicosView->sendAjax(array('status' => true) );
	}

	public function getObject($arg){
		Lumine::import("Servico");
		$servico = new Servico();
		$servico->where("empresa_id = ".$_SESSION["empresaId"]." and id=".(int)$arg["id"])->find();
		$servico->fetch(true);
		$this->servicosView->sendAjax($servico->toArray());
	}

	public function alterar($arg){
		Lumine::import("Servico");
		$servico = new Servico();
		$servico->where("empresa_id = ".$_SESSION["empresaId"]." and id=".(int)$arg["id"])->find();
		$servico->fetch(true);
		$servico->nomeServico = $arg['nomeServico'];
		$servico->preco = $arg['preco'];
		$servico->palavraChave = $arg['palavraChave'];
		$servico->empresaId = $_SESSION['empresaId'];
		$servico->update();
		$this->servicosView->sendAjax(array('status' => true) );
	}

	function delete($arg){
		Lumine::import("Servico");
		$servico=new Servico();
		$servico->where("empresa_id = ".$_SESSION["empresaId"]." and id=".(int)$arg["id"])->find();
		$servico->fetch(true);
		if($servico->id==null)
			$this->servicosView->sendAjax(array('status' => false,'msg'=>'Operação ilegal!'));
		$servico->ativo=0;
		$servico->update();
		$this->servicosView->sendAjax(array('status' => true));
	}

}
