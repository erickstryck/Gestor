<?php
/**
 * Created by PhpStorm.
 * User: desenvolvedor
 * Date: 11/09/15
 * Time: 08:30
 */
require_once(PATH . 'Util' . DS . 'annotations.php');

class Firewall extends Annotation
{
    public static function filtro()
    {
        $filtro = array('/\bwhere\b/', '/\bdatabase\b/', '/\bselect\b/', '/\binto\b/', '/\bdelete\b/', '/\bupdate\b/', '/\bdrop\b/', '/\buse\b/', '/"/', "/'/");
        $pregReplaceP = preg_replace($filtro, '', $_POST);
        $pregReplaceG = preg_replace($filtro, '', $_GET);
        $_POST = $pregReplaceP;
        $_GET = $pregReplaceG;
    }

    public static function defender($uc, $meth)
    {

        if(!self::isAuthenticated($uc, $meth))
            return false; 

        if (!self::isAuthenticated())
            return false;


        return self::getClassAnnotations($uc, $meth);
    }

    //Retorna as anotações da classe requisitada. 
    private static function getClassAnnotations($uc, $meth){
        $acesso = new ReflectionAnnotatedMethod($uc, $meth); 
        if (!$acesso->hasAnnotation('Permissao')) return null;

        return $annotation = $acesso->getAnnotation('Permissao')->value;
    }


    public static function isAuthenticated(){
        if( !isset($_SESSION['empresaId']) && !isset($_SESSION['usuarioId'] ) )
            return false; 

        return true; 
    }


    private static function allowAcess($uc, $meth){
        $annotation = self::getClassAnnotations($uc, $meth);

        //A classe não há restrição de acesso 
        if( empty($annotation) )
            return true;
    }

}

?>