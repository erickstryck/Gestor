<?php
require_once(PATH . 'Security' . DS . 'Firewall.php');

/**
 * Created by PhpStorm.
 * User: desenvolvedor
 * Date: 15/09/15
 * Time: 12:00
 */
class EventLog
{
    private $firewall;

    public function __construct()
    {
        $this->firewall = new Firewall();
    }

    public function monitoramento($msg)
    {

        //Caso o usuário não estiver autenticado no sistema, este método não pode executar todo o restante 
        // dos procedimentos. 
        if (!$this->firewall->isAuthenticated())
            return;

        Lumine::import("Log");
        $data = strftime('%A, %d de %B de %Y', strtotime('today')) . ' as ' . Date('H:i:s');
        $log = new Log();
        $requisicao = $_REQUEST;
        $log->ocorrencia = $data . ' ' . $msg;
        $temp = '';
        foreach ($_SESSION['Permissao'] as $valor)
            $temp = $temp . ' ' . $valor;
        $data = $this->date();
        $time = $this->time();
        $log->datatime = date("Y-m-d H:i:s", mktime($time[0], $time[1], $time[2], $data[1], $data[0], $data[2]));
        $log->permissao = $temp;
        $log->usercase = $requisicao['uc'];
        $log->action = $requisicao['a'];
        $log->usuarioId = $_SESSION["usuarioId"];
        $log->empresaId = $_SESSION["empresaId"];
        $log->insert();
    }

    private function date()
    {
        $data = date("d-m-Y", strtotime('today'));
        return explode("-", $data);
    }

    private function time()
    {
        $tempo = date("H:i:s", gmdate('U'));
        return explode(":", $tempo);
    }
}