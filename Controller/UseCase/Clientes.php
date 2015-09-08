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
		$local->paisId      = $arg['pais'];
		$local->cidadeId    = $arg['cidade'];  

		$local->insert();  

		//Se houver um endereço de entrega diferente, faça o código abaixo.
		$contato = new Contato();  
		

		//Adicionando relacionamentos: 
		//
		$contato->localId                    = $local->id;
		$contato->indicadorDeIeId            = $arg['indicador_de_ie'];
		
        //Inserindo dados do contato. 

		$contato->nomeRazaoSocial    = $arg['nome_razao_social']; 
		$contato->nomeFantasia       = $arg['nome_fantasia']; 
		$contato->cpfCnpj            = $arg['cpf_cnpj']; 
		$contato->inscriEstSubstTrib = $arg['inscr_est_subst_trip'];
		$contato->inscrEstadual      = $arg['inscr_estatual'];  
		$contato->inscrMunicipal     = $arg['inscr_municipal'];
		$contato->inscrSumafra       = $arg['inscr_sumafra'];
		$contato->nomeResponsavel    = $arg['nome_responsavel'];
		$contato->telefone           = $arg['telefone'];
		$contato->telefone1          = $arg['telefone1'];
		$contato->telefone2          = $arg['telefone2'];
		$contato->palavraChave       = $arg['palavra_chave'];
		$contato->email              = $arg['email'];
		$contato->email1             = $arg['email1'];
		$contato->anotacoesGerais    = $arg['anotacoes_gerais'];
		$contato->dataNasci          = $arg['data_nasc'];
		$contato->empresaId          = $_SESSION['empresa_id']; //Pegando o id da empresa do usuário corrente na sessão do sistema.

		$contato->dataInclusao = date('Y-m-d H:i') ; 		
		$contato->insert(); 

		if( !empty($arg['is_endereco_diferente']) ){
			Lumine::import('ContatoHasEnderecoEntregaDiferente'); 

			$enderecoDif = new EnderecoEntregaDiferente(); 

			$enderecoDif->cpfCnpj         = $arg['entrega_cpf_cnpj']; 
			$enderecoDif->cep             = $arg['entrega_cep'];
			$enderecoDif->endereco        = $arg['entrega_endereco'];
			$enderecoDif->numero          = $arg['entrega_numero'];
			$enderecoDif->complemento     = $arg['entrega_complemento'];
			$enderecoDif->bairro          = $arg['entrega_barrio'];
			$enderecoDif->pontoReferencia = $arg['entrega_ponto_referencia'];
			$enderecoDif->cidadeId        = $arg['entrega_cidade'];
			$enderecoDif->insert(); 

			$associativa = new ContatoHasEnderecoEntregaDiferente(); 

			$associativa->contatoId 				 = $contato->id; 
			$associativa->enderecoEntregaDiferenteId = $enderecoDif->id; //Adicionando chaves primárias aqui; 
			$associativa->insert(); 
		}


		//Adicionando os tipos do contato: 
		$tipoContato = new ContatoHasTipoContato(); 

		if( !empty($arg['is_cliente']) ){
			$tipoContato->contatoId     = $contato->id; 
			$tipoContato->tipoContatoId = (int) $arg['is_cliente'];  
			$tipoContato->insert(); 
		}

		if(!empty($arg['is_fornecedor']) ){
			$tipoContato->contatoId     = $contato->id; 
			$tipoContato->tipoContatoId = (int) $arg['is_fornecedor']; 
			$tipoContato->insert(); 
		}

		if(!empty($arg['is_transportador']) ){
			$tipoContato->contatoId     = $contato->id; 
			$tipoContato->tipoContatoId = (int) $arg['is_transportador']; 
			$tipoContato->insert(); 
		}

		if(!empty($arg['is_cosumidor_final']) ){
			$tipoContato->contatoId     = $contato->id; 
			$tipoContato->tipoContatoId = (int) $arg['is_cosumidor_final']; 
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

		$tarefas->join($usuario)->where(" empresa_id  =" . $_SESSION['empresa_id'] );
	}
}	

