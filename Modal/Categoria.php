<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "categoria"
 * in 2015-08-26
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Modal
 *
 */

class Categoria extends Lumine_Base {

    
    public $id;
    public $nomeCategoria;
    public $margemLucro;
    public $empresaId;
    public $categoriahasprodutos = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('categoria');
        $this->metadata()->setPackage('Modal');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('nomeCategoria', 'nome_categoria', 'varchar', 150, array('notnull' => true));
        $this->metadata()->addField('margemLucro', 'margem_lucro', 'double', null, array('notnull' => true));
        $this->metadata()->addField('empresaId', 'empresa_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Empresa'));

        
        $this->metadata()->addRelation('categoriahasprodutos', Lumine_Metadata::ONE_TO_MANY, 'CategoriaHasProduto', 'categoriaId', null, null, null);
    }

    #### END AUTOCODE


}