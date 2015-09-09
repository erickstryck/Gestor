<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "empresa"
 * in 2015-09-09
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Empresa extends Lumine_Base {

    
    public $id;
    public $nomeFantasia;
    public $ativo;
    public $categorias = array();
    public $contas = array();
    public $contatos = array();
    public $produtos = array();
    public $recibos = array();
    public $servicos = array();
    public $tarefas = array();
    public $tipodocumentohasempresas = array();
    public $usuariohasempresas = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('empresa');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('nomeFantasia', 'nome_fantasia', 'varchar', 45, array());
        $this->metadata()->addField('ativo', 'ativo', 'boolean', 1, array('default' => '1'));

        
        $this->metadata()->addRelation('categorias', Lumine_Metadata::ONE_TO_MANY, 'Categoria', 'empresaId', null, null, null);
        $this->metadata()->addRelation('contas', Lumine_Metadata::ONE_TO_MANY, 'Conta', 'empresaId', null, null, null);
        $this->metadata()->addRelation('contatos', Lumine_Metadata::ONE_TO_MANY, 'Contato', 'empresaId', null, null, null);
        $this->metadata()->addRelation('produtos', Lumine_Metadata::ONE_TO_MANY, 'Produto', 'empresaId', null, null, null);
        $this->metadata()->addRelation('recibos', Lumine_Metadata::ONE_TO_MANY, 'Recibo', 'empresaId', null, null, null);
        $this->metadata()->addRelation('servicos', Lumine_Metadata::ONE_TO_MANY, 'Servico', 'empresaId', null, null, null);
        $this->metadata()->addRelation('tarefas', Lumine_Metadata::ONE_TO_MANY, 'Tarefa', 'empresaId', null, null, null);
        $this->metadata()->addRelation('tipodocumentohasempresas', Lumine_Metadata::ONE_TO_MANY, 'TipoDocumentoHasEmpresa', 'empresaId', null, null, null);
        $this->metadata()->addRelation('usuariohasempresas', Lumine_Metadata::ONE_TO_MANY, 'UsuarioHasEmpresa', 'empresaId', null, null, null);
    }

    #### END AUTOCODE


}
