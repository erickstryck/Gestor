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

class MainController {
	private $controllersArray;
	public function __construct() {
		// incluir todos os controllers espec�ficos aqui;       
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
				'ordemServico' => new OrdemServico()
		);
	}
	
	public function findMyController() {
		// Passos:	
		// 1 O useCase est� nas lista de ControllersArray?
		// 2 A action existe no controlador?
		// 3 Invocar m�todo;
		// 4 Gerar output.
		$useCase = $_REQUEST ['uc'];
		$action  = $_REQUEST ['a'];
		
		// if( $this->$controllersArray[$useCase] == null ) return;
		$controller = $this->controllersArray [$useCase];
		$realNameMethod = '';
		
		$arrayMethods = $controller->sayMyActions();
		
		foreach ( $arrayMethods as $a ) {
			if (strcasecmp ( $a, $action ) == 0) {
				$realNameMethod = $a;
				break;
			}
		}
		
		if (strlen ( $realNameMethod ) == 0) {
			die('N�o h� a��o para ser executada');
		}
		
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