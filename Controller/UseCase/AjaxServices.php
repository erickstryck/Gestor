<?php  
require_once(PATH.'Controller'.DS.'GenericController.php'); 


//VER A PROBABILIDADE DESSA CLASSE SER VULNERÁVEL A SQL INJECTION. 
//
class AjaxServices extends GenericController{
	function __construct(){
	}

	//Essa função recebe a chave primária de um estado
	//E retorna as cidades do mesmo. 
	public function getCities( $arg ){ 
	 	Lumine::import('Cidade');
	 	$cidade = new Cidade(); 
	 	$cidade->where("cidade.estado_id = ". $arg['id'])->find(); 
	 	$array = array(); 
	 	while($cidade->fetch())
	 		array_push($array, array( 'id' => $cidade->id, 'des' =>  Convert::toUpperCase(Convert::toUTF_8($cidade->des) )));  
	 	die(json_encode($array)); 
	}

	public function getcategoryProfit($arg){
		Lumine::import('Categoria'); 
		$categoria = new Categoria(); 
		$categoria->where(" empresa_id = ". $_SESSION['empresaId']." and id = ". $arg['id'])->find(); 

		$array; 

		while($categoria->fetch())
	 		$array = array( "profit" => $categoria->margemLucro); 

	 	die(json_encode($array)); 
	}

	//Testar esse método contra Sql injection
	public function getProducts($arg){
		Lumine::import("Produto"); 
		Lumine::import("CategoriaHasProduto");
		Lumine::import("Categoria"); 

		$associativa = new CategoriaHasProduto();
		$associativa->alias("chp"); 
		$produto = new Produto();  

		$clausura = ""; 

		if( !empty($arg['categoria']) )
			$clausura .= " and categoria_id = ". $arg['categoria'];
		//NCR = nome, código e referência
		if( !empty($arg['ncr']) )
			$clausura .= " and (codigo_personalizado = '". $arg['ncr'] ."' or  nome = '". $arg['ncr'] ."' )";

		if( !empty($arg['palavra_chave']) )
			$clausura .= " and palavra_chave ='". $arg['categoria']."'";

		if(empty($clausura) ) return; 
		
		$produto->join($associativa)->where("empresa_id = ". $_SESSION['empresaId'] . " and nao_controlar_estoque = 0". $clausura)->find();

		$array = array(); 
		while($produto->fetch()){
			$categoria = new Categoria(); 
			$categoria->get("id", $produto->categoriaId); 
			array_push($array, array('id' => $produto->id, 'produto' => $produto->nome, 'codigo_personalizado' => $produto->codigoPersonalizado,  'estoque_atual' => $produto->estoqueAtual, 'categoria' => $categoria->nomeCategoria)); 
		}

		die(json_encode($array)); 
	}

	function getProductPrince($arg){
		$id = (int) $arg['produto_id']; 
		Lumine::import('Produto'); 
		$produto = new Produto(); 	
		$produto->get($id); 

		die(json_encode(array( 'prince' => $produto->precoVenda ) ) ); 
	}
}