<?php
require_once(PATH . 'Controller' . DS . 'GenericController.php');
require_once(PATH . 'View' . DS . 'CustomViews' . DS . 'TarefasView.php');

/**
 * Created by PhpStorm.
 * User: pc
 * Date: 27/08/2015
 * Time: 12:57
 */
class Tarefas extends GenericController
{

    /**
     * Tarefas constructor.
     */
    private $tarefasView;

    public function __construct()
    {
        $this->tarefasView = new TarefasView();
    }

    /**
     * @Permissao({"administrador"})
     */
    function tarefasView()
    {
        $this->tarefasView->tarefaView();
    }

    /**
     * @Permissao({"administrador"})
     */
    function cadastro($arg)
    {
        Lumine::import("Tarefa");
        $tarefa = new Tarefa();
        $tarefa->descricao = $arg['descricao'];
        $tarefa->prioridadeId = $arg['prioridadeId'];
        $tarefa->titulo = $arg['titulo'];
        $tarefa->situacaoId = $arg['situacaoId'];
        $tarefa->usuarioId = $arg['usuarioId'];
        $tarefa->data = $arg['data'];
        $tarefa->pChave = $arg['pChave'];
        $tarefa->ativo = true;
        $tarefa->empresaId = $_SESSION["empresaId"];
        if (array_key_exists('tarefaAtiva', $arg)) $tarefa->tarefaAtiva = true;
        else $tarefa->tarefaAtiva = false;
        $tarefa->insert();
        $this->tarefasView->sendAjax(array('status' => true, 'msg' => 'A tarefa foi registrada!'));
    }

    /**
     * @Permissao({"administrador"})
     */
    public function getObject($arg)
    {
        $id = (int)$arg['id'];
        Lumine::import("Tarefa");
        $tar = new Tarefa();
        $tar->where("empresa_id = " . $_SESSION["empresaId"] . " and id=" . (int)$arg["id"])->find();
        $tar->fetch(true);
        $this->tarefasView->sendAjax($tar->toArray());
    }

    /**
     * @Permissao({"administrador"})
     */
    public function alterar($arg)
    {
        Lumine::import("Tarefa");
        $tarefa = new Tarefa();
        $tarefa->where("empresa_id = " . $_SESSION["empresaId"] . " and id=" . (int)$arg["id"])->find();
        $tarefa->fetch(true);
        $tarefa->descricao = $arg['descricao'];
        $tarefa->prioridadeId = $arg['prioridadeId'];
        $tarefa->titulo = $arg['titulo'];
        $tarefa->situacaoId = $arg['situacaoId'];
        $tarefa->usuarioId = $arg['usuarioId'];
        $tarefa->data = $arg['data'];
        $tarefa->pChave = $arg['pChave'];
        $tarefa->ativo = true;
        $tarefa->empresaId = $_SESSION["empresaId"];
        if (array_key_exists('tarefaAtiva', $arg)) $tarefa->tarefaAtiva = true;
        else $tarefa->tarefaAtiva = false;
        $tarefa->update();
        $this->tarefasView->sendAjax(array('status' => true, 'msg' => 'A tarefa foi alterada!'));
    }

    /**
     * @Permissao({"administrador"})
     */
    function delete($arg)
    {
        Lumine::import("Tarefa");
        $tarefa = new Tarefa();
        $tarefa->where("empresa_id = " . $_SESSION["empresaId"] . " and id=" . (int)$arg["id"])->find();
        $tarefa->fetch(true);
        if ($tarefa->id == null)
            $this->tarefasView->sendAjax(array('status' => false, 'msg' => 'Operação ilegal!'));
        $tarefa->ativo = 0;
        $tarefa->update();
        $this->tarefasView->sendAjax(array('status' => true));
    }
}