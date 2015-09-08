<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "contato_has_endereco_entrega_diferente"
 * in 2015-09-08
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class ContatoHasEnderecoEntregaDiferente extends Lumine_Base {

    
    public $contatoId;
    public $enderecoEntregaDiferenteId;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('contato_has_endereco_entrega_diferente');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('contatoId', 'contato_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Contato'));
        $this->metadata()->addField('enderecoEntregaDiferenteId', 'endereco_entrega_diferente_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'EnderecoEntregaDiferente'));

        
    }

    #### END AUTOCODE


}
