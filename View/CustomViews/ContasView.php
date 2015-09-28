<?php
require_once(PATH . 'View' . DS . 'GenericView.php');
require_once(PATH . 'Util' . DS . 'Convert.php');

class ContasView extends GenericView
{

    public function __construct()
    {
        parent::__construct($this);
    }

    public function novoPagamentoView()
    {
        parent::getTemplateByAction('contasPagar');
        self::novaConta();

        //anexando elementos a tabela:
        Lumine::import("Conta");
        Lumine::import("Contato");
        Lumine::import("PlanoConta");
        Lumine::import("Recipiente");
        Lumine::import("TipoDocumento");

        $conta = new Conta();

        $conta->where("empresa_id = " . $_SESSION['empresaId'] . " and receber = 0 and ativo = 1")->order('data_vencimento DESC')->limit(200)->find();
        while ($conta->fetch()) {
            parent::$templator->setVariable('conta.id', Convert::zeroEsquerda($conta->id));
            parent::$templator->setVariable('conta.descricao', $conta->descricao);

            $contato = new Contato();
            $contato->get($conta->contatoId);

            parent::$templator->setVariable('conta.contato', $contato->nomeFantasia);

            $tipo = new TipoDocumento();
            $tipo->get($tipo->tipoDocumentoId);

            parent::$templator->setVariable('conta.tipo_doc', $tipo->des);
            parent::$templator->setVariable('conta.nro_doc', $conta->numeroDocumento);
            parent::$templator->setVariable('conta.situcao', (((bool)$conta->paga) ? "Paga" : "<i style='color:red;'> Pendente </i>"));
            parent::$templator->setVariable('conta.vencimento', $conta->dataVencimento);
            parent::$templator->setVariable('conta.data_pagamento', $conta->dataPagamento);
            parent::$templator->setVariable('conta.valor', $conta->valor);
            parent::$templator->setVariable('conta.valor_pago', $conta->valorPagamento);

            parent::$templator->addBlock('row');
        }

        //Adicionando plano de contas  para contas a pagar.
        $plano = new PlanoConta();
        $plano->where('id <= 38')->find();

        while ($plano->fetch()) {
            parent::$templator->setVariable('plano_conta.id', $plano->id);
            parent::$templator->setVariable('plano_conta.des', Convert::toUTF_8((($plano->label) ? '--' . $plano->des . '--' : $plano->des)));
            parent::$templator->setVariable('disabled', (($plano->label) ? 'disabled' : ''));
            parent::$templator->addBlock('plano_conta');
        }

        $recipiente = new Recipiente();
        $recipiente->where("empresa_id = " . $_SESSION['empresaId'] . " and ativo = 1")->find();

        while ($recipiente->fetch()) {
            parent::$templator->setVariable('recipiente.id', $recipiente->id);
            parent::$templator->setVariable('recipiente.des', $recipiente->des);
            parent::$templator->addblock('recipiente');
        }

        parent::show();
    }

    private function novaConta()
    {
        Lumine::import("TipoDocumento");
        Lumine::import("Intervalo");
        Lumine::import("Contato");
        Lumine::import("CadastrarVezes");

        $tipoDocumento = new TipoDocumento();
        $intervalo = new Intervalo();
        $vezes = new CadastrarVezes();

        $tipoDocumento->find();

        while ($tipoDocumento->fetch()) {
            parent::$templator->setVariable('tipo_documento.id', $tipoDocumento->id);
            parent::$templator->setVariable('tipo_documento.des', Convert::toUTF_8($tipoDocumento->des));

            parent::$templator->addBlock('tipo_documento');
        }

        $intervalo->find();

        while ($intervalo->fetch()) {
            parent::$templator->setVariable('intervalo.id', (int)$intervalo->id);
            parent::$templator->setVariable('intervalo.des', Convert::toUTF_8($intervalo->des));

            parent::$templator->addBlock('intervalo');
        }

        $vezes->find();

        while ($vezes->fetch()) {
            parent::$templator->setVariable('cadastrar_vezes.id', $vezes->id);
            parent::$templator->setVariable('cadastrar_vezes.des', Convert::toUTF_8($vezes->des));
            parent::$templator->addBlock('cadastrar_vezes');
        }

        $contato = new Contato();
        $contato->where("empresa_id = " . (int)$_SESSION['empresaId'] . " and ativo = 1")->find();

        while ($contato->fetch()) {
            parent::$templator->setVariable('contato.id', $contato->id);
            parent::$templator->setVariable('contato.des', Convert::toUTF_8($contato->nomeFantasia));
            parent::$templator->addBlock('contato');
        }


        //Adicionando data atual para o lançamento:
        parent::$templator->setVariable('date_now', date('Y-m-d'));
    }

    public function novoRecebimentoView()
    {
        parent::getTemplateByAction('contasReceber');
        self::novaConta();

        //anexando elementos a tabela:
        Lumine::import("Conta");
        Lumine::import("Contato");
        Lumine::import("PlanoConta");
        Lumine::import("Recipiente");
        Lumine::import("TipoDocumento");

        $conta = new Conta();

        $conta->where("empresa_id = " . $_SESSION['empresaId'] . " and receber = 1 and ativo = 1 ")->limit(500)->find();
        while ($conta->fetch()) {
            parent::$templator->setVariable('conta.id', Convert::zeroEsquerda($conta->id));
            parent::$templator->setVariable('conta.descricao', $conta->descricao);

            $contato = new Contato();
            $contato->get($conta->contatoId);

            parent::$templator->setVariable('conta.contato', $contato->nomeFantasia);

            $tipo = new TipoDocumento();
            $tipo->get($tipo->tipoDocumentoId);

            parent::$templator->setVariable('conta.tipo_doc', $tipo->des);
            parent::$templator->setVariable('conta.nro_doc', $conta->numeroDocumento);
            parent::$templator->setVariable('conta.situcao', (((bool)$conta->paga) ? "Paga" : "<i style='color:red;'> Pendente </i>"));
            parent::$templator->setVariable('conta.vencimento', $conta->dataVencimento);
            parent::$templator->setVariable('conta.data_pagamento', $conta->dataPagamento);
            parent::$templator->setVariable('conta.valor', $conta->valor);
            parent::$templator->setVariable('conta.valor_pago', $conta->valorPagamento);

            parent::$templator->addBlock('row');
        }

        $plano = new PlanoConta();
        $plano->where('id > 38')->find();

        while ($plano->fetch()) {
            parent::$templator->setVariable('plano_conta.id', $plano->id);
            parent::$templator->setVariable('plano_conta.des', Convert::toUTF_8((($plano->label) ? '--' . $plano->des . '--' : $plano->des)));
            parent::$templator->setVariable('disabled', (($plano->label) ? 'disabled' : ''));
            parent::$templator->addBlock('plano_conta');
        }

        $recipiente = new Recipiente();
        $recipiente->where("empresa_id = " . $_SESSION['empresaId'] . " and ativo = 1")->find();

        while ($recipiente->fetch()) {
            parent::$templator->setVariable('recipiente.id', $recipiente->id);
            parent::$templator->setVariable('recipiente.des', $recipiente->des);
            parent::$templator->addblock('recipiente');
        }

        parent::show();
    }


}