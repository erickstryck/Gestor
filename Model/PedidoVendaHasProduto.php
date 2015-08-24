<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "pedido_venda_has_produto"
 * in 2015-08-19
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class PedidoVendaHasProduto extends Lumine_Base {

    
    public $pedidoVendaId;
    public $produtoId;
    public $quantidade;
    public $precoUnitario;
    public $obsAdicionais;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('pedido_venda_has_produto');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('pedidoVendaId', 'pedido_venda_id', 'int', 11, array('primary' => true, 'notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'PedidoVenda'));
        $this->metadata()->addField('produtoId', 'produto_id', 'int', 11, array('primary' => true, 'notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Produto'));
        $this->metadata()->addField('quantidade', 'quantidade', 'int', 11, array());
        $this->metadata()->addField('precoUnitario', 'preco_unitario', 'double', null, array());
        $this->metadata()->addField('obsAdicionais', 'obs_adicionais', 'varchar', 45, array());

        
    }

    #### END AUTOCODE


}
