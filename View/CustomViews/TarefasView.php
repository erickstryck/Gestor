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
        //pegar user da empresa
        $user= new Usuario();
        $has=new UsuarioHasEmpresa();
        $user->join($has)->where("empresa_id=".$_SESSION["empresaId"])->find();
        //pegar tarefas da empresa
        $tar=new Tarefa();
        $tar->where("empresa_id=".$_SESSION['empresaId']." and ativo = 1")->find();
        parent::getTemplateByAction("tarefas");
        $usuario=new Usuario();
        $prioridade=new Prioridade();
        $situacao=new Situacao();
        while($tar->fetch()){
            $usuario->get($tar->usuarioId);
            $prioridade->get($tar->prioridadeId);
            $situacao->get($tar->situacaoId);
            parent::$templator->setVariable("id",Convert::zeroEsquerda($tar->id));
            parent::$templator->setVariable("date",$tar->data);
            parent::$templator->setVariable("user",$usuario->nomeCompleto);
            parent::$templator->setVariable("prioridade",$prioridade->des);
            parent::$templator->setVariable("situacao",$situacao->des);
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