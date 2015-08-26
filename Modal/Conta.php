<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "conta"
 * in 2015-08-26
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Modal
 *
 */

class Conta extends Lumine_Base {

    
    public $id;
    public $receber;
    public $descricao;
    public $dataLancamento;
    public $dataVencimento;
    public $valorCobrado;
    public $isCaixaInterno;
    public $numeroDocumento;
    public $apenasPrevisao;
    public $pagarAgora;
    public $observacoes;
    public $palavra-chave;
    public $empresaId;
    public $cadastrarVezesId;
    public $planoContaId;
    public $contaOrigemId;
    public $intervaloId;
    public $contatoId;
    public $tipoDocumentoId;
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('conta');
        $this->metadata()->setPackage('Modal');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('receber', 'receber', 'boolean', 1, array());
        $this->metadata()->addField('descricao', 'descricao', 'varchar', 45, array());
        $this->metadata()->addField('dataLancamento', 'data_lancamento', 'datetime', null, array());
        $this->metadata()->addField('dataVencimento', 'data_vencimento', 'datetime', null, array());
        $this->metadata()->addField('valorCobrado', 'valor_cobrado', 'double', null, array());
        $this->metadata()->addField('isCaixaInterno', 'is_caixa_interno', 'int', 11, array());
        $this->metadata()->addField('numeroDocumento', 'numero_documento', 'varchar', 45, array());
        $this->metadata()->addField('apenasPrevisao', 'apenas_previsao', 'boolean', 1, array());
        $this->metadata()->addField('pagarAgora', 'pagar_agora', 'boolean', 1, array());
        $this->metadata()->addField('observacoes', 'observacoes', 'varchar', 5000, array());
        $this->metadata()->addField('palavra-chave', 'palavra-chave', 'varchar', 60, array());
        $this->metadata()->addField('empresaId', 'empresa_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Empresa'));
        $this->metadata()->addField('cadastrarVezesId', 'cadastrar_vezes_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'CadastrarVezes'));
        $this->metadata()->addField('planoContaId', 'plano_conta_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'PlanoConta'));
        $this->metadata()->addField('contaOrigemId', 'conta_origem_id', 'int', 11, array('notnull' => true));
        $this->metadata()->addField('intervaloId', 'intervalo_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'idintervalo', 'class' => 'Intervalo'));
        $this->metadata()->addField('contatoId', 'contato_id', 'int', 11, array('foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Contato'));
        $this->metadata()->addField('tipoDocumentoId', 'tipo_documento_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'TipoDocumento'));

        
    }

    #### END AUTOCODE


}