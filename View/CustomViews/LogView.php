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
            if(array_key_exists("check",$arg) && ($arg["check"]==='1') && !empty($arg['intervalo'])) {
                $atual = date("d.m.Y");
                $timestamp_dt_atual = strtotime($atual);
                $datade = $this->getData($arg['intervalo'], false, "de");
                $horade = $this->getHora($arg['intervalo'], false, "de");
                $datapara = $this->getData($arg['intervalo'], false, "para");
                $horapara = $this->getHora($arg['intervalo'], false, "para");
                $intervaloMax = strtotime($datapara);
                $intervaloMin = strtotime($datade);
                $horaAtual = strtotime(date('H:i:s', gmdate('U')));
                $horaBusca = strtotime($horapara);
                if ($timestamp_dt_atual < $intervaloMax || $horaAtual < $horaBusca) {
                    $this->sendAjax(array('status' => false));
                }
                if ($timestamp_dt_atual == $intervaloMin && ($horaAtual < strtotime($horade) || $horaAtual < strtotime($horapara))) {
                    $this->sendAjax(array('status' => false));
                }
                $this->sendAjax(array('status' => true));
            }else{
                if(array_key_exists("check",$arg) && !($arg["check"]==='1') && !empty($arg['intervalo'])){
                    $hora=$this->getHora($arg['intervalo'],true,"de");
                    $data=$this->getData($arg['intervalo'],true,"de");
                    $dataMinBusca=date("Y-m-d H:i:s",mktime($hora[0],$hora[1],"00",$data[1],$data[0],$data[2]));
                    $horaM=$this->getHora($arg['intervalo'],true,"para");
                    $dataM=$this->getData($arg['intervalo'],true,"para");
                    $dataMaxBusca=date("Y-m-d H:i:s",mktime($horaM[0],$horaM[1],"00",$dataM[1],$dataM[0],$dataM[2]));
                    $log->where('empresa_id=' . $_SESSION['empresaId']." and dataTime>='".$dataMinBusca."' and dataTime<='".$dataMaxBusca."'")->find();
                    $log->limit(50);
                }else{
                    $log->where('empresa_id=' . $_SESSION['empresaId'])->find();
                    $log->limit(50);
                }
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
        private function getData($data,$explode,$inter){
            $temp=explode('||',$data);
            switch($inter){
                case 'de':
                    if($explode){
                        $ex=substr($temp[0],0,10);
                        return explode(".",$ex);
                    }else return substr($temp[0],0,10);
                    break;
                case 'para':
                    if($explode){
                        $ex=substr($temp[1],1,10);
                        return explode(".",$ex);
                    }else return substr($temp[1],1,10);
                    break;
            }
        }
        private function getHora($data,$explode,$inter){
            $temp=explode('||',$data);
            switch($inter) {
                case 'de':
                    if($explode){
                        $ex=substr($temp[0],11,5);
                        return explode(":",$ex);
                    }else return substr($temp[0],11,5);
                    break;
                case 'para':
                    if($explode){
                        $ex=substr($temp[1],12,13);
                        return explode(":",$ex);
                    }else return substr($temp[1],12,13);
                    break;
            }
        }
    }