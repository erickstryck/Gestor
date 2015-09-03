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
        Lumine::import("Tarefa");
        Lumine::import("Prioridade");
        Lumine::import("Situacao");
        $user= new Usuario();
        $has=new UsuarioHasEmpresa();
        $user->join($has)->where("empresa_id=".$_SESSION["empresa_id"])->find();
        $tar=new Tarefa();
        $tar->where("empresa_id=".$_SESSION['empresa_id'])->find();
        parent::getTemplateByAction("tarefas");
        $tempu=new Usuario();
        $tempp=new Prioridade();
        $temps=new Situacao();
        while($tar->fetch()){
            parent::$templator->setVariable("id",Convert::zeroEsquerda($tar->id));
            parent::$templator->setVariable("date",$tar->data);
            parent::$templator->setVariable("user",$tempu->get($tar->usuarioId)->id);
            parent::$templator->setVariable("prioridade",$tempp->get($tar->prioridadeId)->id);
            parent::$templator->setVariable("situacao",$temps->get($tar->situacaoId)->id);
            parent::$templator->setVariable("abreviacao",Convert::minification($tar->descricao,20));
            parent::$templator->setVariable("descricao",$tar->descricao);
            parent::$templator->addBlock("tarefas");
        }
        while($user->fetch()){
            parent::$templator->setVariable("id",$user->id);
            parent::$templator->setVariable("user",$user->nomeCompleto);
            parent::$templator->addBlock("dest");
        }
        parent::show();
    }
}