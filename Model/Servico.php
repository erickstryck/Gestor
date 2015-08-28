<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "servico"
 * in 2015-08-28
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Servico extends Lumine_Base {

    
    public $id;
    public $nomeServico;
    public $preco;
    public $palavraChave;
    public $empresaId;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('servico');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('nomeServico', 'nome_servico', 'varchar', 200, array());
        $this->metadata()->addField('preco', 'preco', 'double', null, array());
        $this->metadata()->addField('palavraChave', 'palavra_chave', 'varchar', 60, array());
        $this->metadata()->addField('empresaId', 'empresa_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Empresa'));

        
    }

    #### END AUTOCODE


}
