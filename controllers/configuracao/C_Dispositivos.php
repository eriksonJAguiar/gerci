<?php 

function pegarDispositivos(){
	$dao = new GenericDAO("maquinas", "Dispositivo");
	$dispositivos = $dao->getAll();
	return $dispositivos;	
}
function statusDispositivo($ip, $comunidade){
	$sysuptime = @snmpget($ip, $comunidade, "1.3.6.1.2.1.1.3.0", 10);
	return $sysuptime;
}
function pegarUnicoDispositivo($ip){
	$dao = new GenericDAO("maquinas", "Dispositivo");
	$dispositivos = $dao->getSpecific("ip", "ip='".$ip."'");
	return $dispositivos;	
}
function pegarValorOIDGET($ip, $comunidade, $obj){
	$sysuptime = @snmpget($ip, $comunidade, $obj);
	$sysuptime = str_replace("STRING: ", "",$sysuptime);
	$sysuptime = str_replace("INTEGER: ", "",$sysuptime);
	$sysuptime = str_replace("IpAddress: ", "",$sysuptime);
	$sysuptime = str_replace("Gauge32: ", "",$sysuptime);
	$sysuptime = str_replace("\"", "",$sysuptime);
	return $sysuptime;
}
function pegarValorOIDWALK($ip, $comunidade, $obj){
	$sysuptime = @snmpwalk($ip, $comunidade, $obj);
	for ($i=0;$i<count($sysuptime);$i++){
	$sysuptime[$i] = str_replace("STRING: ", "",$sysuptime[$i]);
	$sysuptime[$i] = str_replace("INTEGER: ", "",$sysuptime[$i]);
	$sysuptime[$i] = str_replace("Gauge32: ", "",$sysuptime[$i]);
	$sysuptime[$i] = str_replace("IpAddress: ", "",$sysuptime[$i]);
	
	$sysuptime[$i] = str_replace("\"", "",$sysuptime[$i]);
	}
	return $sysuptime;
}
?>