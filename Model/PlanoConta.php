<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "plano_conta"
 * in 2015-09-16
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class PlanoConta extends Lumine_Base {

    
    public $id;
    public $des;
    public $label;
    public $contas = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('plano_conta');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('des', 'des', 'varchar', 45, array());
        $this->metadata()->addField('label', 'label', 'boolean', 1, array());

        
        $this->metadata()->addRelation('contas', Lumine_Metadata::ONE_TO_MANY, 'Conta', 'planoContaId', null, null, null);
    }

    #### END AUTOCODE


}
