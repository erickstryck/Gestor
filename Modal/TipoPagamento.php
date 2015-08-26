<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "tipo_pagamento"
 * in 2015-08-26
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Modal
 *
 */

class TipoPagamento extends Lumine_Base {

    
    public $id;
    public $des;
    public $formapagamentos = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('tipo_pagamento');
        $this->metadata()->setPackage('Modal');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('des', 'des', 'varchar', 45, array());

        
        $this->metadata()->addRelation('formapagamentos', Lumine_Metadata::ONE_TO_MANY, 'FormaPagamento', 'tipoPagamentoId', null, null, null);
    }

    #### END AUTOCODE


}