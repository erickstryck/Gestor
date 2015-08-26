<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "tipo_contato"
 * in 2015-08-26
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class TipoContato extends Lumine_Base {

    
    public $id;
    public $des;
    public $contatohastipocontatos = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('tipo_contato');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('des', 'des', 'varchar', 45, array('notnull' => true));

        
        $this->metadata()->addRelation('contatohastipocontatos', Lumine_Metadata::ONE_TO_MANY, 'ContatoHasTipoContato', 'tipoContatoId', null, null, null);
    }

    #### END AUTOCODE


}
