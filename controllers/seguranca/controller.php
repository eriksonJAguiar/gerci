<?php

function getPorts($output){
  $retorna = array();
  $v = false;
  foreach ($output as $i => $value) {
    if(substr($output[$i], 0, 1) == "H" || $v == true){
       if(empty($output[$i])){
          break;
       }
       array_push($retorna, $output[$i]);
       $v = true;
    }
  }
  return $retorna;
}

function setFunction($ip, $func){
  $func = "nmap ".$func." ".$ip;
  exec($func,$retorna);
  return $retorna;
}

function getDispositivos(){
  include_once '../../model/Dispositivo.php';
  include_once '../../dao/GenericDAO.php';
  $dao = new GenericDAO("maquinas", "Dispositivo");
  return $dao->getAll();
}


function getTopPort($id, $n){
  include_once '../../model/Dispositivo.php';
  include_once '../../dao/GenericDAO.php';
  $dao = new GenericDAO("maquinas", "Dispositivo");
  $pega = $dao->get($id);
  $top = "--top-ports ".$n;
  $func = setFunction($pega->getIp(),$top);
	$saida = getPorts($func);
  return $saida;
}

function sepPort($saida){
  include_once '../../model/porta.php';
  $array = array();
  foreach ($saida as $i => $value) {
    if($i > 2){
      $dis = new Porta();
      $var = explode(" ",$saida[$i]);
      $count = 0;
      for($j =0; $j < sizeof($var); $j++){
          if(!empty($var[$j])){
            if($count == 0){
              $dis->setPort($var[$j]);
              $count++;
            }else if($count == 1){
              $dis->setState($var[$j]);
              $count++;
            }else if($count == 2){
              $dis->setService($var[$j]);
              $count++;
            }
          }
        }
      array_push($array, $dis);
    }
  }
  return $array;
}


function getPortsPrivate($id){
  include_once '../../model/Dispositivo.php';
  include_once '../../dao/GenericDAO.php';
  $dao = new GenericDAO("maquinas", "Dispositivo");
  $pega = $dao->get($id);
  $func = setFunction($pega->getIp(),"-v");
  $saida = getPorts($func);
  $retorna = sepPort($saida);
  return $retorna;
}

function getVult($id, $porta){
  include_once '../../model/Dispositivo.php';
  include_once '../../dao/GenericDAO.php';
  $dao = new GenericDAO("maquinas", "Dispositivo");
  $pega = $dao->get($id);
  $port = "--reason -p ".$porta;
  $cmd = setFunction($pega->getIp(),$port);
  foreach($cmd as $i => $l){
    if(empty($cmd[$i+1]) && !empty($cmd[$i+2])){
      $v = preg_split("[ ]",$l);
      $tam = sizeof($v);
      return $v[$tam-1];
    }
  }

}




?>
