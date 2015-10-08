<?php
require_once(PATH . 'Controller' . DS . 'GenericController.php');
require_once(PATH . 'Util' . DS . 'Convert.php');


//VER A PROBABILIDADE DESSA CLASSE SER VULNERÁVEL A SQL INJECTION. 
//
class AjaxServices extends GenericController
{
    function __construct()
    {
    }

    //Essa função recebe a chave primária de um estado
    //E retorna as cidades do mesmo.

    /**
     * @Permissao({"administrador"})
     */
    public function getCities($arg)
    {
        Lumine::import('Cidade');
        $cidade = new Cidade();
        $cidade->where("cidade.estado_id = " . $arg['id'])->find();
        $array = array();
        while ($cidade->fetch())
            array_push($array, array('id' => $cidade->id, 'des' => Convert::toUpperCase(Convert::toUTF_8($cidade->des))));
        die(json_encode($array));
    }

    /**
     * @Permissao({"administrador"})
     */
    public function getcategoryProfit($arg)
    {
        Lumine::import('Categoria');
        $categoria = new Categoria();
        $categoria->where(" empresa_id = " . $_SESSION['empresaId'] . " and id = " . $arg['id'])->find();

        $array;

        while ($categoria->fetch())
            $array = array("profit" => $categoria->margemLucro);

        die(json_encode($array));
    }

    //Testar esse método contra Sql injection
    /**
     * @Permissao({"administrador"})
     */
    public function getProducts($arg)
    {
        Lumine::import("Produto");
        Lumine::import("Categoria");


        $produto = new Produto();
        $categoria = new Categoria();

        $clausura = "";

        if (!empty($arg['categoria']))
            $clausura .= " and categoria_id = " . $arg['categoria'];
        //NCR = nome, código e referência
        if (!empty($arg['ncr']))
            $clausura .= " and (codigo_personalizado = '" . $arg['ncr'] . "' or  nome = '" . $arg['ncr'] . "' )";

        if (!empty($arg['palavra_chave']))
            $clausura .= " and palavra_chave ='" . $arg['categoria'] . "'";

        if (empty($clausura)) return;

        //Pegar: 
        // codigo_personalizado, produto.id, nome, nome_categoria

        $produto->select('codigo_personalizado,nome,nome_categoria, produto.id as id')->join($categoria)->where("produto.empresa_id = " . $_SESSION['empresaId'] . " and nao_controlar_estoque = 0 and produto.ativo = 1 " . $clausura)->find();

        $array = array();
        while ($produto->fetch()) {
            $categoria = new Categoria();
            $categoria->get("id", $produto->categoriaId);
            array_push($array, array('id' => Convert::zeroEsquerda($produto->id), 'produto' => $produto->nome, 'codigo_personalizado' => $produto->codigoPersonalizado, 'estoque_atual' => $produto->estoqueAtual, 'categoria' => $categoria->nomeCategoria));
        }

        die(json_encode($array));
    }

    /**
     * @Permissao({"administrador"})
     */
    function getProductPrince($arg)
    {
        $id = (int)$arg['produto_id'];
        Lumine::import('Produto');
        $produto = new Produto();
        $produto->get($id);

        die(json_encode(array('prince' => $produto->precoVenda)));
    }
}