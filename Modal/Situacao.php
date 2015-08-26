<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "situacao"
 * in 2015-08-26
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Modal
 *
 */

class Situacao extends Lumine_Base {

    
    public $idsituacao;
    public $tipo;
    public $tarefas = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('situacao');
        $this->metadata()->setPackage('Modal');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('idsituacao', 'idsituacao', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('tipo', 'tipo', 'varchar', 45, array('notnull' => true));

        
        $this->metadata()->addRelation('tarefas', Lumine_Metadata::ONE_TO_MANY, 'Tarefa', 'situacaoIdsituacao', null, null, null);
    }

    #### END AUTOCODE


}
