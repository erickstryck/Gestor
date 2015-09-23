<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "usuario"
 * in 2015-09-23
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Usuario extends Lumine_Base {

    
    public $id;
    public $login;
    public $senha;
    public $nomeCompleto;
    public $palavraChave;
    public $email;
    public $ativo;
    public $log = array();
    public $pedidovendas = array();
    public $tarefas = array();
    public $usuariohasempresas = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('usuario');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('login', 'login', 'varchar', 45, array());
        $this->metadata()->addField('senha', 'senha', 'varchar', 45, array());
        $this->metadata()->addField('nomeCompleto', 'nome_completo', 'varchar', 45, array());
        $this->metadata()->addField('palavraChave', 'palavra_chave', 'varchar', 45, array());
        $this->metadata()->addField('email', 'email', 'varchar', 400, array());
        $this->metadata()->addField('ativo', 'ativo', 'boolean', 1, array('default' => '1'));

        
        $this->metadata()->addRelation('log', Lumine_Metadata::ONE_TO_MANY, 'Log', 'usuarioId', null, null, null);
        $this->metadata()->addRelation('pedidovendas', Lumine_Metadata::ONE_TO_MANY, 'PedidoVenda', 'usuarioId', null, null, null);
        $this->metadata()->addRelation('tarefas', Lumine_Metadata::ONE_TO_MANY, 'Tarefa', 'usuarioId', null, null, null);
        $this->metadata()->addRelation('usuariohasempresas', Lumine_Metadata::ONE_TO_MANY, 'UsuarioHasEmpresa', 'usuarioId', null, null, null);
    }

    #### END AUTOCODE


}
