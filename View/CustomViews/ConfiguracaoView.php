<?php
require_once(PATH . 'View' . DS . 'GenericView.php');
require_once(PATH . 'Util' . DS . 'Convert.php');
/**
 * Created by PhpStorm.
 * User: Erick Batista
 * Date: 13/10/2015
 * Time: 09:26
 */
class ConfiguracaoView extends GenericView
{
    /**
     * ConfiguracaoView constructor.
     */
    public function __construct()
    {
        parent::__construct($this);
    }

    function configView(){
        parent::getTemplateByAction("configuracao");
        parent::show();
    }
}