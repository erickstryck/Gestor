<?php

/**
 * Created by PhpStorm.
 * User: desenvolvedor
 * Date: 15/09/15
 * Time: 12:00
 */
class Log
{
    public static function log(){
        Lumine::import("Log");
        Lumine::import("Usuario");
        $user=new Usuario();
        $data=strftime('%A, %d de %B de %Y', strtotime('today')).' as '.Date('H:i:s');
        $log = new Log();
        $requisicao= self::getArray();
        $user->where("empresa_id = " . $_SESSION["empresaId"] . " and id=" . $_SESSION["id"])->find();
        $user->fetch(true);
        $log->ocorrencia=$data;
        $log->usercase=$requisicao['uc'];
        $log->action=$requisicao['a'];
        $log->usuarioId=$_SESSION["id"];
        $log->empresaId=$_SESSION["empresaId"];
    }

    private static function getArray(){
        if(strcmp($_SERVER['REQUEST_METHOD'],'POST')){
            $post=$_POST;
            return $post;
        }else{
            $get=$_GET;
            return $get;
        }
    }
}