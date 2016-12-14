<?php

include_once '../dao/GenericDAO.php';
include_once '../model/Dispositivo.php';

$ip = $_POST['ip'];
$local = $_POST['local'];
$descricao = $_POST['descricao'];

if(!empty($ip) && !empty($descricao) && !empty($local)){
	DispositivosController::registrarDispositivo($ip, $local, $descricao);
}else{
	echo 'empty';
}

class DispositivosController{
	public static function registrarDispositivo($ip, $local, $descricao){
		$dao = new GenericDAO('maquinas', 'Dispositivo');
		$parametros = array(
			null,
			$ip,
			$local,
			$descricao
		);
		$dao->insert($parametros);
		echo 'success';
	}
}

?>