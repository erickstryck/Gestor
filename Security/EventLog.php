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
        $requisicao= self::getArray();
        $log->ocorrencia=$data.' '.$msg;
        $temp='';
        foreach($_SESSION['Permissao'] as $valor){
            $temp=$temp.' '.$valor;
        }
        $log->permissao=$temp;
        $log->usercase=$requisicao['uc'];
        $log->action=$requisicao['a'];
        $log->usuarioId=$_SESSION["id"];
        $log->empresaId=$_SESSION["empresaId"];
        $log->insert();
    }

    private function getArray(){
        if(strcmp($_SERVER['REQUEST_METHOD'],'POST')==0){
            $post=$_POST;
            return $post;
        }else{
            $get=$_GET;
            return $get;
        }
    }
}