<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "tarefa"
 * in 2015-09-03
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Tarefa extends Lumine_Base {

    
    public $id;
    public $descricao;
    public $prioridadeIdprioridade;
    public $situacaoIdsituacao;
    public $usuarioId;
    public $titulo;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('tarefa');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('descricao', 'descricao', 'varchar', 4000, array());
        $this->metadata()->addField('prioridadeIdprioridade', 'prioridade_idprioridade', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Prioridade'));
        $this->metadata()->addField('situacaoIdsituacao', 'situacao_idsituacao', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Situacao'));
        $this->metadata()->addField('usuarioId', 'usuario_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Usuario'));
        $this->metadata()->addField('titulo', 'titulo', 'varchar', 45, array('notnull' => true));

        
    }

    #### END AUTOCODE


}
