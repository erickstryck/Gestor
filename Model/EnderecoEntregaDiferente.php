<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "endereco_entrega_diferente"
 * in 2015-10-02
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Model
 *
 */
class EnderecoEntregaDiferente extends Lumine_Base
{


    public $id;
    public $cpfCnpj;
    public $cep;
    public $endereco;
    public $numero;
    public $complemento;
    public $bairro;
    public $pontoReferencia;
    public $cidadeId;
    public $contatohasenderecoentregadiferentes = array();


    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('endereco_entrega_diferente');
        $this->metadata()->setPackage('Model');

        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes

        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('cpfCnpj', 'cpf_cnpj', 'varchar', 45, array());
        $this->metadata()->addField('cep', 'cep', 'varchar', 45, array());
        $this->metadata()->addField('endereco', 'endereco', 'varchar', 200, array());
        $this->metadata()->addField('numero', 'numero', 'int', 11, array());
        $this->metadata()->addField('complemento', 'complemento', 'varchar', 500, array());
        $this->metadata()->addField('bairro', 'bairro', 'varchar', 150, array());
        $this->metadata()->addField('pontoReferencia', 'ponto_referencia', 'varchar', 500, array());
        $this->metadata()->addField('cidadeId', 'cidade_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Cidade'));


        $this->metadata()->addRelation('contatohasenderecoentregadiferentes', Lumine_Metadata::ONE_TO_MANY, 'ContatoHasEnderecoEntregaDiferente', 'enderecoEntregaDiferenteId', null, null, null);
    }

    #### END AUTOCODE


}
