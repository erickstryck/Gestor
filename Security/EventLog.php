<?php

/**
 * Created by PhpStorm.
 * User: desenvolvedor
 * Date: 15/09/15
 * Time: 12:00
 */
class EventLog
{
    public function monitoramento($msg){
        Lumine::import("Log");
        $data=strftime('%A, %d de %B de %Y', strtotime('today')).' as '.Date('H:i:s');
        $log = new Log();
        $requisicao= $_REQUEST;
        $log->ocorrencia=$data.' '.$msg;
        $temp='';
        foreach($_SESSION['Permissao'] as $valor){
            $temp=$temp.' '.$valor;
        }
        $log->time=date('H:i:s', gmdate('U'));
        $log->data=date("d.m.Y", strtotime('today'));
        $log->permissao=$temp;
        $log->usercase=$requisicao['uc'];
        $log->action=$requisicao['a'];
        $log->usuarioId=$_SESSION["usuarioId"];
        $log->empresaId=$_SESSION["empresaId"];
        $log->insert();
    }
}