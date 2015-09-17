<?php
require_once(PATH . 'View' . DS . 'GenericView.php');
require_once(PATH . 'Util' . DS . 'Convert.php');
/**
 * Created by PhpStorm.
 * User: desenvolvedor
 * Date: 16/09/15
 * Time: 08:55
 */
    class LogView extends GenericView
    {
        public function __construct()
        {
            parent::__construct($this);
        }

        public function showView($arg){
            parent::getTemplateByAction('eventos');
            Lumine::import('Log');
            Lumine::import('Usuario');
            Lumine::import('Empresa');
            Lumine::import("UsuarioHasEmpresa");
            $log=new Log();
            
            $log->limit(500);
            $log->where('empresa_id=' . $_SESSION['empresaId'])->find();
            $emp=new Empresa();
            $emp->where('id='.$_SESSION['empresaId'])->find();
            $emp->fetch(true);
            while ($log->fetch()) {
                $user=new Usuario();
                $has = new UsuarioHasEmpresa();
                $user->join($has)->where("empresa_id=" . $_SESSION["empresaId"].' and id='.$log->usuarioId)->find();
                $user->fetch(true);
                parent::$templator->setVariable('servico', $log->usercase);
                parent::$templator->setVariable('acao', $log->action);
                parent::$templator->setVariable('ocorrencia', $log->ocorrencia);
                parent::$templator->setVariable('empresa', $emp->nomeFantasia);
                parent::$templator->setVariable('usuario', $user->nomeCompleto);
                parent::$templator->setVariable('perm',$log->permissao);
                parent::$templator->addBlock('log');
            }
            parent::show();
        }
        public function customShow($arg){
            parent::getTemplateByAction('eventos');
            Lumine::import('Log');
            Lumine::import('Usuario');
            Lumine::import('Empresa');
            Lumine::import("UsuarioHasEmpresa");
            $log=new Log();
            $atual=date("d.m.Y");
            $timestamp_dt_atual = strtotime($atual);
            $intervaloMax=strtotime($arg['para']);
            if ($timestamp_dt_atual < $intervaloMax){
                $this->sendAjax(array('status' => false));
            }
            $log->where('empresa_id=' . $_SESSION['empresaId']." and data>='".$arg['de']."' and data<='".$arg['para']."''")->find();
            $emp=new Empresa();
            $emp->where('id='.$_SESSION['empresaId'])->find();
            $emp->fetch(true);
            while ($log->fetch()) {
                $user=new Usuario();
                $has = new UsuarioHasEmpresa();
                $user->join($has)->where("empresa_id=" . $_SESSION["empresaId"].' and id='.$log->usuarioId)->find();
                $user->fetch(true);
                parent::$templator->setVariable('servico', $log->usercase);
                parent::$templator->setVariable('acao', $log->action);
                parent::$templator->setVariable('ocorrencia', $log->ocorrencia);
                parent::$templator->setVariable('empresa', $emp->nomeFantasia);
                parent::$templator->setVariable('usuario', $user->nomeCompleto);
                parent::$templator->setVariable('perm',$log->permissao);
                parent::$templator->addBlock('log');
            }
            parent::show();
        }
    }