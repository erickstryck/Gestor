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
            if(array_key_exists("busca",$arg)){
                $atual=date("d.m.Y");
                $timestamp_dt_atual = strtotime($atual);
                $datade=$this->getDataDe($arg['intervalo']);
                $horade=$this->getHoraDe($arg['intervalo']).":00";
                $datapara=$this->getDataPara($arg['intervalo']);
                $horapara=$this->getHoraPara($arg['intervalo']).":00";
                $intervaloMax=strtotime($datapara);
                $horaAtual=strtotime(date('H:i:s', gmdate('U')));
                $horaBusca=strtotime($horapara);
                if ($timestamp_dt_atual < $intervaloMax || $horaAtual<$horaBusca){
                    $this->sendAjax(array('status' => false));
                }
                if($timestamp_dt_atual == $intervaloMax && $horaAtual<strtotime($horade)){
                    $this->sendAjax(array('status' => false));
                }
                $log->where('empresa_id=' . $_SESSION['empresaId']." and data>='".$datade."' and data<='".$datapara."' and time>=CAST('".$horade."' AS time) and time<=CAST('".$horapara."' AS time) ")->find();
                $log->limit(500);
            }else{
                $log->where('empresa_id=' . $_SESSION['empresaId'])->find();
                $log->limit(500);
            }
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
        private function getDataDe($data){
            $temp=explode('||',$data);
            return substr($temp[0],0,10);
        }
        private function getHoraDe($data){
            $temp=explode('||',$data);
            return substr($temp[0],11,5);
        }
        private function getDataPara($data){
            $temp=explode('||',$data);
            return substr($temp[1],1,10);
        }
        private function getHoraPara($data){
            $temp=explode('||',$data);
            return substr($temp[1],12,13);
        }

    }