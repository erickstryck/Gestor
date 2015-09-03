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
        Lumine::import("Usuario");
        Lumine::import("UsuarioHasEmpresa");
        $user= new Usuario();
        $has=new UsuarioHasEmpresa();
        $user->join($has)->where("empresa_id=".$_SESSION["empresa_id"])->find();
        parent::getTemplateByAction("tarefas");
        while($user->fetch()){
            parent::$templator->setVariable("id",$user->id);
            parent::$templator->setVariable("user",$user->nomeCompleto);
            parent::$templator->addBlock("dest");
        }
        parent::show();
    }
}