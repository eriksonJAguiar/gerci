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
if($numeroFalhasConexoesTcp<2){
	$numeroFalhasConexoesTcpClasse = "panel-green";
}else if($numeroFalhasConexoesTcp<4){
	$numeroFalhasConexoesTcpClasse = "panel-yellow";
}else{
	$numeroFalhasConexoesTcpClasse = "panel-red";
}

//Número de falhas por segundo em reconexões tcp
$tcpEstabResets = snmp(".1.3.6.1.2.1.6.8");
$numeroFalhasReconexoesTcp = $tcpEstabResets;
if($numeroFalhasReconexoesTcp<2){
	$numeroFalhasReconexoesTcpClasse = "panel-green";
}else if($numeroFalhasReconexoesTcp<4){
	$numeroFalhasReconexoesTcpClasse = "panel-yellow";
}else{
	$numeroFalhasReconexoesTcpClasse = "panel-red";
}

//@@UDP
//Número de falhas por segundo em pacotes para portas não usadas udp
$udpNoPorts = snmp(".1.3.6.1.2.1.7.2");
$numeroFalhasUdp = $udpNoPorts;
if($numeroFalhasUdp<2){
	$numeroFalhasUdpClasse = "panel-green";
}else if($numeroFalhasUdp<4){
	$numeroFalhasUdpClasse = "panel-yellow";
}else{
	$numeroFalhasUdpClasse = "panel-red";
}

//@@EGP
//Número de falhas por segundo de mensagens recebidas egp
$egpInErrors = snmp(".1.3.6.1.2.1.8.2");
$numeroFalhasEntradaEgp = $egpInErrors;
if($numeroFalhasEntradaEgp<2){
	$numeroFalhasEntradaEgpClasse = "panel-green";
}else if($numeroFalhasEntradaEgp<4){
	$numeroFalhasEntradaEgpClasse = "panel-yellow";
}else{
	$numeroFalhasEntradaEgpClasse = "panel-red";
}

//Número de falhas por segundo de mensagens enviadas egp
$egpOutErrors = snmp(".1.3.6.1.2.1.8.4");
$numeroFalhasSaidaEgp = $egpOutErrors;
if($numeroFalhasSaidaEgp<2){
	$numeroFalhasSaidaEgpClasse = "panel-green";
}else if($numeroFalhasSaidaEgp<4){
	$numeroFalhasSaidaEgpClasse = "panel-yellow";
}else{
	$numeroFalhasSaidaEgpClasse = "panel-red";
}

//@@SNMP
//Taxa de pacotes snmp recebidos
$snmpInPkts = snmp(".1.3.6.1.2.1.11.1");
$numeroPacotesSnmpRecebidos = $snmpInPkts;


//Taxa de pacotes snmp enviados
$snmpOutPkts = snmp(".1.3.6.1.2.1.11.2");
$numeroPacotesSnmpEnviados = $snmpOutPkts;


?>

<div style="padding-top: 15px">
	<!-- @@ INTERFACES @@ -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><strong>Interfaces</strong></h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-6">
					<div class="panel <?=$porcetagemErroEntradaClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=$porcentagemErroEntrada?>%
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<strong>Porcentagem de erro de entrada</strong>		
						</div>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="panel <?=$porcetagemErroSaidaClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=$porcentagemErroSaida?>%
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<strong>Porcentagem de erro de saida</strong>		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- @@ IP @@ -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><strong>IP</strong></h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-6">
					<div class="panel <?=$porcetagemErroDatagramaClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=$porcentagemErroDatagrama?>%
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<strong>Porcentagem de erro de datagrama IP</strong>		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- @@ TCP @@ -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><strong>TCP</strong></h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-6">
					<div class="panel <?=$numeroFalhasConexoesTcpClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=$numeroFalhasConexoesTcp?>/s
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<strong>Número de vezes que uma conexão TCP falhou por segundo</strong>		
						</div>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="panel <?=$numeroFalhasReconexoesTcpClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=$numeroFalhasReconexoesTcp?>/s
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<strong>Número de vezes que uma conexão TCP foi reiniciada por segundo</strong>		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- @@ UDP @@ -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><strong>UDP</strong></h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-6">
					<div class="panel <?=$numeroFalhasUdpClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?=$numeroFalhasUdp?>/s
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<strong>Número de vezes por segundo que datagramas UDP foram recebidos e não havia nenhuma aplicação na porta de destino</strong>		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- @@ EGP @@ -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><strong>EGP</strong></h4>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-xs-6">
					<div class="panel <?=$numeroFalhasEntradaEgpClasse?>">
						<div class="panel-heading">
							<div class="text-left">
								<div class="huge">
									<?php
									if(empty($numeroFalhasEntradaEgp))echo "Não encontrada na MIB";
									else echo $numeroFalhasEntradaEgp . "/s";
									?>
								</div>
							</div>
						</div>
						<div class="panel-footer">
							<strong>Número de vezes por segundo que uma mensagem de gateway externo chega com erro</strong>		
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
							<strong>Número de vezes por segundo que uma mensagem de gateway externo chega com erro</strong>		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- @@ SNMP @@ -->
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4><strong>SNMP</strong></h4>
		</div>
		<div class="panel-body">
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
							<strong>Taxa de pacotes SNMP recebidos</strong>		
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
							<strong>Taxa de pacotes SNMP enviados</strong>		
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include_once "../templates/footer.php"; ?>