<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "usuario_has_empresa"
 * in 2015-09-22
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class UsuarioHasEmpresa extends Lumine_Base {

    
    public $isAdmin;
    public $isTecnico;
    public $isVendedor;
    public $comissaoProduto;
    public $comissaoVendedor;
    public $temAcesso;
    public $usuarioId;
    public $empresaId;
    public $ativo;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('usuario_has_empresa');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('isAdmin', 'is_admin', 'boolean', 1, array('default' => '0'));
        $this->metadata()->addField('isTecnico', 'is_tecnico', 'boolean', 1, array('default' => '0'));
        $this->metadata()->addField('isVendedor', 'is_vendedor', 'boolean', 1, array('default' => '0'));
        $this->metadata()->addField('comissaoProduto', 'comissao_produto', 'double', null, array());
        $this->metadata()->addField('comissaoVendedor', 'comissao_vendedor', 'double', null, array());
        $this->metadata()->addField('temAcesso', 'tem_acesso', 'boolean', 1, array('default' => '0'));
        $this->metadata()->addField('usuarioId', 'usuario_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Usuario'));
        $this->metadata()->addField('empresaId', 'empresa_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Empresa'));
        $this->metadata()->addField('ativo', 'ativo', 'boolean', 1, array('default' => '1'));

        
    }

    #### END AUTOCODE


}
