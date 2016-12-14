<?php

echo "oi";

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
  return exec('nmap "'$func'" "'$ip'"', $output);
}
