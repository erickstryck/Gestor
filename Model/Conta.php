<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "conta"
 * in 2015-09-09
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Conta extends Lumine_Base {

    
    public $id;
    public $receber;
    public $descricao;
    public $dataLancamento;
    public $dataVencimento;
    public $valor;
    public $isCaixaInterno;
    public $numeroDocumento;
    public $apenasPrevisao;
    public $observacoes;
    public $palavraChave;
    public $valorPagamento;
    public $dataPagamento;
    public $empresaId;
    public $cadastrarVezesId;
    public $planoContaId;
    public $intervaloId;
    public $contatoId;
    public $tipoDocumentoId;
    public $paga;
    public $ativo;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('conta');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('receber', 'receber', 'boolean', 1, array());
        $this->metadata()->addField('descricao', 'descricao', 'varchar', 45, array());
        $this->metadata()->addField('dataLancamento', 'data_lancamento', 'date', null, array());
        $this->metadata()->addField('dataVencimento', 'data_vencimento', 'date', null, array());
        $this->metadata()->addField('valor', 'valor', 'double', null, array());
        $this->metadata()->addField('isCaixaInterno', 'is_caixa_interno', 'int', 11, array());
        $this->metadata()->addField('numeroDocumento', 'numero_documento', 'varchar', 45, array());
        $this->metadata()->addField('apenasPrevisao', 'apenas_previsao', 'boolean', 1, array());
        $this->metadata()->addField('observacoes', 'observacoes', 'varchar', 5000, array());
        $this->metadata()->addField('palavraChave', 'palavra_chave', 'varchar', 60, array());
        $this->metadata()->addField('valorPagamento', 'valor_pagamento', 'double', null, array());
        $this->metadata()->addField('dataPagamento', 'data_pagamento', 'date', null, array());
        $this->metadata()->addField('empresaId', 'empresa_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Empresa'));
        $this->metadata()->addField('cadastrarVezesId', 'cadastrar_vezes_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'CadastrarVezes'));
        $this->metadata()->addField('planoContaId', 'plano_conta_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'PlanoConta'));
        $this->metadata()->addField('intervaloId', 'intervalo_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Intervalo'));
        $this->metadata()->addField('contatoId', 'contato_id', 'int', 11, array('foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Contato'));
        $this->metadata()->addField('tipoDocumentoId', 'tipo_documento_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'TipoDocumento'));
        $this->metadata()->addField('paga', 'paga', 'boolean', 1, array());
        $this->metadata()->addField('ativo', 'ativo', 'boolean', 1, array('default' => '1'));

        
    }

    #### END AUTOCODE


}
