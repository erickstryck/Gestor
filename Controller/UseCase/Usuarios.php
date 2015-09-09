<?php
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'UsuariosView.php'); 

class Usuarios extends GenericController {
	private $usuariosView; 

	public function __construct() {
		$this->usuariosView = new UsuariosView(); 
	}

	public function novoUsuarioView(){
		$this->usuariosView->novoUsuarioView(); 
	}

	public function cadastro($arg){
		//Roteiro: 
		//Validar os dados que estão vindo da visão ( fazer isso depois )
		//Armazenar os dados no banco
		//Enviar confirmação de sucesso ou falha via JSON.
		
		if(strcmp($arg['senha'], $arg['senha_confirmacao']) != 0 )
			$this->usuariosView->sendAjax(array('status' => false) );

		Lumine::import("Usuario"); 
		$usuario = new Usuario(); 

		if( ($usuario->get('email', $arg['email']) > 0) )
			$this->usuariosView->sendAjax(array('status' => false, 'msg' => 'E-mail já cadastrado') );

		$usuario = new Usuario(); 
		if( ($usuario->get('login', $arg['login']) > 0) )
			$this->usuariosView->sendAjax(array('status' => false, 'msg' => 'Login já cadastrado') );

		Lumine::import("UsuarioHasEmpresa"); 

		$usuario = new Usuario(); 
		$associativa = new UsuarioHasEmpresa(); 
		//Se a confirmação da senha não for igual a senha, retorne false

		$usuario->login = $arg['login']; 
		$usuario->senha = $arg['senha']; 
		$usuario->nomeCompleto = $arg['nomeCompleto'];
		$usuario->email = $arg['email']; 
		$usuario->palavraChave = $arg['palavraChave'];

		$usuario->insert(); 
		//Associando usuário a uma empresa com os seus devidos privilégios: 
		
		$associativa->isTecnico = ((empty($arg['isTecnico']))) ? false : true;
		$associativa->isVendedor = ((empty($arg['isVendedor']))) ? false : true;
		$associativa->temAcesso = ((empty($arg['temAcesso']))) ? false : true;
		$associativa->comissaoProduto = $arg['comissaoProduto'];
		$associativa->comissaoVendedor = $arg['comissao_vendedor']; 
		$associativa->empresaId = $_SESSION['empresa_id']; 
		$associativa->usuarioId = $usuario->id;  

		$associativa->insert(); 

		$this->usuariosView->sendAjax(array('status' => true) );
	}

	public function deletar($arg){
		Lumine::import("Usuario"); 
		Lumine::import("UsuarioHasEmpresa"); 
		$usuario = new Usuario(); 
		$associativa = new UsuarioHasEmpresa();

		$usuario->join($associativa)->where('id = '. (int) $arg['id'] )->find(); 
		$usuario->fetch(true); 

		if($usuario->isAdmin)
			$this->usuariosView->sendAjax(array('status' => false, 'msg' => 'O adminstrador não pode ser deletado.')); 

		//Testando se o usuário é um adminstrador: 
		
		//Desativando o registro no banco. 
		$usuario->ativo = 0;  
		$usuario->update(); 

		$this->usuariosView->sendAjax(array('status' => true, 'msg' => $arg['id'])); 
	}

}
