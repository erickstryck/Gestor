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
        Lumine::import("Prioridade");
        Lumine::import("Situacao");
        //pegar user da empresa
        $user = new Usuario();
        $has = new UsuarioHasEmpresa();
        $situacao = new Situacao();
        $user->join($has)->where("empresa_id=" . $_SESSION["empresaId"])->find();
        //pegar tarefas da empresa
        $tar = new Tarefa();
        $prioridade = new Prioridade();
        $situacao->alias('s');
        $prioridade->alias('p');
        $tar->join($prioridade);
        $tar->join($situacao);
        $tar->select('titulo as title, data as start, p.des as prioridade,s.des as situacao')->where("empresa_id=" . $_SESSION['empresaId'] . " and ativo = 1 and tarefa_ativa=1")->find();
        return $this->getNiceArray($tar->allToArray());
    }

    public function getNiceArray($badArray)
    {
        $arrTar = array();
        foreach ($badArray as $value) {
            if ($value['prioridade'] === "Baixa") $temp = array('title' => $value['title'], 'start' => $value['start'], 'color' => 'green', 'textColor' => 'white');
            if ($value['prioridade'] === "Normal") $temp = array('title' => $value['title'], 'start' => $value['start'], 'color' => 'yellow', 'textColor' => 'black');
            if ($value['prioridade'] === "Alta") $temp = array('title' => $value['title'], 'start' => $value['start'], 'color' => 'red', 'textColor' => 'white');
            if ($value['situacao'] === "Finalizada") $temp = array('title' => $value['title'], 'start' => $value['start'], 'color' => 'black', 'textColor' => 'white');
            array_push($arrTar, $temp);
        }
        return $arrTar;
    }
}