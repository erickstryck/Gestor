<?php
require_once(PATH . 'View' . DS . 'GenericView.php');
require_once(PATH . 'Util' . DS . 'Convert.php');

class EstoquesView extends GenericView
{

    public function __construct()
    {
        parent::__construct($this);
    }

    public function novoAjusteView()
    {
        parent::getTemplateByAction('ajusteEstoque');

        Lumine::import("Categoria");
        Lumine::import("Produto");
        Lumine::import("Contato");
        Lumine::import("TipoAjuste");
        Lumine::import("Contato");
        Lumine::import("MudancaEstoque");
        Lumine::import("MudancaEstoqueHasEstoque");

        $categoria = new Categoria();
        $categoria->where('empresa_id = ' . $_SESSION['empresaId'] . " and ativo = 1")->find();

        while ($categoria->fetch()) {
            parent::$templator->setVariable('categoria.id', $categoria->id);
            parent::$templator->setVariable('categoria.nome_categoria', $categoria->nomeCategoria);

            parent::$templator->addBlock('categoria');
        }

        $tipoAjuste = new TipoAjuste();
        $tipoAjuste->find();

        while ($tipoAjuste->fetch()) {
            parent::$templator->setVariable('tipo_ajuste.id', $tipoAjuste->id);
            parent::$templator->setVariable('tipo_ajuste.des', Convert::toUTF_8($tipoAjuste->des));

            parent::$templator->addBlock('tipo_ajuste');
        }


        $contato = new Contato();
        $contato->where("empresa_id = " . $_SESSION['empresaId'] . " and ativo = 1")->find();

        while ($contato->fetch()) {
            parent::$templator->setVariable('contato.id', $contato->id);
            parent::$templator->setVariable('contato.nome_fantasia', Convert::toUTF_8($contato->nomeFantasia));

            parent::$templator->addBlock('contato');
        }


        //ficçando itens na tela da mudança de estoque.
        $produto = new Produto();

        $contato = new Contato();
        $tipo = new Tipoajuste();
        //$associativaContato = new MudancaEstoqueHasEstoque();

        $produto->where('empresa_id = ' . $_SESSION['empresaId'] . " and ativo = 1")->find();

        while ($produto->fetch()) {

            $mudanca = new MudancaEstoque();
            $mudanca->where("produto_id =" . $produto->id)->find();

            while ($mudanca->fetch()) {
                parent::$templator->setVariable('mudanca.id', $mudanca->id);

                $tipo = new TipoAjuste();
                $tipo->get($mudanca->tipoAjusteId);

                parent::$templator->setVariable('mudanca.tipo', Convert::toUTF_8($tipo->des));
                parent::$templator->setVariable('mudanca.obs', $mudanca->obsGerais);
                parent::$templator->setVariable('mudanca.data', $mudanca->dataMudanca);

                parent::$templator->addBlock('row');
            }

        }
        parent::show();
    }
}