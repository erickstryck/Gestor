<?php
require_once(PATH . 'Controller' . DS . 'GenericController.php');

class Empresa extends GenericController
{

    public function __construct()
    {
    }

    public function cadastro($arg)
    {
        Lumine::import("Empresa")
    }


}