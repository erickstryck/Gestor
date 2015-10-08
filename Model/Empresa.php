<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "empresa"
 * in 2015-10-02
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */
class Empresa extends Lumine_Base
{


    public $id;
    public $nome;
    public $ativo;
    public $telFixo;
    public $telCelular;
    public $emailPrincipal;
    public $estadoId;
    public $categorias = array();
    public $contas = array();
    public $contatos = array();
    public $log = array();
    public $produtos = array();
    public $recibos = array();
    public $recipientes = array();
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
        $this->metadata()->addField('nome', 'nome', 'varchar', 45, array());
        $this->metadata()->addField('ativo', 'ativo', 'boolean', 1, array('default' => '1'));
        $this->metadata()->addField('telFixo', 'tel_fixo', 'varchar', 45, array());
        $this->metadata()->addField('telCelular', 'tel_celular', 'varchar', 45, array());
        $this->metadata()->addField('emailPrincipal', 'email_principal', 'varchar', 45, array());
        $this->metadata()->addField('estadoId', 'estado_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Estado'));


        $this->metadata()->addRelation('categorias', Lumine_Metadata::ONE_TO_MANY, 'Categoria', 'empresaId', null, null, null);
        $this->metadata()->addRelation('contas', Lumine_Metadata::ONE_TO_MANY, 'Conta', 'empresaId', null, null, null);
        $this->metadata()->addRelation('contatos', Lumine_Metadata::ONE_TO_MANY, 'Contato', 'empresaId', null, null, null);
        $this->metadata()->addRelation('log', Lumine_Metadata::ONE_TO_MANY, 'Log', 'empresaId', null, null, null);
        $this->metadata()->addRelation('produtos', Lumine_Metadata::ONE_TO_MANY, 'Produto', 'empresaId', null, null, null);
        $this->metadata()->addRelation('recibos', Lumine_Metadata::ONE_TO_MANY, 'Recibo', 'empresaId', null, null, null);
        $this->metadata()->addRelation('recipientes', Lumine_Metadata::ONE_TO_MANY, 'Recipiente', 'empresaId', null, null, null);
        $this->metadata()->addRelation('servicos', Lumine_Metadata::ONE_TO_MANY, 'Servico', 'empresaId', null, null, null);
        $this->metadata()->addRelation('tarefas', Lumine_Metadata::ONE_TO_MANY, 'Tarefa', 'empresaId', null, null, null);
        $this->metadata()->addRelation('tipodocumentohasempresas', Lumine_Metadata::ONE_TO_MANY, 'TipoDocumentoHasEmpresa', 'empresaId', null, null, null);
        $this->metadata()->addRelation('usuariohasempresas', Lumine_Metadata::ONE_TO_MANY, 'UsuarioHasEmpresa', 'empresaId', null, null, null);
    }

    #### END AUTOCODE


}
