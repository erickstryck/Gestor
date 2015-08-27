<?php
require_once(PATH.'View'.DS.'GenericView.php');
require_once(PATH.'Util'.DS.'Convert.php');
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 27/08/2015
 * Time: 12:58
 */
class TarefasView extends GenericView{

    /**
     * TarefasView constructor.
     */
    public function __construct()
    {
        parent::__construct($this);
    }

    function tarefaView(){
        parent::getTemplateByAction("tarefas");
        parent::show();
    }
}