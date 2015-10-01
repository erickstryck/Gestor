<?php 
require_once(PATH . 'Controller' . DS . 'GenericController.php');
require_once(PATH . 'View' . DS . 'CustomViews' . DS . 'RecipienteView.php');

class Recipiente extends GenericController
{
    private $recipienteView;

    public function __construct()
    {
        $this->recipienteView = new RecipienteView();
    }

    /**
     * @Permissao({"administrador"})
     */
    public function novoRecipienteView()
    {
        $this->recipienteView->novoRecipienteView();
    }

    /**
     * @Permissão({"adminstrador"})
     */
    public function cadastro($arg){
        var_dump($arg); 
    }

   
}