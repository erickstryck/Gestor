<?php
require_once(PATH.'View'.DS.'GenericView.php'); 
require_once(PATH.'Util'.DS.'Convert.php'); 

class UsuariosView extends GenericView{
	
	public function __construct(){
		parent::__construct($this); 
	}

	public function novoUsuarioView(){
		parent::getTemplateByAction('novoUsuario');

		Lumine::import("Usuario"); 
		Lumine::import("UsuarioHasEmpresa");

		$associativa = new UsuarioHasEmpresa(); 
		

		$associativa->where("empresa_id = ". $_SESSION['empresa_id'])->find(); 

		
		while($associativa->fetch()){

			$usuario = new Usuario(); 

			$usuario->where('id = '. $associativa->usuarioId)->find();

			while( $usuario->fetch()){
				parent::$templator->setVariable('usuario.id', Convert::zeroEsquerda($usuario->id));
				parent::$templator->setVariable('usuario.nome_completo', $usuario->nomeCompleto); 
				parent::$templator->setVariable('usuario.email', $usuario->email); 
				parent::$templator->setVariable('usuario.login', $usuario->login); 
				parent::$templator->setVariable('usuario.acesso', ( $associativa->temAcesso ) ? "Sim" : "<i style='color:red'>Não</i>");
				parent::$templator->setVariable('usuario.vendedor', ( $associativa->isVendedor ) ? "Sim" : "<i style='color:red'>Não</i>");
				parent::$templator->setVariable('usuario.tecnico', ( $associativa->isTecnico ) ? "Sim" : "<i style='color:red'>Não</i>");
				parent::$templator->setVariable('usuario.permissoes', ( $associativa->isAdmin ) ? "Adminstrador" : "Uso restrito");

				parent::$templator->addBlock('row'); 
			} 
		} 
		parent::show(); 
	}
}