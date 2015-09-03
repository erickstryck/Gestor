<?php
require_once(PATH.'Controller'.DS.'GenericController.php');
require_once(PATH.'View'.DS.'CustomViews'.DS.'TarefasView.php');
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 27/08/2015
 * Time: 12:57
 */
class Tarefas extends GenericController{

    /**
     * Tarefas constructor.
     */
    private $tarefasView;
    public function __construct()
    {
        $this->tarefasView=new TarefasView();
    }
    function tarefasView(){
        $this->tarefasView->tarefaView();
    }

    function gravarTarefa($arg){
        Lumine::import("Tarefa");
        $tarefa=new Tarefa();
        $tarefa->descricao=$arg['descricao'];
        $tarefa->prioridadeIdprioridade=$arg['prioridade'];
        $tarefa->titulo=$arg['titulo'];
        $tarefa->situacaoIdsituacao=$arg['situacao'];
        $tarefa->usuarioId=$arg['usuario'];
    }
}