<?php
require_once(PATH.'Controller'.DS.'GenericController.php'); 
require_once(PATH.'View'.DS.'CustomViews'.DS.'ClientesView.php'); 

class Clientes extends GenericController {
	private $clientesView; 

	public function __construct() {
		$this->clientesView = new ClientesView(); 
	}

	public function novoContatoView(){
		$this->clientesView->novoContatoView(); 
	}

	public function cadastro($arg){
	
		//roteiro:
		//validar os dados; 
		//adicionar a variável e salvar; 
		//enviar logo de execução { status : true/false, value : 'alguma observação'}
		Lumine::import('Contato'); 
		Lumine::import('Local'); 
		Lumine::import('EnderecoEntregaDiferente'); 
		Lumine::import('ContatoHasTipoContato');

		//Criando local para o contato
		$local = new Local(); 

		$local->cep         = $arg['cep']; 
		$local->endereco    = $arg['endereco'];
		$local->numero      = $arg['numero'];
		$local->complemento = $arg['complemento'];
		$local->bairro      = $arg['bairro'];
		$local->paisId      = $arg['paisId'];
		$local->cidadeId    = $arg['cidadeId'];

		$local->insert();  

		//Se houver um endereço de entrega diferente, faça o código abaixo.
		$contato = new Contato();  
		

		//Adicionando relacionamentos: 
		//
		$contato->localId                    = $local->id;
		$contato->indicadorDeIeId            = $arg['indicadorDeIe'];
		
        //Inserindo dados do contato. 

		$contato->nomeRazaoSocial    = $arg['nomeRazaoSocial'];
		$contato->nomeFantasia       = $arg['nomeFantasia'];
		$contato->cpfCnpj            = $arg['cpfCnpj'];
		$contato->inscriEstSubstTrib = $arg['inscriEstSubstTrib'];
		$contato->inscrEstadual      = $arg['inscrEstadual'];
		$contato->inscrMunicipal     = $arg['inscrMunicipal'];
		$contato->inscrSumafra       = $arg['inscrSumafra'];
		$contato->nomeResponsavel    = $arg['nomeResponsavel'];
		$contato->telefone           = $arg['telefone'];
		$contato->telefone1          = $arg['telefone1'];
		$contato->telefone2          = $arg['telefone2'];
		$contato->palavraChave       = $arg['palavraChave'];
		$contato->email              = $arg['email'];
		$contato->email1             = $arg['email1'];
		$contato->anotacoesGerais    = $arg['anotacoesGerais'];
		$contato->dataNasci          = $arg['dataNasci'];
		$contato->empresaId          = $_SESSION['empresaId']; //Pegando o id da empresa do usuário corrente na sessão do sistema.

		$contato->dataInclusao = date('Y-m-d H:i') ; 		
		$contato->insert(); 

		if( !empty($arg['is_endereco_diferente']) ){
			Lumine::import('ContatoHasEnderecoEntregaDiferente'); 

			$enderecoDif = new EnderecoEntregaDiferente(); 

			$enderecoDif->cpfCnpj         = $arg['cpfCnpj'];
			$enderecoDif->cep             = $arg['cep'];
			$enderecoDif->endereco        = $arg['endereco'];
			$enderecoDif->numero          = $arg['numero'];
			$enderecoDif->complemento     = $arg['complemento'];
			$enderecoDif->bairro          = $arg['bairro'];
			$enderecoDif->pontoReferencia = $arg['pontoReferencia'];
			$enderecoDif->cidadeId        = $arg['EntregaCidadeId'];
			$enderecoDif->insert(); 

			$associativa = new ContatoHasEnderecoEntregaDiferente(); 

			$associativa->contatoId 				 = $contato->id; 
			$associativa->enderecoEntregaDiferenteId = $enderecoDif->id; //Adicionando chaves primárias aqui; 
			$associativa->insert(); 
		}


		//Adicionando os tipos do contato: 
		$tipoContato = new ContatoHasTipoContato(); 

		if( !empty($arg['isCliente']) ){
			$tipoContato->contatoId     = $contato->id; 
			$tipoContato->tipoContatoId = (int) $arg['isCliente'];
			$tipoContato->insert(); 
		}

		if(!empty($arg['isFornecedor']) ){
			$tipoContato->contatoId     = $contato->id; 
			$tipoContato->tipoContatoId = (int) $arg['isFornecedor'];
			$tipoContato->insert(); 
		}

		if(!empty($arg['isTransportador']) ){
			$tipoContato->contatoId     = $contato->id; 
			$tipoContato->tipoContatoId = (int) $arg['isTransportador'];
			$tipoContato->insert(); 
		}

		if(!empty($arg['isCosumidorFinal']) ){
			$tipoContato->contatoId     = $contato->id; 
			$tipoContato->tipoContatoId = (int) $arg['isCosumidorFinal'];
			$tipoContato->insert(); 
		}

		//Em formato JSON, envie se a execução da inserção foi bem sucedida. 
		$this->clientesView->sendAjax(array('status' => true) ); 
	}

	public function deletar($arg){
		Lumine::import("Contato"); 
		$contato = new Contato(); 
		$contato->get((int) $arg['id']);

		//Desativando o registro no banco. 
		$contato->ativo = 0;  
		$contato->update(); 

		$this->contatosView->sendAjax(array('status' => true, 'msg' => $arg['id'])); 
	}
}	

