<?php
require_once(PATH . 'View' . DS . 'GenericView.php');
require_once(PATH . 'Util' . DS . 'Convert.php');
/**
 * Created by PhpStorm.
 * User: Erick Batista
 * Date: 13/10/2015
 * Time: 09:26
 */
class ConfiguracaoView extends GenericView
{
    /**
     * ConfiguracaoView constructor.
     */
    public function __construct()
    {
        parent::__construct($this);
    }

    function configView(){
        Lumine::import("Empresa");
        $empresa=new Empresa();
        $empresa->get($_SESSION["empresaId"]);
        parent::getTemplateByAction("configuracao");
        parent::$templator->setVariable("CPF_CNPJ",$empresa->cpfCnpj);
        parent::$templator->setVariable("nome",$empresa->nome);
        parent::$templator->setVariable("razao_social",$empresa->razaoSocial);
        parent::$templator->setVariable("tel_fixo",$empresa->telFixo);
        parent::$templator->setVariable("tel_celular",$empresa->telCelular);
        parent::$templator->setVariable("email_principal",$empresa->emailPrincipal);
        parent::show();
    }

}