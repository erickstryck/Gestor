<?php
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Clientes.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'AjaxServices.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Categorias.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Produtos.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Home.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Servicos.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Usuarios.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Estoques.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Vendas.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'OrdemServico.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Contas.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Tarefas.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Recibos.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Autenticar.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Eventos.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Cadastro.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'ContaRecipiente.php');
require_once(PATH . 'Controller' . DS . 'UseCase' . DS . 'Configuracao.php');
require_once(PATH . 'Security' . DS . 'Firewall.php');
require_once(PATH . 'Security' . DS . 'EventLog.php');

//Visão do controlador central
require_once(PATH . 'View' . DS . 'CustomViews' . DS . 'TelaView.php');

class MainController
{
    private $controllersArray;
    private $telaView;

    public function __construct()
    {
        $this->telaView = new TelaView();

        // incluir todos os controllers espec�ficos aqui;
        $this->controllersArray = array(
            'contas' => new Contas(),
            'clientes' => new Clientes(),
            'ajaxServices' => new AjaxServices(),
            'categorias' => new Categorias(),
            'produtos' => new Produtos(),
            'home' => new Home(),
            'servicos' => new Servicos(),
            'usuarios' => new Usuarios(),
            'estoques' => new Estoques(),
            'vendas' => new Vendas(),
            'ordemServico' => new OrdemServico(),
            'tarefas' => new Tarefas(),
            'recibos' => new Recibos(),
            'autenticar' => new Autenticar(),
            'eventos' => new Eventos(),
            'cadastro' => new Cadastro(),
            'contaRecipiente' => new ContaRecipiente(),
            'config' => new Configuracao()
        );
    }

    public function findMyController()
    {
        // Passos:
        // 1 O useCase est� nas lista de ControllersArray?
        // 2 A action existe no controlador?
        // 3 Invocar método;
        // 4 Gerar output.
        $ev = new EventLog();
        $useCase = $_REQUEST ['uc'];
        $action = $_REQUEST ['a'];

        // if( $this->$controllersArray[$useCase] == null ) return;
        $controller = $this->controllersArray [$useCase];
        $realNameMethod = '';

        $arrayMethods = $controller->sayMyActions();

        foreach ($arrayMethods as $a) {
            if (strcasecmp($a, $action) == 0) {
                $realNameMethod = $a;
                break;
            }
        }

        if (strlen($realNameMethod) == 0) {
            die('Não há ação para ser executada');
        }

        $reflection = new ReflectionMethod ($controller->sayMyName(), $realNameMethod);
        if (Firewall::defender($controller, $realNameMethod)) {
            if (strcmp($_SERVER['REQUEST_METHOD'], 'POST') == 0) {
                $ev->monitoramento('Acesso negado.');
                die(json_encode(array('status' => false, 'msg' => 'Acesso negado.')));
            } else {
                $ev->monitoramento('Acesso negado.');
                $this->telaView->acessoNegado();
            }
        } else $ev->monitoramento('Status OK.');
        return $reflection->invoke($controller, self::preparingArray($_REQUEST));
    }

    private function preparingArray($target)
    {
        $array = array_merge(array(), $target);
        unset ($array ['a']);
        unset ($array ['uc']);
        return $array;
    }

}
