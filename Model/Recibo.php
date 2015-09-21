<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "recibo"
 * in 2015-09-21
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class Recibo extends Lumine_Base {

    
    public $id;
    public $valorPago;
    public $emissor;
    public $recebidoDe;
    public $cpfCnpj;
    public $dataRecibo;
    public $referente;
    public $contatoId;
    public $viasId;
    public $empresaId;
    public $ativo;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('recibo');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('valorPago', 'valor_pago', 'double', null, array());
        $this->metadata()->addField('emissor', 'emissor', 'varchar', 45, array());
        $this->metadata()->addField('recebidoDe', 'recebido_de', 'varchar', 140, array());
        $this->metadata()->addField('cpfCnpj', 'cpf_cnpj', 'varchar', 45, array());
        $this->metadata()->addField('dataRecibo', 'data_recibo', 'date', null, array());
        $this->metadata()->addField('referente', 'referente', 'varchar', 500, array());
        $this->metadata()->addField('contatoId', 'contato_id', 'int', 11, array('foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Contato'));
        $this->metadata()->addField('viasId', 'vias_id', 'int', 11, array('foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Vias'));
        $this->metadata()->addField('empresaId', 'empresa_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Empresa'));
        $this->metadata()->addField('ativo', 'ativo', 'boolean', 1, array('default' => '1'));

        
    }

    #### END AUTOCODE


}
