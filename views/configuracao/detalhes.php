<?php
include_once "../templates/header.php";
include_once "../../model/Dispositivo.php";
include_once "../../dao/GenericDAO.php";
include_once "../../controllers/configuracao/C_Dispositivos.php";
include_once "../../controllers/configuracao/C_Decodificador.php";
include_once "../../controllers/configuracao/Configurar.php";
$ip = $_GET['ip'];
?>
<br/>
<script type="text/javascript">
	function toggle(obj) {
		var el = document.getElementById(obj);
		if ( el.style.display != 'none' ) {
		el.style.display = 'none';
		}
		else {
		el.style.display = '';
		}
		}
	
</script>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-info" >
				<div class="panel-heading">
					<h3 class="panel-title">
						Informacoes do Sistema
					</h3>
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
						  <tr>
							<th>Descricao</th>
							<th>Valor</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td>descrição do sistema</td>
							<td><?= pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.1.1.0")?></td>
						  </tr>
						  <tr>
							<td>localização fisica do sistema</td>
							<td><?= pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.1.6.0")?></td>
						  </tr>
						  <tr>
							<td>pessoa responsavel pelo sistema</td>
							<td><?= pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.1.4.0")?></td>
						  </tr>
						  <tr>
							<td>nome do sistema</td>
							<td><?= pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.1.5.0")?></td>
						  </tr>
						</tbody>
					  </table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-info" >
				<div class="panel-heading" onclick="toggle('infointer2');">
					<h3 class="panel-title">
						Informacoes de Interface
					</h3>
				</div>
				<div class="panel-body" id="infointer2" style="display:none;" >
				<?php 
				$array = array();
				$color;
				$interfaces = pegarValorOIDWALK($ip, "public", "1.3.6.1.2.1.2.2.1.2");
				for ($wi=1;$wi<count($interfaces)+1;$wi++){
					array_push($array, pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.2.2.1.2.".$wi));
				if($wi<=$maxInterfaces){
						$color = "#a2f096";
				}else{
					$color = "#f09696";
				}
				?>
				<div class="panel-heading" style="margin:5px; background: <?= $color?>;color:black;">
					<h3 class="panel-title">
						<?= pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.2.2.1.2.".$wi)?>
					</h3>
				</div>
				<div class="panel-body">
					<table class="table">
						<thead>
						  <tr>
							<th>Descricao</th>
							<th>Valor</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td>tipo de interface</td>
							<td><?= decodificarTipo(pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.2.2.1.3.".$wi))?></td>
						  </tr>
						  <tr>
							<td>tamanho maximo do datagrama suportado pela  interface</td>
							<td><?= pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.2.2.1.4.".$wi)?></td>
						  </tr>
						  <tr>
							<td>largura de banda da interface</td>
							<td><?= pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.2.2.1.5.".$wi)?>bps</td>
						  </tr>
						  <tr>
							<td>Status</td>
							<td><?= decodificarifAdminStatus(pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.2.2.1.7.".$wi)) ?></td>
						  </tr>
						</tbody>
					  </table>
					
					</div>
				<?php } ?>
			<div class="panel-body">
</div>
			<?php
			$pegarIPS = pegarValorOIDWALK($ip, "public", "1.3.6.1.2.1.4.20");
			for($i=0;$i<2;$i++){ 
			?>

				<div  class="panel panel-info" style="margin:10px;">
					<div class="panel-heading">
						<h3 class="panel-title">
							Informacoes de IP - <?= $array[$i] ?>
						</h3>
					</div>
					<div class="panel-body">
						<table class="table">
							<thead>
							  <tr>
								<th>Descricao</th>
								<th>Valor</th>
							  </tr>
							</thead>
							<tbody>
							  <tr>
								<td>Atuando como roteador</td>
								<td><?= decodificaripForwarding(pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.4.1.0"))?></td>
							  </tr>
							  <tr>
								<td>o endereço IP desta entrada</td>
								<td><?= pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.4.20.1.1.".$pegarIPS[$i])?></td>
							  </tr>
							  <tr>
								<td>Mascara</td>
								<td><?= pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.4.20.1.3.".$pegarIPS[$i])?></td>
							  </tr>
							  <tr>
								<td>Classe</td>
								<td><?= decodificarClasse(pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.4.20.1.2.".$pegarIPS[$i]))?></td>
							  </tr>
							</tbody>
						  </table>
					</div>
					
				</div>
			<?php } ?>
			</div>
			<!---
			$tabelaRoteamento = pegarValorOIDWALK($ip, "public", "1.3.6.1.2.1.4.21");
			for($i=0;$i<2;$i++){
				echo '
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">
							Informacoes de IP
						</h3>
					</div>
					<div class="panel-body">
						<table class="table">
							<thead>
							  <tr>
								<th>Descricao</th>
								<th>Valor</th>
							  </tr>
							</thead>
							<tbody>
							  <tr>
								<td>Ddestination IP address of this route.</td>
								<td>'.pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.4.21.1.1.".$tabelaRoteamento[$i]).'</td>
							  </tr>
							  <tr>
								<td>Mascara</td>
								<td>'.pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.4.21.1.2.".$tabelaRoteamento[$i]).'</td>
							  </tr>
							  <tr>
								<td>Classe</td>
								<td>'.pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.4.21.1.2.".$tabelaRoteamento[$i]).'</td>
							  </tr>
							</tbody>
						  </table>
					</div>
				</div>';
			}
			*/
			?>
			-->
				</div>
			</div>
		</div>
	</div>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div  class="panel panel-info">
				<div class="panel-heading" onclick="toggle('infotcp');">
					<h3 class="panel-title">
						Informacoes TCP
					</h3>
				</div>
				<div id="infotcp"  style="display:none;" class="panel-body">
					<table class="table">
						<thead>
						  <tr>
							<th>Descricao</th>
							<th>Valor</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td>algoritmo utilizado para determinar o "time out" de retransmissao de octetos TCP nao confirmados</td>
							<td><?= decodificadortcpRtoAlgorithm(pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.6.1.0"))?></td>
						  </tr>
						  <tr>
							<td>valor minimo permitido para o "time-out"de retransmissao TCP</td>
							<td><?= pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.6.2.0")?> ms</td>
						  </tr>
						  <tr>
							<td>valor maximo permitido para o "time-out"de retransmissao TCP</td>
							<td><?= pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.6.3.0")?> ms</td>
						  </tr>
						  <tr>
							<td>limite de conexoes que podem ser abertas pela entidade de transporte do dispositivo</td>
							<td><?= decodificartcpMaxConn(pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.6.4.0"))?></td>
						  </tr>
						  <tr>
							<td>numero de conexoes de transporte corretamente abertas</td>
							<td><?= pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.6.9.0")?></td>
						  </tr>
						</tbody>
					  </table>
				</div>
			</div>
			<div  class="panel panel-info">
				<div class="panel-heading" onclick="toggle('infosnmp');">
					<h3 class="panel-title">
						Informacoes do SNMP
					</h3>
				</div>
				<div id="infosnmp" style="display:none;"  class="panel-body">
					<table class="table">
						<thead>
						  <tr>
							<th>Descricao</th>
							<th>Valor</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td> indica se o agente SNMP pode enviar traps</td>
							<td><?= descodificarsnmpEnableAuthTraps(pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.11.30.0"))?></td>
						  </tr>
						</tbody>
					  </table>
				</div>
			</div>
		</div>
		
	</div>
</div>

<?php include_once "../templates/footer.php"; ?>