<?php
require_once(PATH . 'Controller' . DS . 'GenericController.php');
require_once(PATH . 'View' . DS . 'CustomViews' . DS . 'HomeView.php');

class Home extends GenericController
{
    private $homeView;

    public function __construct()
    {
        $this->homeView = new HomeView();
    }

    /**
     * @Permissao({"administrador"})
     */
    public function indexView()
    {
        $this->homeView->indexView();
    }

    public function feed($arg){
        $data = $arg['data']; 
        //Verificar: 
        //Contas (Pagar/Receber)
        //Tarefas; 
        
        $array = array(); 

        Lumine::import('Conta'); 
        Lumine::import('Tarefa'); 

        $contas = new Conta(); 
        $contas->where(" FORMAT(data_vencimento, 'YYYY-MM') = FORMAT($data, 'YYYY-MM') ")->find(); 

        var_dump($contas->allToArray()); 
    }
}