<?php
require_once(PATH . 'View' . DS . 'GenericView.php');
require_once(PATH . 'Util' . DS . 'Convert.php');

class ContaRecipienteView extends GenericView
{

    public function __construct()
    {
        parent::__construct($this);
    }

    public function novoRecipienteView()
    {
        parent::getTemplateByAction('novoRecipiente');
        Lumine::import('Recipiente');
        $recipiente = new Recipiente();

        $recipiente->where(' empresa_id = ' . $_SESSION['empresaId'] . ' and ativo = 1 ')->limit(500)->find();

        while ($recipiente->fetch()) {
            parent::$templator->setVariable('recipiente.id', Convert::zeroEsquerda($recipiente->id));
            parent::$templator->setVariable('recipiente.apelido', $recipiente->apelido);
            parent::$templator->setVariable('recipiente.descricao', $recipiente->des);
            parent::$templator->addBlock('row');
        }

        parent::show();
    }
}