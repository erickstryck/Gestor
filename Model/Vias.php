<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "vias"
 * in 2015-09-14
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Vias extends Lumine_Base {

    
    public $id;
    public $des;
    public $recibos = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('vias');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('des', 'des', 'varchar', 45, array());

        
        $this->metadata()->addRelation('recibos', Lumine_Metadata::ONE_TO_MANY, 'Recibo', 'viasId', null, null, null);
    }

    #### END AUTOCODE


}
