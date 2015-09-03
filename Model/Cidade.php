<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "cidade"
 * in 2015-09-03
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Cidade extends Lumine_Base {

    
    public $id;
    public $des;
    public $estadoId;
    public $enderecoentregadiferentes = array();
    public $locais = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('cidade');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true));
        $this->metadata()->addField('des', 'des', 'varchar', 45, array('notnull' => true));
        $this->metadata()->addField('estadoId', 'estado_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Estado'));

        
        $this->metadata()->addRelation('enderecoentregadiferentes', Lumine_Metadata::ONE_TO_MANY, 'EnderecoEntregaDiferente', 'cidadeId', null, null, null);
        $this->metadata()->addRelation('locais', Lumine_Metadata::ONE_TO_MANY, 'Local', 'cidadeId', null, null, null);
    }

    #### END AUTOCODE


}
