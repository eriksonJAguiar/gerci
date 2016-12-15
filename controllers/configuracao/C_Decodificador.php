<?php 

function decodificarTipo($tipo){
	if($tipo=='24'){
		return "softwareLoopback";
		
	}else if($tipo=='6'){
		return "ethernetCsmacd";
		
	}
	
}
function decodificarClasse($tipo){
	if($tipo=='1'){
		return "A";
		
	}else if($tipo=='2'){
		return "B";
		
	}else if($tipo=='3'){
		return "C";
		
	}
	
}
function decodificartcpMaxConn($a){
	if($a=='-1'){
		return "Dinamico";
	}
	
}
function decodificadortcpRtoAlgorithm($a){
	if($a=='1'){
		return "Outros";
	}else if($a=='2'){
		return "Constante RTO";
	}else if($a=='3'){
		return "MIL-STD-1778, Appendix B";
	}else if($a=='4'){
		return "Van Jacobson's algorithm [10]";
	}
	
	
}
function descodificarsnmpEnableAuthTraps($a){
	if($a=='2'){
		return "Desabilitado";
		
	}else{
		return "Habilitado";
	}
}
function decodificaripForwarding($a){
	if($a=='1'){
		return "Atuando como roteador";
		
	}else{
		return "Nao atuando como roteador";
	}
	
}
function decodificarifAdminStatus($a){
	if($a=='1'){
		return "<img src='img/online2.png'\>";
		
	}else{
		return "<img src='img/offline2.png'\>";
	}
	
}
?>