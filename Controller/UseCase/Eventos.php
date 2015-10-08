<?php
require_once(PATH . 'Controller' . DS . 'GenericController.php');
require_once(PATH . 'View' . DS . 'CustomViews' . DS . 'LogView.php');

/**
 * Created by PhpStorm.
 * User: desenvolvedor
 * Date: 16/09/15
 * Time: 08:57
 */
class Eventos extends GenericController
{
    private $logView;

    public function __construct()
    {
        $this->logView = new LogView();
    }

    /**
     * @Permissao({"administrador"})
     */
    function logView($arg)
    {
        $this->logView->showView($arg);
    }
}