<?php
require_once(PATH . 'Controller' . DS . 'GenericController.php');
require_once(PATH . 'View' . DS . 'CustomViews' . DS . 'AutenticarView.php');
require_once(PATH . 'View' . DS . 'CustomViews' . DS . 'HomeView.php');

class Autenticar extends GenericController
{
    private $autenticarView;

    public function __construct()
    {
        $this->autenticarView = new AutenticarView();
    }

    public function loginView($arg)
    {
        $this->autenticarView->loginView($arg);
    }

    public function empresa($arg)
    {
        $id = (int)$arg['id'];
        $home = new HomeView();

        Lumine::import("Empresa");
        Lumine::import("UsuarioHasEmpresa");

        $associativa = new UsuarioHasEmpresa();
        $empresa = new Empresa();

        $empresa->join($associativa)->where("empresa_id  = $id and usuario_id = " . $_SESSION['usuarioId'])->find();
        $empresa->fetch(true);

        if ($empresa->usuarioId != $_SESSION['usuarioId'])
            die("Você não pode acessar essa empresa");
        else
            $home->indexView();
    
    }


    public function login($arg)
    {
        Lumine::import("Usuario");

        $usuario = new Usuario();
        $usuario->where("login = '" . $arg['login'] . "' and senha = '" . $arg['senha'] . "' and ativo = 1")->find();
        $usuario->fetch(true);

        if (empty($usuario->login))//Se isso for nulo, quer dizer que não for retornado nada do banco.
            $this->autenticarView->sendAjax(array('status' => false, 'msg' => 'Login ou senha inválido.'));

        //registrar id do usuário na sessão:

        $_SESSION['usuarioId'] = (int)$usuario->id;

        $this->autenticarView->sendAjax(array('status' => true));
    }

    public function empresaView()
    {

        $this->autenticarView->loginEmpresaView();
    }

}