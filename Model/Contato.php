<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "contato"
 * in 2015-09-08
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Contato extends Lumine_Base {

    
    public $id;
    public $nomeRazaoSocial;
    public $nomeFantasia;
    public $cpfCnpj;
    public $inscrEstSubstTrip;
    public $inscrEstadual;
    public $inscrMunicipal;
    public $inscrSumafra;
    public $nomeResponsavel;
    public $telefone;
    public $telefone1;
    public $telefone2;
    public $palavraChave;
    public $email;
    public $email1;
    public $anotacoesGerais;
    public $dataNasci;
    public $dataInclusao;
    public $empresaId;
    public $indicadorDeIeId;
    public $localId;
    public $ativo;
    public $contas = array();
    public $contatohasenderecoentregadiferentes = array();
    public $contatohastipocontatos = array();
    public $mudancaestoquehascontatos = array();
    public $pedidovendas = array();
    public $recibos = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('contato');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('nomeRazaoSocial', 'nome_razao_social', 'varchar', 150, array());
        $this->metadata()->addField('nomeFantasia', 'nome_fantasia', 'varchar', 150, array());
        $this->metadata()->addField('cpfCnpj', 'cpf_cnpj', 'varchar', 45, array());
        $this->metadata()->addField('inscrEstSubstTrip', 'inscr_est_subst_trip', 'varchar', 45, array());
        $this->metadata()->addField('inscrEstadual', 'inscr_estadual', 'varchar', 45, array());
        $this->metadata()->addField('inscrMunicipal', 'inscr_municipal', 'varchar', 45, array());
        $this->metadata()->addField('inscrSumafra', 'inscr_sumafra', 'varchar', 50, array());
        $this->metadata()->addField('nomeResponsavel', 'nome_responsavel', 'varchar', 150, array());
        $this->metadata()->addField('telefone', 'telefone', 'varchar', 45, array());
        $this->metadata()->addField('telefone1', 'telefone1', 'varchar', 45, array());
        $this->metadata()->addField('telefone2', 'telefone2', 'varchar', 45, array());
        $this->metadata()->addField('palavraChave', 'palavra_chave', 'varchar', 45, array());
        $this->metadata()->addField('email', 'email', 'varchar', 45, array());
        $this->metadata()->addField('email1', 'email1', 'varchar', 45, array());
        $this->metadata()->addField('anotacoesGerais', 'anotacoes_gerais', 'varchar', 5000, array());
        $this->metadata()->addField('dataNasci', 'data_nasci', 'datetime', null, array());
        $this->metadata()->addField('dataInclusao', 'data_inclusao', 'datetime', null, array('notnull' => true));
        $this->metadata()->addField('empresaId', 'empresa_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Empresa'));
        $this->metadata()->addField('indicadorDeIeId', 'indicador_de_ie_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'IndicadorDeIe'));
        $this->metadata()->addField('localId', 'local_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Local'));
        $this->metadata()->addField('ativo', 'ativo', 'boolean', 1, array('default' => '1'));

        
        $this->metadata()->addRelation('contas', Lumine_Metadata::ONE_TO_MANY, 'Conta', 'contatoId', null, null, null);
        $this->metadata()->addRelation('contatohasenderecoentregadiferentes', Lumine_Metadata::ONE_TO_MANY, 'ContatoHasEnderecoEntregaDiferente', 'contatoId', null, null, null);
        $this->metadata()->addRelation('contatohastipocontatos', Lumine_Metadata::ONE_TO_MANY, 'ContatoHasTipoContato', 'contatoId', null, null, null);
        $this->metadata()->addRelation('mudancaestoquehascontatos', Lumine_Metadata::ONE_TO_MANY, 'MudancaEstoqueHasContato', 'contatoId', null, null, null);
        $this->metadata()->addRelation('pedidovendas', Lumine_Metadata::ONE_TO_MANY, 'PedidoVenda', 'contatoId', null, null, null);
        $this->metadata()->addRelation('recibos', Lumine_Metadata::ONE_TO_MANY, 'Recibo', 'contatoId', null, null, null);
    }

    #### END AUTOCODE


}
