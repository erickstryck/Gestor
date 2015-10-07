<?php
require_once(PATH . 'View' . DS . 'GenericView.php');
require_once(PATH . 'Util' . DS . 'Convert.php');

class TelaView extends GenericView
{

    public function __construct()
    {
        parent::__construct($this);
    }

    public function acessoNegado()
    {
        parent::getTemplateByAction('block');
        parent::show();
    }
}