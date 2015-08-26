<?php
#### START AUTOCODE
/**
 * Classe generada para a tabela "produto"
 * in 2015-08-26
 * @author Hugo Ferreira da Silva
 * @link http://www.hufersil.com.br/lumine
 * @package Modal
 *
 */

class Produto extends Lumine_Base {

    
    public $id;
    public $naoControlarEstoque;
    public $arquivar;
    public $precoCusto;
    public $precoVenda;
    public $eanGtin;
    public $excecaoIpi;
    public $estoqueMinimo;
    public $estoqueAtual;
    public $palavraChave;
    public $ncm;
    public $anotacoesInternas;
    public $nome;
    public $codigoPersonalizado;
    public $margemLucro;
    public $inforNfe;
    public $empresaId;
    public $categoriahasprodutos = array();
    public $mudancaestoques = array();
    public $pedidovendahasprodutos = array();
    
    
    
    /**
     * Inicia os valores da classe
     * @author Hugo Ferreira da Silva
     * @return void
     */
    protected function _initialize()
    {
        $this->metadata()->setTablename('produto');
        $this->metadata()->setPackage('Modal');
        
        # nome_do_membro, nome_da_coluna, tipo, comprimento, opcoes
        
        $this->metadata()->addField('id', 'id', 'int', 11, array('primary' => true, 'notnull' => true, 'autoincrement' => true));
        $this->metadata()->addField('naoControlarEstoque', 'nao_controlar_estoque', 'boolean', 1, array());
        $this->metadata()->addField('arquivar', 'arquivar', 'boolean', 1, array());
        $this->metadata()->addField('precoCusto', 'preco_custo', 'double', null, array());
        $this->metadata()->addField('precoVenda', 'preco_venda', 'double', null, array());
        $this->metadata()->addField('eanGtin', 'ean_gtin', 'varchar', 45, array());
        $this->metadata()->addField('excecaoIpi', 'excecao_ipi', 'varchar', 45, array());
        $this->metadata()->addField('estoqueMinimo', 'estoque_minimo', 'int', 11, array());
        $this->metadata()->addField('estoqueAtual', 'estoque_atual', 'int', 11, array());
        $this->metadata()->addField('palavraChave', 'palavra_chave', 'varchar', 60, array());
        $this->metadata()->addField('ncm', 'ncm', 'varchar', 45, array());
        $this->metadata()->addField('anotacoesInternas', 'anotacoes_internas', 'varchar', 45, array());
        $this->metadata()->addField('nome', 'nome', 'varchar', 45, array());
        $this->metadata()->addField('codigoPersonalizado', 'codigo_personalizado', 'varchar', 60, array());
        $this->metadata()->addField('margemLucro', 'margem_lucro', 'double', null, array());
        $this->metadata()->addField('inforNfe', 'infor_nfe', 'varchar', 45, array());
        $this->metadata()->addField('empresaId', 'empresa_id', 'int', 11, array('notnull' => true, 'foreign' => '1', 'onUpdate' => 'RESTRICT', 'onDelete' => 'RESTRICT', 'linkOn' => 'id', 'class' => 'Empresa'));

        
        $this->metadata()->addRelation('categoriahasprodutos', Lumine_Metadata::ONE_TO_MANY, 'CategoriaHasProduto', 'produtoId', null, null, null);
        $this->metadata()->addRelation('mudancaestoques', Lumine_Metadata::ONE_TO_MANY, 'MudancaEstoque', 'produtoId', null, null, null);
        $this->metadata()->addRelation('pedidovendahasprodutos', Lumine_Metadata::ONE_TO_MANY, 'PedidoVendaHasProduto', 'produtoId', null, null, null);
    }

    #### END AUTOCODE


}
