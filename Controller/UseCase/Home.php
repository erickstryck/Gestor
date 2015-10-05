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
//        $data = $arg['data'];
        //Verificar: 
        //Contas (Pagar/Receber)
        //Tarefas; 
        
        $array = array();

        Lumine::import('Conta');
        $events = $this->getTarefasEvent();
        die($events);
        $contas = new Conta(); 
        $contas->where(" FORMAT(data_vencimento, 'YYYY-MM') = FORMAT($data, 'YYYY-MM') ")->find(); 

        var_dump($contas->allToArray());
    }

    public function getTarefasEvent()
    {
        Lumine::import("Usuario");
        Lumine::import("UsuarioHasEmpresa");
        Lumine::import("Tarefa");
        Lumine::import("Prioridade");
        Lumine::import("Situacao");
        //pegar user da empresa
        $user = new Usuario();
        $has = new UsuarioHasEmpresa();
        $user->join($has)->where("empresa_id=" . $_SESSION["empresaId"])->find();
        //pegar tarefas da empresa
        $tar = new Tarefa();
        $tar->select('titulo,data')->where("empresa_id=" . $_SESSION['empresaId'] . " and ativo = 1")->find();
//        $arrayJS = $this->getNiceArray($tar->allToArray());
//        $arrJS = array('events' => $arrayJS, 'color' => 'red', 'textColor' => 'white');
//        return json_encode($arrJS);
        return $this->getNiceArray($tar->allToArray());
    }

    public function getNiceArray($badArray)
    {
        $arrTar = array();
        foreach ($badArray as $value) {
            $temp = array('title' => $value['titulo'], 'start' => $value['data']);
            array_push($arrTar, $temp);
        }
        return json_encode($arrTar);
    }
}