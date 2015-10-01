<?php 
require_once(PATH . 'View' . DS . 'GenericView.php');
require_once(PATH . 'Util' . DS . 'Convert.php');

class RecipienteView extends GenericView
{

    public function __construct()
    {
        parent::__construct($this);
    }

    public function novoRecipienteView()
    {
        parent::getTemplateByAction('novoRecipiente');
        parent::show();
    }
}