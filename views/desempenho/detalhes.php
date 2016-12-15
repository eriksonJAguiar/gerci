<?php
include_once "../templates/header.php";

$ip = $_GET['ip'];

//var_dump(snmpwalk($ip, "public", ".1.3.6.1.2.1.11.1"));	

function snmp($oid){
	global $ip;
	return substr(@snmpwalk($ip, "public", $oid)[0], 11);
}

//@@INTERFACES
//Porcentagem de erro de entrada
$ifInErrors = snmp(".1.3.6.1.2.1.2.2.1.14");
$ifInUcastPkts = snmp(".1.3.6.1.2.1.2.2.1.11");
$ifInNUcastPkts = snmp(".1.3.6.1.2.1.2.2.1.12");
$porcentagemErroEntrada = $ifInErrors / ($ifInUcastPkts + $ifInNUcastPkts);
if($porcentagemErroEntrada<10){
	$porcetagemErroEntradaClasse = "panel-green";
}else if($porcentagemErroEntrada<50){
	$porcetagemErroEntradaClasse = "panel-yellow";
}else{
	$porcetagemErroEntradaClasse = "panel-red";
}

//Porcentagem de erro de saida
$ifOutErrors = snmp(".1.3.6.1.2.1.2.2.1.20");
$ifOutUcastPkts = snmp(".1.3.6.1.2.1.2.2.1.17");
$ifOutNUcastPkts = snmp(".1.3.6.1.2.1.2.2.1.18");
$porcentagemErroSaida = $ifOutErrors / ($ifOutUcastPkts + $ifOutNUcastPkts);
if($porcentagemErroSaida<10){
	$porcetagemErroSaidaClasse = "panel-green";
}else if($porcentagemErroSaida<50){
	$porcetagemErroSaidaClasse = "panel-yellow";
}else{
	$porcetagemErroSaidaClasse = "panel-red";
}

//@@IP
//Porcentagem de erros do datagrama ip
$ipInDiscards = snmp(".1.3.6.1.2.1.4.8");
$ipInHdrErrors = snmp(".1.3.6.1.2.1.4.4");
$ipInAddrErrors = snmp(".1.3.6.1.2.1.4.5");
$ipInReceives = snmp(".1.3.6.1.2.1.4.3");
$porcentagemErroDatagrama = ($ipInDiscards + $ipInHdrErrors + $ipInAddrErrors) / $ipInReceives;
$porcentagemErroDatagrama *= 100;
if($porcentagemErroDatagrama<10){
	$porcetagemErroDatagramaClasse = "panel-green";
}else if($porcentagemErroDatagrama<50){
	$porcetagemErroDatagramaClasse = "panel-yellow";
}else{
	$porcetagemErroEntradaClasse = "panel-red";
}

//@@TCP
//Número de falhas por segundo de conexões tcp
$tcpAttemptFails = snmp(".1.3.6.1.2.1.6.7");
$numeroFalhasConexoesTcp = $tcpAttemptFails;
$numeroFalhasConexoesTcpClasse = "panel-default";
/*
if($numeroFalhasConexoesTcp<2){
	$numeroFalhasConexoesTcpClasse = "panel-green";
}else if($numeroFalhasConexoesTcp<4){
	$numeroFalhasConexoesTcpClasse = "panel-yellow";
}else{
	$numeroFalhasConexoesTcpClasse = "panel-red";
}
*/

//Número de falhas por segundo em reconexões tcp
$tcpEstabResets = snmp(".1.3.6.1.2.1.6.8");
$numeroFalhasReconexoesTcp = $tcpEstabResets;
$numeroFalhasReconexoesTcpClasse = "panel-default";
/*
if($numeroFalhasReconexoesTcp<2){
	$numeroFalhasReconexoesTcpClasse = "panel-green";
}else if($numeroFalhasReconexoesTcp<4){
	$numeroFalhasReconexoesTcpClasse = "panel-yellow";
}else{
	$numeroFalhasReconexoesTcpClasse = "panel-red";
}
*/

//Taxa de segmentos de entrada tcp
$tcpInSegs = snmp(".1.3.6.1.2.1.6.10");
$numeroSegmentosTcpEntrada = $tcpInSegs;
$numeroSegmentosTcpEntradaClasse = "panel-default";

