<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "categoria"
 * in 2015-10-02
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Categoria extends Lumine_Base {

    
    public $id;
    public $nomeCategoria;
    public $margemLucro;
    public $empresaId;
    public $ativo;
    public $produtos = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('categoria');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('nomeCategoria', 'nome_categoria', 'varchar', 150, array('notnull' => true));
        $this->metadata()->addField('margemLucro', 'margem_lucro', 'double', null, array('notnull' => true));
        $this->metadata()->addField('empresaId', 'empresa_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Empresa'));
        $this->metadata()->addField('ativo', 'ativo', 'boolean', 1, array('default' => '1'));

        
        $this->metadata()->addRelation('produtos', Lumine_Metadata::ONE_TO_MANY, 'Produto', 'categoriaId', null, null, null);
    }

    #### END AUTOCODE


}
