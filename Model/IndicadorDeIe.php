<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "indicador_de_ie"
 * in 2015-09-04
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class IndicadorDeIe extends Lumine_Base {

    
    public $id;
    public $des;
    public $contatos = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('indicador_de_ie');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('des', 'des', 'varchar', 45, array('notnull' => true));

        
        $this->metadata()->addRelation('contatos', Lumine_Metadata::ONE_TO_MANY, 'Contato', 'indicadorDeIeId', null, null, null);
    }

    #### END AUTOCODE


}
