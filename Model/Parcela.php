<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "parcela"
 * in 2015-09-04
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Parcela extends Lumine_Base {

    
    public $id;
    public $valor;
    public $dataVencimento;
    public $numeroDocumento;
    public $palavraChave;
    public $custoInternoAntigo;
    public $isCaixaInterno;
    public $paga;
    public $formaPagamentoId;
    public $tipoDocumentoId;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('parcela');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('valor', 'valor', 'varchar', 45, array());
        $this->metadata()->addField('dataVencimento', 'data_vencimento', 'date', null, array());
        $this->metadata()->addField('numeroDocumento', 'numero_documento', 'varchar', 45, array());
        $this->metadata()->addField('palavraChave', 'palavra_chave', 'varchar', 45, array());
        $this->metadata()->addField('custoInternoAntigo', 'custo_interno_antigo', 'double', null, array());
        $this->metadata()->addField('isCaixaInterno', 'is_caixa_interno', 'boolean', 1, array());
        $this->metadata()->addField('paga', 'paga', 'boolean', 1, array());
        $this->metadata()->addField('formaPagamentoId', 'forma_pagamento_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'FormaPagamento'));
        $this->metadata()->addField('tipoDocumentoId', 'tipo_documento_id', 'int', 11, array('foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'TipoDocumento'));

        
    }

    #### END AUTOCODE


}
