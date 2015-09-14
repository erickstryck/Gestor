<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "forma_pagamento"
 * in 2015-09-14
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class FormaPagamento extends Lumine_Base {

    
    public $id;
    public $juros;
    public $taxaFixa;
    public $tipoEntradaId;
    public $tipoDescontoId;
    public $tipoPagamentoId;
    public $pedidoVendaId;
    public $parcelas = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('forma_pagamento');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('juros', 'juros', 'boolean', 1, array());
        $this->metadata()->addField('taxaFixa', 'taxa_fixa', 'boolean', 1, array());
        $this->metadata()->addField('tipoEntradaId', 'tipo_entrada_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'TipoEntrada'));
        $this->metadata()->addField('tipoDescontoId', 'tipo_desconto_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'TipoDesconto'));
        $this->metadata()->addField('tipoPagamentoId', 'tipo_pagamento_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'TipoPagamento'));
        $this->metadata()->addField('pedidoVendaId', 'pedido_venda_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'PedidoVenda'));

        
        $this->metadata()->addRelation('parcelas', Lumine_Metadata::ONE_TO_MANY, 'Parcela', 'formaPagamentoId', null, null, null);
    }

    #### END AUTOCODE


}
