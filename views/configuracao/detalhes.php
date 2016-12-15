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
	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
	
</script>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-info" >
				<div class="panel-heading">
					<h3 class="panel-title">
						Informações do Sistema
					</h3>
				</div>
				<div class="panel-body">
					<table class="table table-condensed">
						<thead>
						  <tr>
							<th>Descrição</th>
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
<?php 
	$quant = pegarValorOIDWALK($ip, "public", "1.3.6.1.2.1.25.2.3");
	if(count($quant)<=2){
		
	?>
	<div class="alert alert-danger">
	  <strong>ERROR:</strong> Esse computador não possui partes da mib, então é impossivel carregar as informações!
	</div>
	<?php	
		die();
	}
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
		<?php 
		$interfaces = pegarValorOIDWALK($ip, "public", "1.3.6.1.2.1.2.2.1.2");
		$alert;
		if(count($interfaces)<$maxInterfaces){
						$color = "#a2f096";
						$alert = "panel-success";
						$descricaoInter = "Você está com uma quantidade aceitavel de interfaces!";	
				}else if(count($interfaces)==$maxInterfaces){
						$color = "#f5ffa4";
						$alert = "panel-warning";
						$descricaoInter = "Atenção você esta no limite de interfaces permitidas!";	
				}else{
					$color = "#f09696";
					$alert = "panel-danger";
					$descricaoInter = "Você está com uma quantidade maior que o permitido!";
				}
		?>
			<div class="panel <?= $alert ?>" >
				<div class="panel-heading" onclick="toggle('infointer2');" style="background:<?=$color?>;">
					<h3 class="panel-title">
						Informações de Interface
					</h3>
				</div>
				<div class="panel-body" id="infointer2" style="display:none;" >
				<?php 
				$array = array();
				$color;
				
				for ($wi=1;$wi<count($interfaces)+1;$wi++){
					array_push($array, pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.2.2.1.2.".$wi));
				
				?>
						<a href="#" data-toggle="tooltip" title="<?=$descricaoInter?>">
				<div class="panel-heading" style="margin:5px; background: <?= $color?>;color:black;">
					<h3 class="panel-title">
					
					
						<?= pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.2.2.1.2.".$wi)?>
						
					</h3>
				</div>
				</a>
				<div class="panel-body">
					<table class="table">
						<thead>
						  <tr>
							<th>Descrição</th>
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
							Informações de IP - <b><?= $array[$i] ?></b>
						</h3>
					</div>
					<div class="panel-body">
						<table class="table">
							<thead>
							  <tr>
								<th>Descrição</th>
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
							Informações de IP
						</h3>
					</div>
					<div class="panel-body">
						<table class="table">
							<thead>
							  <tr>
								<th>Descrição</th>
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
						Informações TCP
					</h3>
				</div>
				
				<div id="infotcp"  style="display:none;" class="panel-body">
					<table class="table">
						<thead>
						  <tr>
							<th>Descrição</th>
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
						  
						  <?php
						  $color;
						  $totalConexao = pegarValorOIDGET($ip, "public", "1.3.6.1.2.1.6.9.0");
						  if($totalConexao<$maxConexaoTcp){
							$color = "#a2f096";
							$descricaoTcp = "Você está com uma quantidade aceitavel de conexões!";
							}else if($totalConexao>=$maxConexaoTcp && $totalConexao<=$maxConexaoTcp+2){
								$color = "#f5ffa4";
								$descricaoTcp = "Atenção você esta no limite de conexões permitidas!";									
							}else if($totalConexao>$maxConexaoTcp+2){
								$color = "#f09696";
								$descricaoTcp = "Você está com uma quantidade maior de conexões que o permitido!";
							}
						  ?>
						  
						  
							  <tr style="background:<?=$color?>;" href="#" data-toggle="tooltip" title="<?=$descricaoTcp?>">

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
						Informações do SNMP
					</h3>
				</div>
				<div id="infosnmp" style="display:none;"  class="panel-body">
					<table class="table">
						<thead>
						  <tr>
							<th>Descrição</th>
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
			<?php 
			$pegarSoftware = pegarValorOIDWALK($ip, "public", "1.3.6.1.2.1.25.6.3.1.2");
			if(count($pegarSoftware)<$maxSoftwares){
				$color = "#a2f096";
				$alert = "panel-success";
				$descricaoSoft = "Você está com uma quantidade aceitavel de programas instalados!";
			}else if(count($pegarSoftware)>=$maxSoftwares && count($pegarSoftware)<=$maxSoftwares+200){
				$color = "#f5ffa4";
				$alert = "panel-warning";
				$descricaoSoft = "Atenção você esta no limite de programas instalados!";									
			}else if(count($pegarSoftware)>$maxSoftwares+200){
				$color = "#f09696";
				$alert = "panel-danger";
				$descricaoSoft = "Você está com uma quantidade maior de programas instalados que o permitido!";
			}
			?>
			<div  class="panel <?= $alert ?>">
				<div class="panel-heading" onclick="toggle('infoss');" style="background: <?= $color; ?>;">
					<h3 class="panel-title">
						Informações de Software
					</h3>
				</div>
				<div id="infoss" style="display:none;"  class="panel-body">
					<table class="table">
						<thead>
						  <tr>
							<th colspan = "2">Softwares Instalados</th>
						  </tr>
						</thead>
						<tbody>
			<?php
			
			for($i=0;$i<count($pegarSoftware);$i++){ 
			?>
						  <tr>
							<td colspan = "2"><?= $pegarSoftware[$i];?></td>
						  </tr>
			<?php 
			}
			
			?>
							<tr style="background: <?= $color; ?>;" href="#" data-toggle="tooltip" title="<?=$descricaoSoft?>">
							
							<td><b>Quantidade de Software Instalados</b></td>
							<td><b><?= count($pegarSoftware); ?></b></td>
							
						  </tr>
						</tbody>
					  </table>
				</div>
			</div>
			<?php 
			$softwareExec = pegarValorOIDWALK($ip, "public", "1.3.6.1.2.1.25.4.2.1.2");
			if(count($softwareExec)<$maxSoftwaresExec){
				$color = "#a2f096";
				$alert = "panel-success";
				$descricaoSoftExe = "Você está com uma quantidade aceitavel de programas em execução!";
			}else if(count($softwareExec)>=$maxSoftwaresExec && count($softwareExec)<=$maxSoftwaresExec+10){
				$color = "#f5ffa4";
				$alert = "panel-warning";
				$descricaoSoftExe = "Atenção você esta no limite de programas em execução!";									
			}else if(count($softwareExec)>$maxSoftwaresExec+10){
				$color = "#f09696";
				$alert = "panel-danger";
				$descricaoSoftExe = "Você está com uma quantidade maior de programas em execução que é permitido!";
			}
			?>
			<div  class="panel <?= $alert ?>" >
				<div class="panel-heading" onclick="toggle('infosse');" style=" background: <?= $color; ?>;">
					<h3 class="panel-title">
						Informações de Software em Execução
					</h3>
				</div>
				<div id="infosse" style="display:none;"  class="panel-body">
					<table class="table">
						<thead>
						  <tr>
							<th colspan = "2">Software</th>
						  </tr>
						</thead>
						<tbody>
			<?php
			
			for($i=0;$i<count($softwareExec);$i++){ 
			?>
						  <tr>
							<td colspan = "2"><?= $softwareExec[$i];?></td>
						  </tr>
			<?php 
			}
			
			?>
							<tr style="background: <?= $color; ?>;" href="#" data-toggle="tooltip" title="<?=$descricaoSoftExe?>">
							
							<td><b>Quantidade de Instancia de Software Executando</b></td>
							<td><b><?= count($softwareExec); ?></b></td>
							
						  </tr>
						</tbody>
					  </table>
				</div>
			</div>
		</div>
		
	</div>
</div>

<?php include_once "../templates/footer.php"; ?>