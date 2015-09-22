<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "log"
 * in 2015-09-22
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Log extends Lumine_Base {

    
    public $id;
    public $usercase;
    public $action;
    public $ocorrencia;
    public $empresaId;
    public $usuarioId;
    public $permissao;
    public $data;
    public $time;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('log');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('usercase', 'userCase', 'varchar', 45, array('notnull' => true));
        $this->metadata()->addField('action', 'action', 'varchar', 45, array('notnull' => true));
        $this->metadata()->addField('ocorrencia', 'ocorrencia', 'varchar', 120, array('notnull' => true));
        $this->metadata()->addField('empresaId', 'empresa_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Empresa'));
        $this->metadata()->addField('usuarioId', 'usuario_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Usuario'));
        $this->metadata()->addField('permissao', 'permissao', 'varchar', 120, array('notnull' => true));
        $this->metadata()->addField('data', 'data', 'varchar', 45, array('notnull' => true));
        $this->metadata()->addField('time', 'time', 'varchar', 45, array('notnull' => true));

        
    }

    #### END AUTOCODE


}