//Taxa de segmentos de saida tcp
$tcpOutSegs = snmp(".1.3.6.1.2.1.6.11");
$numeroSegmentosTcpSaida = $tcpOutSegs;
$numeroSegmentosTcpSaidaClasse = "panel-default";

//@@UDP
//Número de falhas por segundo em pacotes para portas não usadas udp
$udpNoPorts = snmp(".1.3.6.1.2.1.7.2");
$numeroFalhasUdp = $udpNoPorts;
$numeroFalhasUdpClasse = "panel-default";
/*
if($numeroFalhasUdp<2){
	$numeroFalhasUdpClasse = "panel-green";
}else if($numeroFalhasUdp<4){
	$numeroFalhasUdpClasse = "panel-yellow";
}else{
	$numeroFalhasUdpClasse = "panel-red";
}
*/

//@@EGP
//Número de falhas por segundo de mensagens recebidas egp
$egpInErrors = snmp(".1.3.6.1.2.1.8.2");
$numeroFalhasEntradaEgp = $egpInErrors;
$numeroFalhasEntradaEgpClasse = "panel-default";
/*
if($numeroFalhasEntradaEgp<2){
	$numeroFalhasEntradaEgpClasse = "panel-green";
}else if($numeroFalhasEntradaEgp<4){
	$numeroFalhasEntradaEgpClasse = "panel-yellow";
}else{
	$numeroFalhasEntradaEgpClasse = "panel-red";
}
*/

//Número de falhas por segundo de mensagens enviadas egp
$egpOutErrors = snmp(".1.3.6.1.2.1.8.4");
$numeroFalhasSaidaEgp = $egpOutErrors;
$numeroFalhasSaidaEgpClasse = "panel-default";
/*
if($numeroFalhasSaidaEgp<2){
	$numeroFalhasSaidaEgpClasse = "panel-green";
}else if($numeroFalhasSaidaEgp<4){
	$numeroFalhasSaidaEgpClasse = "panel-yellow";
}else{
	$numeroFalhasSaidaEgpClasse = "panel-red";
}
*/

//@@SNMP
//Taxa de pacotes snmp recebidos
$snmpInPkts = snmp(".1.3.6.1.2.1.11.1");
$numeroPacotesSnmpRecebidos = $snmpInPkts;


//Taxa de pacotes snmp enviados
$snmpOutPkts = snmp(".1.3.6.1.2.1.11.2");
$numeroPacotesSnmpEnviados = $snmpOutPkts;


