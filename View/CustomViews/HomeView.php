<?php
require_once(PATH . 'View' . DS . 'GenericView.php');
require_once(PATH . 'Util' . DS . 'Convert.php');

class HomeView extends GenericView
{

    public function __construct()
    {
        parent::__construct($this);
    }

    public function indexView()
    {
        parent::getTemplateByAction('home');
        parent::show();
    }
}