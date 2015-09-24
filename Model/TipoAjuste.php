<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "tipo_ajuste"
 * in 2015-09-24
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class TipoAjuste extends Lumine_Base {

    
    public $id;
    public $des;
    public $mudancaestoques = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('tipo_ajuste');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('des', 'des', 'varchar', 45, array('notnull' => true));

        
        $this->metadata()->addRelation('mudancaestoques', Lumine_Metadata::ONE_TO_MANY, 'MudancaEstoque', 'tipoAjusteId', null, null, null);
    }

    #### END AUTOCODE


}
