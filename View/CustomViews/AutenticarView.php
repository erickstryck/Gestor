<?php
require_once(PATH . 'View' . DS . 'GenericView.php');
require_once(PATH . 'Util' . DS . 'Convert.php');

class AutenticarView extends GenericView
{

    public function __construct()
    {
        parent::__construct($this);
    }

    public function loginView($arg)
    {
        parent::getTemplateByAction('login');
        if (!empty($arg['done'])) {
            parent::$templator->setVariable('is_hide', '');
            parent::$templator->setVariable('msg', 'Seu cadastro foi feito com sucesso. Efetue o login com o seu nome de usuário e senha.');
        } else {
            parent::$templator->setVariable('is_hide', 'hide');
        }
        parent::show();
    }

    public function loginEmpresaView()
    {
        parent::getTemplateByAction('loginEmpresa');
        Lumine::import("UsuarioHasEmpresa");
        Lumine::import("Empresa");

        $associativa = new UsuarioHasEmpresa();

        $associativa->where("usuario_id = " . $_SESSION['usuarioId'])->find();

        while ($associativa->fetch()) {
            $empresa = new Empresa();
            $empresa->get($associativa->usuarioId);

            parent::$templator->setVariable('nome', $empresa->nome);
            parent::$templator->setVariable('id', $empresa->id);
            parent::$templator->addBlock('row');
        }

        parent::show();
    }
}