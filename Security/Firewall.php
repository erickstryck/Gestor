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
        $resposta = self::getClassAnnotations($uc, $meth);
        return $resposta;
    }

    private static function getClassAnnotations($uc, $meth)
    {
        $ok = false;
        $acesso = new ReflectionAnnotatedMethod($uc, $meth);
        if (!$acesso->hasAnnotation('Permissao')) return true;
        $annotation = $acesso->getAnnotation('Permissao')->value;
        if (array_key_exists('Permissao', $_SESSION) && $annotation != null)
            foreach ($_SESSION['Permissao'] as $value) if (in_array($value, $annotation)) $ok = true;
        return $ok;
    }
}

?>