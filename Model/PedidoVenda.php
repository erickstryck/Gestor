<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "pedido_venda"
 * in 2015-08-25
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class PedidoVenda extends Lumine_Base {

    
    public $id;
    public $dataVenda;
    public $dataEntrega;
    public $valorFrete;
    public $valorSeguro;
    public $outrasDespesas;
    public $obsGerais;
    public $referencia;
    public $isOrcamento;
    public $usuarioId;
    public $contatoId;
    public $formapagamentos = array();
    public $pedidovendahasprodutos = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('pedido_venda');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('dataVenda', 'data_venda', 'date', null, array());
        $this->metadata()->addField('dataEntrega', 'data_entrega', 'date', null, array());
        $this->metadata()->addField('valorFrete', 'valor_frete', 'double', null, array());
        $this->metadata()->addField('valorSeguro', 'valor_seguro', 'double', null, array());
        $this->metadata()->addField('outrasDespesas', 'outras_despesas', 'double', null, array());
        $this->metadata()->addField('obsGerais', 'obs_gerais', 'varchar', 500, array());
        $this->metadata()->addField('referencia', 'referencia', 'varchar', 150, array());
        $this->metadata()->addField('isOrcamento', 'is_orcamento', 'boolean', 1, array());
        $this->metadata()->addField('usuarioId', 'usuario_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Usuario'));
        $this->metadata()->addField('contatoId', 'contato_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Contato'));

        
        $this->metadata()->addRelation('formapagamentos', Lumine_Metadata::ONE_TO_MANY, 'FormaPagamento', 'pedidoVendaId', null, null, null);
        $this->metadata()->addRelation('pedidovendahasprodutos', Lumine_Metadata::ONE_TO_MANY, 'PedidoVendaHasProduto', 'pedidoVendaId', null, null, null);
    }

    #### END AUTOCODE


}
