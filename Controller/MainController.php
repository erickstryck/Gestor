<?php
require_once(PATH.'Controller'.DS.'UseCase'.DS.'Clientes.php'); 
require_once(PATH.'Controller'.DS.'UseCase'.DS.'AjaxServices.php'); 
require_once(PATH.'Controller'.DS.'UseCase'.DS.'Categorias.php');
require_once(PATH.'Controller'.DS.'UseCase'.DS.'Produtos.php');
require_once(PATH.'Controller'.DS.'UseCase'.DS.'Home.php');
require_once(PATH.'Controller'.DS.'UseCase'.DS.'Servicos.php');
require_once(PATH.'Controller'.DS.'UseCase'.DS.'Usuarios.php');
require_once(PATH.'Controller'.DS.'UseCase'.DS.'Estoques.php');
require_once(PATH.'Controller'.DS.'UseCase'.DS.'Vendas.php');
require_once(PATH.'Controller'.DS.'UseCase'.DS.'OrdemServico.php');
require_once(PATH.'Controller'.DS.'UseCase'.DS.'Contas.php');
require_once(PATH.'Controller'.DS.'UseCase'.DS.'Tarefas.php');
require_once(PATH.'Controller'.DS.'UseCase'.DS.'Recibos.php');

class MainController {
	private $controllersArray;
	public function __construct() {
		// incluir todos os controllers específicos aqui;       
		$this->controllersArray = array (
				'contas'       => new Contas(), 
				'clientes'     => new Clientes(), 
				'ajaxServices' => new AjaxServices(),
				'categorias'   => new Categorias(), 
				'produtos'     => new Produtos(), 
				'home'         => new Home(), 
				'servicos'     => new Servicos(),
				'usuarios'     => new Usuarios(), 
				'estoques'     => new Estoques(), 
				'vendas'	   => new Vendas(), 
				'ordemServico' => new OrdemServico(),
				'tarefas' 	   => new Tarefas(), 
				'recibos'      => new Recibos()
		);
	}
	
	public function findMyController() {
		// Passos:	
		// 1 O useCase está nas lista de ControllersArray?
		// 2 A action existe no controlador?
		// 3 Invocar método;
		// 4 Gerar output.
		//limpar sqlinjection
	
		$useCase = $_REQUEST ['uc'];
		$action  = $_REQUEST ['a'];

		// if( $this->$controllersArray[$useCase] == null ) return;
		$controller = $this->controllersArray [$useCase];
		$realNameMethod = '';

		//if( $this->$controllersArray[$useCase] == null ) return;//404

		$arrayMethods = $controller->sayMyActions();
		
		foreach ( $arrayMethods as $a ) {
			if (strcasecmp ( $a, $action ) == 0) {
				$realNameMethod = $a;
				break;
			}
		}
		
		if (strlen ( $realNameMethod ) == 0) {
			die('404');
		}
		
		//firewall; 
		//Firewall::permissao($controller,$realNameMethod )//return true or false
		
		$reflection = new ReflectionMethod ( $controller->sayMyName (), $realNameMethod );
		return $reflection->invoke( $controller, self::preparingArray( $_REQUEST ));
	}

	private function preparingArray($target) {
		$array = array_merge ( array (), $target );
		unset ( $array ['a'] );
		unset ( $array ['uc'] );
		return $array;
	}
	
}