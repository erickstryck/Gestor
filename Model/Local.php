<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "local"
 * in 2015-09-14
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Local extends Lumine_Base {

    
    public $id;
    public $cep;
    public $endereco;
    public $numero;
    public $complemento;
    public $bairro;
    public $cidadeId;
    public $paisId;
    public $contatos = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('local');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('cep', 'cep', 'varchar', 45, array());
        $this->metadata()->addField('endereco', 'endereco', 'varchar', 200, array());
        $this->metadata()->addField('numero', 'numero', 'int', 11, array());
        $this->metadata()->addField('complemento', 'complemento', 'varchar', 500, array());
        $this->metadata()->addField('bairro', 'bairro', 'varchar', 150, array());
        $this->metadata()->addField('cidadeId', 'cidade_id', 'int', 11, array('foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Cidade'));
        $this->metadata()->addField('paisId', 'pais_id', 'int', 11, array('foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Pais'));

        
        $this->metadata()->addRelation('contatos', Lumine_Metadata::ONE_TO_MANY, 'Contato', 'localId', null, null, null);
    }

    #### END AUTOCODE


}
