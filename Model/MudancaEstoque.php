<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "mudanca_estoque"
 * in 2015-09-23
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class MudancaEstoque extends Lumine_Base {

    
    public $id;
    public $estoqueAntigo;
    public $estoqueNovo;
    public $obsGerais;
    public $dataMudanca;
    public $tipoAjusteId;
    public $produtoId;
    public $ativo;
    public $mudancaestoquehascontatos = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('mudanca_estoque');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('estoqueAntigo', 'estoque_antigo', 'int', 11, array());
        $this->metadata()->addField('estoqueNovo', 'estoque_novo', 'int', 11, array());
        $this->metadata()->addField('obsGerais', 'obs_gerais', 'varchar', 5000, array());
        $this->metadata()->addField('dataMudanca', 'data_mudanca', 'date', null, array());
        $this->metadata()->addField('tipoAjusteId', 'tipo_ajuste_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'TipoAjuste'));
        $this->metadata()->addField('produtoId', 'produto_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Produto'));
        $this->metadata()->addField('ativo', 'ativo', 'boolean', 1, array('default' => '1'));

        
        $this->metadata()->addRelation('mudancaestoquehascontatos', Lumine_Metadata::ONE_TO_MANY, 'MudancaEstoqueHasContato', 'mudancaEstoqueId', null, null, null);
    }

    #### END AUTOCODE


}
