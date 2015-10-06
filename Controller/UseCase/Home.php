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
        
        //$events = $this->getTarefasEvent();
        self::getContas($data); 

        $result = array_merge(self::getTarefasEvent(), self::getContas($data) ); 

       die(json_encode($result));
    }

    private function getContas($data){
        Lumine::import('Conta');
        $data = explode('/',$data); 
        $contas = new Conta(); 
        $contas->select("data_vencimento as start, descricao as title")->where(" MONTH(data_vencimento) = ".$data[1]. " and YEAR(data_vencimento) = ". $data[2] ." and empresa_id=" . $_SESSION['empresaId']." and ativo = 1")->find(); 
        return $contas->allToArray(); 
    }

    public function getTarefasEvent()
    {
        Lumine::import("Usuario");
        Lumine::import("UsuarioHasEmpresa");
        Lumine::import("Tarefa");
        //pegar user da empresa
        $user = new Usuario();
        $has = new UsuarioHasEmpresa();
        $user->join($has)->where("empresa_id=" . $_SESSION["empresaId"])->find();
        //pegar tarefas da empresa
        $tar = new Tarefa();
        $tar->select('titulo as title, data as start')->where("empresa_id=" . $_SESSION['empresaId'] . " and ativo = 1")->find();
//        $arrayJS = $this->getNiceArray($tar->allToArray());
//        $arrJS = array('events' => $arrayJS, 'color' => 'red', 'textColor' => 'white');
//        return json_encode($arrJS);
        return $tar->allToArray();
    }

    // public function getNiceArray($badArray)
    // {
    //     $arrTar = array();
    //     foreach ($badArray as $value) {
    //         $temp = array('title' => $value['title'], 'start' => $value['start']);
    //         array_push($arrTar, $temp);
    //     }
    //     return json_encode($arrTar);
    // }
}