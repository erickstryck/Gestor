<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "tipo_documento_has_empresa"
 * in 2015-09-16
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class TipoDocumentoHasEmpresa extends Lumine_Base {

    
    public $tipoDocumentoId;
    public $empresaId;
    public $custoInterno;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('tipo_documento_has_empresa');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('tipoDocumentoId', 'tipo_documento_id', 'int', 11, array('primary' => true, 'notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'TipoDocumento'));
        $this->metadata()->addField('empresaId', 'empresa_id', 'int', 11, array('primary' => true, 'notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Empresa'));
        $this->metadata()->addField('custoInterno', 'custo_interno', 'double', null, array());

        
    }

    #### END AUTOCODE


}
