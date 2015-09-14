<?php
require_once(PATH . 'View' . DS . 'GenericView.php');
require_once(PATH . 'Util' . DS . 'Convert.php');

class OrdemServicoView extends GenericView
{

    public function __construct()
    {
        parent::__construct($this);
    }

    public function novaOrdemView()
    {
        parent::getTemplateByAction('novaOrdemServico');
        parent::show();

    }
}