<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "tipo_documento"
 * in 2015-11-03
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */

class TipoDocumento extends Lumine_Base {

    
    public $id;
    public $des;
    public $contas = array();
    public $parcelas = array();
    public $tipodocumentohasempresas = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('tipo_documento');
        $this->metadata()->setPackage('Model');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('des', 'des', 'varchar', 45, array());

        
        $this->metadata()->addRelation('contas', Lumine_Metadata::ONE_TO_MANY, 'Conta', 'tipoDocumentoId', null, null, null);
        $this->metadata()->addRelation('parcelas', Lumine_Metadata::ONE_TO_MANY, 'Parcela', 'tipoDocumentoId', null, null, null);
        $this->metadata()->addRelation('tipodocumentohasempresas', Lumine_Metadata::ONE_TO_MANY, 'TipoDocumentoHasEmpresa', 'tipoDocumentoId', null, null, null);
    }

    #### END AUTOCODE


}
