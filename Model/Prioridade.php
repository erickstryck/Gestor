<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "prioridade"
 * in 2015-08-27
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Prioridade extends Lumine_Base {

    
    public $idprioridade;
    public $tipo;
    public $tarefas = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('prioridade');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('idprioridade', 'idprioridade', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('tipo', 'tipo', 'varchar', 45, array('notnull' => true));

        
        $this->metadata()->addRelation('tarefas', Lumine_Metadata::ONE_TO_MANY, 'Tarefa', 'prioridadeIdprioridade', null, null, null);
    }

    #### END AUTOCODE


}
