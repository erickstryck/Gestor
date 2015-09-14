<?php
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'VendasView.php'); 
require_once(PATH.'Util'.DS.'Competition.php');

class Vendas extends GenericController {
	private $vendasView; 

	public function __construct() {
		$this->vendasView = new VendasView(); 
	}

	/**
     * @Permissao({"administrador"})
     */
	public function novaVendaView(){
		$this->vendasView->novaVendaView(); 
	}

	/**
     * @Permissao({"administrador"})
     */
	public function orcamentoView($arg){
		$idVenda = (int) $arg['id']; 
		$this->vendasView->orcamentoView($idVenda); 
	}

	/**
     * @Permissao({"administrador"})
     */
	public function cadastro($arg){ 
		//Roteiro: 
		//Validar os dados que estão vindo da visão ( fazer isso depois )
		//Armazenar os dados no banco
		//Enviar confirmação de sucesso ou falha via JSON. 
		Lumine::import("Produto"); 

		$pedidos  = $arg['item']; 

		foreach($pedidos as $pedido ){
			$p  = json_decode($pedido);   
			$produto = new Produto(); 
			$produto->get( (int) $p->id );

			$total = $protudo->get('nome', 'Arroz'); 
			
			//Verificando se a quantidade subtraída do estoque ainda é maior que 0. 
			if( 0 > ($produto->estoqueAtual - (int) $p->quantidade ) )
				$this->vendasView->sendAjax(array('status' => false , 'msg' => 'O estoque do produto <b>'. $produto->nome .' </b> é insuficiente para este pedido. <b>O estoque atual é de '. $produto->estoqueAtual. ' unidade(s).</b>') );
		}

		Lumine::import("PedidoVenda"); 
		Lumine::import("PedidoVendaHasProduto"); 

		$pedidoVenda = new PedidoVenda(); 

		$pedidoVenda->dataVenda      = $arg['dataVenda'];
		$pedidoVenda->dataEntrega    = $arg['dataEntrega'];
		$pedidoVenda->valorFrete     = $arg['valorFrete'];
		$pedidoVenda->valorSeguro    = $arg['valorSeguro'];
		$pedidoVenda->outrasDespesas = $arg['outrasDespesas'];
		$pedidoVenda->obsGerais      = $arg['obsGerais'];
		$pedidoVenda->refenrecia     = $arg['referencia']; 
		$pedidoVenda->usuarioId      = $arg['usuarioId'];
		$pedidoVenda->contatoId      = $arg['contatoId'];
		$pedidoVenda->isOrcamento    = true;
		$pedidoVenda->insert(); 


		//Criando pedido de venda para o produto e atualizando
		//o estoque do mesmo. 
		foreach($pedidos as $pedido ){
			$p  = json_decode($pedido);  
			$associativa = new PedidoVendaHasProduto(); 
			$produto = new Produto(); 

			$associativa->pedidoVendaId = $pedidoVenda->id; 
			$associativa->produtoId     = $p->id;  
			//Armazenando o preco unitário do produto que foi feito no momento da compra. 
			$associativa->precoUnitario = (float) ( (float) $p->preco / (int) $p->quantidade ); 

			$associativa->quantidade    = $p->quantidade; 
			$associativa->obsAdicionais = $p->info;
			$associativa->insert();  

			$produto->get( (int) $p->id ); 
			$produto->estoqueAtual -= $p->quantidade; 
			$produto->update(); 
		}

		//Adicionar as parcelas ao pedidos de venda, se houver parcelas
		Lumine::import("FormaPagamento"); 

		$formaPagamento = new FormaPagamento(); 
		$formaPagamento->juros            = empty($arg['juros']); 
		$formaPagamento->taxaFixa         = empty($arg['taxaFixa']);
		$formaPagamento->pedidoVendaId    = $pedidoVenda->id; 
		$formaPagamento->tipoPagamentoId = $arg['tipoPagamentoId'];
		// Caso o id do tipo de desconto venha vazio, será interpretado como sem desconto. 
		$formaPagamento->tipoDescontoId   = ((empty($arg['tipoDescontoId'])) ? 1 : $arg['tipoDescontoId']);
		$formaPagamento->tipoEntradaId    = $arg['tipoEntradaId'];
		$formaPagamento->insert(); 


		//interpretar os dois casos de cadastro de parcelas: 
		//parcelamento com entrada igual e com entrada diferente. 
		
		Lumine::import("Parcela"); 

		$parcelas = ''; 
		if(!empty($arg['parcela']))
			$parcelas  = $arg['parcela']; 

		$arg['tipoEntradaId'] = (int) $arg['tipoEntradaId'];
		
		if( $arg['tipoEntradaId'] === 3 || $arg['tipoEntradaId'] === 2){
			$temp = new Parcela(); 
			$p = json_decode($parcelas[0]); 
			
			$temp->valor              = (float) $arg['valor'];
			$temp->dataVencimento     = $p->data ; 
			$temp->numeroDocumento    = $p->num_documento; 
			$temp->palavraChave       = $p->palavra_chave; 
			
			//PEGAR O VALOR DA TABELA ASSOCIATIVA !NÃO ESQUECER DE FAZER ISSO!
			$temp->custoInternoAntigo = 0;  
			// $temp->isCaixaInterno     = ($p->destino == 1); 
			$temp->paga               = true; 
			$temp->tipoDocumentoId    = $p->documento; 
			$temp->formaPagamentoId   = $formaPagamento->id; 
			$temp->insert(); 

			array_shift($parcelas); 
		}


		foreach($parcelas as $parcela){
			$temp = new Parcela(); 
			$p = json_decode($parcela); 
			
			$temp->valor              = (float) $p->entrada; 
			$temp->dataVencimento     = $p->data; 
			$temp->numeroDocumento    = $p->num_documento; 
			$temp->palavraChave       = $p->palavra_chave; 
			//PEGAR O VALOR DA TABELA ASSOCIATIVA !NÃO ESQUECER DE FAZER ISSO!
			$temp->custoInternoAntigo = 0;  
			// $temp->isCaixaInterno     = ($p->destino == 1); 
			$temp->paga               = false; 
			$temp->tipoDocumentoId    = (($p->documento === '' ) ? null : $p->documento) ; 
			$temp->formaPagamentoId   = $formaPagamento->id; 
			$temp->insert(); 
		}

		$this->vendasView->sendAjax(array('status' => true, 'id' => $pedidoVenda->id) );
	}

}
