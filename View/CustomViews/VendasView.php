<?php
require_once(PATH . 'View' . DS . 'GenericView.php');
require_once(PATH . 'Util' . DS . 'Convert.php');

class VendasView extends GenericView
{

    public function __construct()
    {
        parent::__construct($this);
    }

    public function novaVendaView()
    {
        parent::getTemplateByAction('novaVenda');
        Lumine::import("Usuario");
        Lumine::import("UsuarioHasEmpresa");
        Lumine::import("Produto");
        Lumine::import("Contato");

        //Adicionando produtos no modal
        $produto = new Produto();
        $produto->where("empresa_id = " . $_SESSION['empresaId'])->find();

        while ($produto->fetch()) {
            parent::$templator->setVariable('produto.id', $produto->id);
            parent::$templator->setVariable('produto.nome', $produto->nome);

            parent::$templator->addBlock('produto');
        }

        //Adicionando clientes ao modal

        $contato = new Contato();
        $contato->where("empresa_id = " . $_SESSION['empresaId'])->find();

        while ($contato->fetch()) {
            parent::$templator->setVariable('contato.id', $contato->id);
            parent::$templator->setVariable('contato.nome', $contato->nomeFantasia);

            parent::$templator->addBlock('contato');
        }

        //Adicionando vendedores:
        $usuario = new Usuario();
        $associativa = new UsuarioHasEmpresa();


        $associativa->join($usuario)->where("empresa_id = " . $_SESSION['empresaId'])->find();

        while ($associativa->fetch()) {

            if (!$associativa->isVendedor) continue;

            parent::$templator->setVariable('vendedor.id', $associativa->id);
            parent::$templator->setVariable('vendedor.nome', $associativa->nomeCompleto);

            parent::$templator->addBlock('vendedor');
        }

        //Adicionando a data de venda:
        parent::$templator->setVariable('data_venda', date('Y-m-d'));
        parent::show();
    }

    public function orcamentoView($vendaId)
    {
        parent::getTemplateByAction('orcamento');

        Lumine::import("PedidoVenda");
        Lumine::import("PedidoVendaHasProduto");
        Lumine::import("FormaPagamento");
        Lumine::import("Parcela");
        Lumine::import("Contato");
        Lumine::import("Usuario");
        Lumine::import("Local");
        Lumine::import("Cidade");
        Lumine::import("Estado");
        Lumine::import("Pais");

        $usuario = new Usuario();
        $contato = new Contato();
        $pedidoHasProduto = new PedidoVendaHasProduto();
        $pedidoVenda = new PedidoVenda();

        //depois verificar se o total retorna um registro.
        $pedidoVenda->join($usuario)->join($contato)->where("pedido_venda.id = $vendaId")->find();
        $pedidoVenda->fetch(true);
        //Adicionando os dados do cliente:
        parent::$templator->setVariable('razao_social', $pedidoVenda->nomeRazaoSocial);
        parent::$templator->setVariable('nome_fantasia', $pedidoVenda->nomeFantasia);
        parent::$templator->setVariable('cnpj_cpf', $pedidoVenda->cpfCnpj);
        parent::$templator->setVariable('inscri_estadual', $pedidoVenda->inscrEstadual);
        parent::$templator->setVariable('telefone', $pedidoVenda->telefone . ' ' . $pedidoVenda->telefone1 . ' ' . $pedidoVenda->telefone2);
        parent::$templator->setVariable('e_mail', $pedidoVenda->email . ' ' . $pedidoVenda->email1);

        //recuperando o endereço de entrega do cliente cadastrado:
        $local = new Local();
        $cidade = new Cidade();
        $estado = new Estado();
        $pais = new Pais();

        $local->get($pedidoVenda->localId);

        $cidade->get($local->cidadeId);
        $estado->get($cidade->estadoId);
        $pais->get($local->paisId);

        //Preparando a string do endereço:
        $endereco = $local->endereco . ", " . $local->bairro . ", " . $local->numero . ". " . $cidade->des . ", " . $estado->des . ", " . $pais->des;
        parent::$templator->setVariable('endereco', $endereco);

        //Fazendo o status do pedido de compra:

        //Adicionando a situação da compra:
        parent::$templator->setVariable('situacao', ($pedidoVenda->isOrcamento) ? "Orçamento" : "Venda");
        parent::$templator->setVariable('vendedor', $pedidoVenda->nomeCompleto);
        parent::$templator->setVariable('data_criacao', $pedidoVenda->dataVenda);


        //Adicionando os dados de forma de pagamento:
        //
        //Pegado id da forma de pagamento:

        $formaPagamento = new FormaPagamento();
        $formaPagamento->get('pedidoVendaId', $vendaId);


        $parcelas = new Parcela();
        $parcelas->where('forma_pagamento_id = ' . $formaPagamento->id)->find();

        $total = 0;
        while ($parcelas->fetch()) $total++;

        //Preparando label forma pagamento:
        $labelPagamento;
        $arrayParcelas = $parcelas->allToArray();

        switch ($formaPagamento->tipoPagamentoId) {
            case 1:
                $labelPagamento = "Parcelado em " . $total . "x sem entrada.";
                break;
            case 2:
                $temp = $arrayParcelas[0];
                $labelPagamento = "Parcelado em " . ($total - 1) . "x" . $temp['valor'] . " com entrada igual.";
                break;
            case 3:
                $labelPagamento = "Parcelado em " . ($total - 1) . "x " . $arrayParcelas[1]['valor'] . "com entrada de " . $arrayParcelas[0]['valor'];

        }

        parent::$templator->setVariable('forma_pagamento', $labelPagamento);
        //parent::$templator->setVariable('label_total', );

        parent::show();
    }
}