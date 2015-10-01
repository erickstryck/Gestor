<?php 
require_once(PATH . 'Controller' . DS . 'GenericController.php');
require_once(PATH . 'View' . DS . 'CustomViews' . DS . 'ContaRecipienteView.php');

class ContaRecipiente extends GenericController
{
    private $contaRecipienteView;

    public function __construct()
    {
        $this->contaRecipienteView = new ContaRecipienteView();
    }

    /**
     * @Permissao({"administrador"})
     */
    public function novoRecipienteView()
    {
        $this->contaRecipienteView->novoRecipienteView();
    }

    /**
     * @Permissão({"adminstrador"})
     */
    public function cadastro($arg){
        /*var_dump($arg); */
        Lumine::import("Recipiente"); 
        $recipiente = new Recipiente(); 

        $recipiente->apelido = $arg['apelido']; 
        $recipiente->des     = $arg['des']; 
        $recipiente->empresaId = $_SESSION['empresaId']; 
        $recipiente->insert(); 

        $this->contaRecipienteView->sendAjax(array('status' => true ) ); 
    }

    /**
     * @Permissão({"adminstrador"})
     */
    public function alterar($arg){
        Lumine::import("Recipiente");   
        $recipiente = new Recipiente(); 

        $recipiente->where('empresa_id = ' . $_SESSION['empresaId'] . ' and id = ' . (int)$arg['id'])->find(); 
        $recipiente->fetch(true); 

        $recipiente->apelido = $arg['apelido']; 
        $recipiente->des     = $arg['des']; 
        $recipiente->update(); 

        $this->contaRecipienteView->sendAjax(array('status' => true ) ); 
    }

    /**
     * @Permissão({"adminstrador"})
     */
    public function delete($arg){
        Lumine::import("Recipiente"); 
        $recipiente = new Recipiente(); 

        $recipiente->where('empresa_id = ' . $_SESSION['empresaId'] . ' and id = ' . (int)$arg['id'])->find(); 
        $recipiente->fetch(true); 

        $recipiente->ativo = 0; 
        $recipiente->update(); 

        $this->contaRecipienteView->sendAjax(array('status' => true ) ); 
    }

    /**
     * @Permissao({"administrador"})
     */
    public function getObject($arg){
        Lumine::import("Recipiente"); 
        $id = (int)$arg['id'];
        $recipiente = new Recipiente(); 

        $recipiente->where('empresa_id = ' . $_SESSION['empresaId'] . ' and id = ' . (int)$arg['id'])->find(); 
        $recipiente->fetch(true); 
        
        $this->contaRecipienteView->sendAjax($recipiente->toArray()); 
    }
}