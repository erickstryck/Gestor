<?php
require_once(PATH . 'Controller' . DS . 'GenericController.php');
require_once(PATH . 'View' . DS . 'CustomViews' . DS . 'ConfiguracaoView.php');
/**
 * Created by PhpStorm.
 * User: Erick Batista
 * Date: 13/10/2015
 * Time: 09:21
 */
class Configuracao extends GenericController
{
    private $configView;
    public function __construct(){
        $this->configView=new ConfiguracaoView();
    }
    /**
     * @Permissao({"administrador"})
     */
    function showView(){
        $this->configView->configView();
    }
}