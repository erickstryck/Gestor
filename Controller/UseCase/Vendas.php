<?php
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'VendasView.php'); 
require_once(PATH.'Util'.DS.'Competition.php');

class Vendas extends GenericController {
	private $vendasView; 

	public function __construct() {
		$this->vendasView = new VendasView(); 
	}

	public function novaVendaView(){
		$this->vendasView->novaVendaView(); 
	}

	public function orcamentoView($arg){
		$idVenda = (int) $arg['id']; 
		$this->vendasView->orcamentoView($idVenda); 
	}

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
			
			//Verificando se a quantidade subtraída do estoque ainda é maior que 0. 
			if( 0 > ($produto->estoqueAtual - (int) $p->quantidade ) )
				$this->vendasView->sendAjax(array('status' => false , 'msg' => 'O estoque do produto <b>'. $produto->nome .' </b> é insuficiente para este pedido. <b>O estoque atual é de '. $produto->estoqueAtual. ' unidade(s).</b>') );
		}

		Lumine::import("PedidoVenda"); 
		Lumine::import("PedidoVendaHasProduto"); 

		$pedidoVenda = new PedidoVenda(); 

		$pedidoVenda->dataVenda      = $arg['data_venda']; 
		$pedidoVenda->dataEntrega    = $arg['data_entrega']; 
		$pedidoVenda->valorFrete     = $arg['valor_frete']; 
		$pedidoVenda->valorSeguro    = $arg['valor_seguro']; 
		$pedidoVenda->outrasDespesas = $arg['outras_despesas']; 
		$pedidoVenda->obsGerais      = $arg['obs_gerais']; 
		$pedidoVenda->refenrecia     = $arg['referencia']; 
		$pedidoVenda->usuarioId      = $arg['usuario_id']; 
		$pedidoVenda->contatoId      = $arg['contato_id']; 
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
		$formaPagamento->taxaFixa         = empty($arg['taxa_fixa']);
		$formaPagamento->pedidoVendaId    = $pedidoVenda->id; 
		$formaPagamento->tipoPagamentoId = $arg['forma_pagamento_id']; 
		// Caso o id do tipo de desconto venha vazio, será interpretado como sem desconto. 
		$formaPagamento->tipoDescontoId   = ((empty($arg['tipo_desconto_id'])) ? 1 : $arg['tipo_desconto_id']);
		$formaPagamento->tipoEntradaId    = $arg['tipo_entrada_id']; 
		$formaPagamento->insert(); 


		//interpretar os dois casos de cadastro de parcelas: 
		//parcelamento com entrada igual e com entrada diferente. 
		
		Lumine::import("Parcela"); 

		$parcelas = ''; 
		if(!empty($arg['parcela']))
			$parcelas  = $arg['parcela']; 

		$arg['tipo_entrada_id'] = (int) $arg['tipo_entrada_id']; 
		
		if( $arg['tipo_entrada_id'] === 3 || $arg['tipo_entrada_id'] === 2){
			$temp = new Parcela(); 
			$p = json_decode($parcelas[0]); 
			
			$temp->valor              = (float) $arg['valor_entrada']; 
			$temp->dataVencimento     = $p->data ; 
			$temp->numeroDocumento    = $p->num_documento; 
			$temp->palavraChave       = $p->palavra_chave; 
			$temp->custoInternoAntigo = $p->custo_int; 
			$temp->isCaixaInterno     = ($p->destino == 1); 
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
			$temp->custoInternoAntigo = $p->custo_int; 
			$temp->isCaixaInterno     = ($p->destino == 1); 
			$temp->paga               = false; 
			$temp->tipoDocumentoId    = (($p->documento === '' ) ? null : $p->documento) ; 
			$temp->formaPagamentoId   = $formaPagamento->id; 
			$temp->insert(); 
		}

		$this->vendasView->sendAjax(array('status' => true, 'id' => $pedidoVenda->id) );
	}

}
