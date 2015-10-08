<?php
require_once(PATH . 'Controller' . DS . 'GenericController.php');

class Cadastro extends GenericController
{

    public function __construct()
    {
    }

    public function cadastrar($arg)
    {
        Lumine::import("Empresa");
        Lumine::import("Usuario");
        Lumine::import("UsuarioHasEmpresa");

        //Todo o usuário que se cadastra junto com uma empresa é considerado o
        //Adminstrador da mesma.
        //Verificando se há alguma empresa com a mesma razão sicial:
        $empresa = new Empresa();
        $total = $empresa->get('nome', $arg['nome']);

        if (empty($arg['nome']) || empty($arg['telFixo']) || empty($arg['telCelular']) || empty($arg['emailPrincipal']) || empty($arg['estadoId']) || empty($arg['nomeCompleto']) || empty($arg['email']) || empty($arg['login']) || empty($arg['senha']))
            die(json_encode(array('status' => false, 'msg' => 'Alguns dos campos requeridos estão vazios.')));

        if ($total > 0)
            die(json_encode(array('status' => false, 'msg' => 'O nome da empresa já existe.')));

        $empresa = new Empresa();
        $total = $empresa->get('emailPrincipal', $arg['emailPrincipal']);

        if ($total > 0)
            die(json_encode(array('status' => false, 'msg' => 'O e-mail da sua empresa já foi cadastrado')));

        $usuario = new Usuario();
        $total = $usuario->get('email', $arg['email']);

        if ($total > 0)
            die(json_encode(array('status' => false, 'msg' => 'O seu endereço de e-mail já foi cadastrado')));

        $usuario = new Usuario();
        $total = $usuario->get('login', $arg['login']);

        if ($total > 0)
            die(json_encode(array('status' => false, 'msg' => 'O seu nome de login já foi cadastrado no sistema')));

        if (strcmp($arg['senha'], $arg['senhaConfirmacao']) != 0)
            die(json_encode(array('status' => false, 'msg' => 'As senhas não são iguais.')));

        //Começar a persistências dos dados.

        $empresa = new Empresa();
        $empresa->nome = $arg['nome'];
        $empresa->telFixo = $arg['telFixo'];
        $empresa->telCeluar = $arg['telCelular'];
        $empresa->emailPrincipal = $arg['emailPrincipal'];
        $empresa->estadoId = $arg['estadoId'];

        $empresa->insert();

        $usuario = new Usuario();
        $usuario->nomeCompleto = $arg['nomeCompleto'];
        $usuario->email = $arg['email'];
        $usuario->login = $arg['login'];
        $usuario->senha = $arg['senha'];

        $usuario->insert();

        $associativa = new UsuarioHasEmpresa();

        $associativa->isTecnico = 1;
        $associativa->isVendedor = 1;
        $associativa->isAdmin = 1;

        // $associativa->comissaoVendedor = 0;
        // $associativa->comissaoProduto  = 0;
        $associativa->temAcesso = 1;

        $associativa->usuarioId = (int)$usuario->id;
        $associativa->empresaId = (int)$empresa->id;
        $associativa->insert();

        //Se tudo ocorreu bem, mandar a mensagem de que tudo ocorreu bemm :v

        die(json_encode(array('status' => true, 'msg' => 'cadastro feito com sucesso')));
    }


}