<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "recipiente"
 * in 2015-09-22
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Recipiente extends Lumine_Base {

    
    public $id;
    public $des;
    public $empresaId;
    public $ativo;
    public $contas = array();
    public $parcelas = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('recipiente');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('des', 'des', 'varchar', 150, array());
        $this->metadata()->addField('empresaId', 'empresa_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Empresa'));
        $this->metadata()->addField('ativo', 'ativo', 'boolean', 1, array('default' => '1'));

        
        $this->metadata()->addRelation('contas', Lumine_Metadata::ONE_TO_MANY, 'Conta', 'recipienteId', null, null, null);
        $this->metadata()->addRelation('parcelas', Lumine_Metadata::ONE_TO_MANY, 'Parcela', 'recipienteId', null, null, null);
    }

    #### END AUTOCODE


}
