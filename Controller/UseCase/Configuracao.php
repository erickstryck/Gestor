<?php
require_once(PATH . 'Controller' . DS . 'GenericController.php');
require_once(PATH . 'View' . DS . 'CustomViews' . DS . 'ConfiguracaoView.php');
/**
 * Created by PhpStorm.
 * User: Erick Batista
 * Date: 13/10/2015
 * Time: 09:21
 */
class Configuracao extends GenericController
{
    private $configView;
    public function __construct(){
        $this->configView=new ConfiguracaoView();
    }
    /**
     * @Permissao({"administrador"})
     */
    function showView(){
        $this->configView->configView();
    }
    public function getObject($arg){
        Lumine::import("Empresa");
        $empresa=new Empresa();
        $empresa->get($_SESSION["empresaId"]);
        $empresa->fetch(true);
        $this->configView->sendAjax($empresa->toArray());
    }
    public function alterar($arg)
    {
        Lumine::import("Empresa");
        $empresa=new Empresa();
        $empresa->get($_SESSION["empresaId"]);
        $empresa->fetch(true);
        $empresa->cpfCnpj=$arg['cpfCnpj'];
            $empresa->razaoSocial=$arg['razaoSocial'];
                $empresa->nome=$arg['nome'];
                    $empresa->telFixo=$arg['telFixo'];
                        $empresa->telCelular=$arg['telCelular'];
                            $empresa->emailPrincipal=$arg['emailPrincipal'];
        $empresa->update();
        $this->configView->sendAjax(array('status' => true, 'msg' => 'Os dados foram alterados!'));
    }
}