?>
<style type="text/css">
.popover {
    max-width: 350px;
    /* If max-width does not work, try using width instead */
    width: 350px; 
    text-align: justify;
}
</style>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
$(function () {
  $('[data-toggle="popover"]').popover()
})
</script>
<div style="padding-top: 15px">
	<!-- @@ INTERFACES @@ -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><strong>Interfaces</strong></h4>
			<a class="pull-right" href="#panel-interfaces" data-toggle="collapse" aria-expanded="false" style="cursor: pointer; margin-top: -35px; color: white"><i class="fa fa-bars fa-2x"></i></a> 
			
		</div>
		<div id="panel-interfaces" class="panel-body collapse">
			<div class="row">
				<div class="col-xs-6">
					<div class="panel <?=$porcetagemErroEntradaClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=number_format($porcentagemErroEntrada,2)?>%
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-10">
									<strong>Porcentagem de erro de entrada</strong>	
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-default pull-right" data-trigger="focus" data-placement="right" data-toggle="popover" 
									data-content="
										Com os objetos ifInUcastPkts, ifInNUcastPkts, ifInErrors, pode-se calcular as porcentagens de erro de entrada.
										(porcentagem de erro de entrada = ifInErrors / (ifInUcastPkts + ifInNUcastPkts ))
									" aria-label="Left Align">
									  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
									</button>	
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="panel <?=$porcetagemErroSaidaClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=number_format($porcentagemErroSaida,2)?>%
								</div>
							</div>
						</div>
						<div class="panel-footer">
								
							<div class="row">
								<div class="col-md-10">
									<strong>Porcentagem de erro de saida</strong>
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-default pull-right" data-trigger="focus" data-placement="left" data-toggle="popover" 
									data-content="
										Com os objetos  ifOutUcastPkts, ifOutNucastPkts, ifOutErros , podemos calcular as porcentagens de erro de saída.
										Porcentagem de erro de saída = ifOutErrors / (ifOutUcastPkts + ifOutNUcastPkts )
									" aria-label="Left Align">
									  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
									</button>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- @@ IP @@ -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><strong>IP</strong></h4>
			<a class="pull-right" href="#panel-ip" data-toggle="collapse" aria-expanded="false" style="cursor: pointer; margin-top: -35px; color: white"><i class="fa fa-bars fa-2x"></i></a> 
		</div>
		<div id="panel-ip" class="panel-body collapse">
			<div class="row">
				<div class="col-xs-6">
					<div class="panel <?=$porcetagemErroDatagramaClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=number_format($porcentagemErroDatagrama,2)?>%
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-10">
									<strong>Porcentagem de erro de datagrama IP</strong>	
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-default pull-right" data-trigger="focus" data-placement="right" data-toggle="popover" 
									data-content="
										Pode-se calcular a porcentagem de erros de datagramas IP:
										Porcentagem de erros de entrada: (ipInDiscards + ipInHdrErrors + ipInAddrErrors) / ipInReceives
									" aria-label="Left Align">
									  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
									</button>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- @@ TCP @@ -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><strong>TCP</strong></h4>
			<a class="pull-right" href="#panel-tcp" data-toggle="collapse" aria-expanded="false" style="cursor: pointer; margin-top: -35px; color: white"><i class="fa fa-bars fa-2x"></i></a> 
		</div>
		<div id="panel-tcp" class="panel-body collapse">
			<div class="row">
				<div class="col-xs-6">
					<div class="panel <?=$numeroFalhasConexoesTcpClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=$numeroFalhasConexoesTcp?>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							
							<div class="row">
								<div class="col-md-10">
									<strong>Taxa que uma conexão TCP falhou</strong>	
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-default pull-right" data-trigger="focus" data-placement="right" data-toggle="popover" 
									data-content="
										Pela observação do objeto tcpAttemptFails pode-se medir a confiabilidade da rede, onde um número menor de falhas indicam uma rede mais confiável.
									" aria-label="Left Align">
									  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
									</button>	
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="panel <?=$numeroFalhasReconexoesTcpClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=$numeroFalhasReconexoesTcp?>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-10">
									<strong>Taxa que uma conexão TCP foi reiniciada</strong>	
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-default pull-right" data-trigger="focus" data-placement="left" data-toggle="popover" 
									data-content="
										Pela observaçao do objeto tcpEstabResets também pode-se medir a confiabilidade da rede, sendo que quanto maior o número de conexões estabelecidas reinicializadas, menos confiável é a rede.
									" aria-label="Left Align">
									  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
									</button>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<div class="panel <?=$numeroSegmentosTcpEntradaClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=$numeroSegmentosTcpEntrada?>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-10">
									<strong>Taxa de segmentos de entrada do TCP</strong>	
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-default pull-right" data-trigger="focus" data-placement="right" data-toggle="popover" 
									data-content="
										Número total de segmentos recebidos, incluindo aqueles recebidos com erro.
									" aria-label="Left Align">
									  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
									</button>	
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="panel <?=$numeroSegmentosTcpSaidaClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=$numeroSegmentosTcpSaida?>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-10">
									<strong>Taxa de segmentos de saida do TCP</strong>	
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-default pull-right" data-trigger="focus" data-placement="left" data-toggle="popover" 
									data-content="
										O número total de segmentos enviados, incluindo aqueles em conexões atuais menos os que contém apenas octetos retransmitidos.
									" aria-label="Left Align">
									  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
									</button>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- @@ UDP @@ -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><strong>UDP</strong></h4>
			<a class="pull-right" href="#panel-udp" data-toggle="collapse" aria-expanded="false" style="cursor: pointer; margin-top: -35px; color: white"><i class="fa fa-bars fa-2x"></i></a> 
		</div>
		<div id="panel-udp" class="panel-body collapse">
			<div class="row">
				<div class="col-xs-6">
					<div class="panel <?=$numeroFalhasUdpClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=$numeroFalhasUdp?>
								</div>
							</div>
						</div>
						<div class="panel-footer">	
							<div class="row">
								<div class="col-md-10">
									<strong>Taxa que datagramas UDP foram recebidos e não havia nenhuma aplicação na porta de destino</strong>
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-default pull-right" data-trigger="focus" data-placement="right" data-toggle="popover" 
									data-content="
										O objeto udpNoPorts informa quando a entidade está recebendo datagramas de uma aplicação inválida. Uma taxa alta desses datagramas pode resultar em problemas de performance.
									" aria-label="Left Align">
									  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
									</button>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- @@ EGP @@ -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><strong>EGP</strong></h4>
			<a class="pull-right" href="#panel-egp" data-toggle="collapse" aria-expanded="false" style="cursor: pointer; margin-top: -35px; color: white"><i class="fa fa-bars fa-2x"></i></a> 
		</div>
		<div id="panel-egp" class="panel-body collapse">
			<div class="row">
			 	<div class="col-xs-6">
					<div class="panel <?=$numeroFalhasEntradaEgpClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?php
									if(empty($numeroFalhasEntradaEgp))echo "Não encontrada na MIB";
									else echo $numeroFalhasEntradaEgp;
									?>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-10">
									<strong>Taxa que uma mensagem de gateway externo chega com erro</strong>
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-default pull-right" data-trigger="focus" data-placement="right" data-toggle="popover" 
									data-content="
										O aumento do valor dos objetos egpInErrors e egpOutErrors geralmente coincide com o aumento número de mensagens recebidas e enviadas pela entidade. Se uma mensagem é recebida com erro e uma resposta válida não é enviada, o vizinho EGP originador deverá retransmitir a mensagem. 
									" aria-label="Left Align">
									  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
									</button>	
								</div>
							</div>		
						</div>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="panel <?=$numeroFalhasSaidaEgpClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?php
									if(empty($numeroFalhasSaidaEgp))echo "Não encontrada na MIB";
									else echo $numeroFalhasSaidaEgp . "/s";
									?>
								</div>
							</div>
						</div>
						<div class="panel-footer">
						
							<div class="row">
								<div class="col-md-10">
									<strong>Número de vezes por segundo que uma mensagem de gateway externo chega com erro</strong>	
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-default pull-right" data-trigger="focus" data-placement="left" data-toggle="popover" 
									data-content="
										O aumento do valor dos objetos egpInErrors e egpOutErrors geralmente coincide com o aumento número de mensagens recebidas e enviadas pela entidade. Se uma mensagem é recebida com erro e uma resposta válida não é enviada, o vizinho EGP originador deverá retransmitir a mensagem. 
									" aria-label="Left Align">
									  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
									</button>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- @@ SNMP @@ -->
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h4><strong>SNMP</strong></h4>
			<a class="pull-right" href="#panel-snmp" data-toggle="collapse" aria-expanded="false" style="cursor: pointer; margin-top: -35px; color: white"><i class="fa fa-bars fa-2x"></i></a> 
		</div>
		<div id="panel-snmp" class="panel-body collapse">
			<div class="row">
				<div class="col-xs-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=$numeroPacotesSnmpRecebidos?>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-10">
									<strong>Taxa de pacotes SNMP recebidos</strong>
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-default pull-right" data-trigger="focus" data-placement="right" data-toggle="popover" 
									data-content="
										O SNMP pode agetar a performance do sistema. Se deseja-se conhecer a porcentagem de recursos uma entidade está usando para manipular o SNMP, pode-se calcular a taxa de pacotes SNMP recebidos ou enviados, usando os objetos snmpInPkts e snmpOutPkts.
									" aria-label="Left Align">
									  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
									</button>	
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="panel panel-default">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=$numeroPacotesSnmpEnviados?>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-10">
									<strong>Taxa de pacotes SNMP enviados</strong>	
								</div>
								<div class="col-md-2">
									<button type="button" class="btn btn-default pull-right" data-trigger="focus" data-placement="left" data-toggle="popover" 
									data-content="
										O SNMP pode agetar a performance do sistema. Se deseja-se conhecer a porcentagem de recursos uma entidade está usando para manipular o SNMP, pode-se calcular a taxa de pacotes SNMP recebidos ou enviados, usando os objetos snmpInPkts e snmpOutPkts.
									" aria-label="Left Align">
									  <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
									</button>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once "../templates/footer.php"; ?>