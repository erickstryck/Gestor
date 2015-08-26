<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "mudanca_estoque_has_contato"
 * in 2015-08-26
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Modal
 *
 */

class MudancaEstoqueHasContato extends Lumine_Base {

    
    public $mudancaEstoqueId;
    public $contatoId;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('mudanca_estoque_has_contato');
        $this->metadata()->setPackage('Modal');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('mudancaEstoqueId', 'mudanca_estoque_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'MudancaEstoque'));
        $this->metadata()->addField('contatoId', 'contato_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Contato'));

        
    }

    #### END AUTOCODE


}
