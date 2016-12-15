<?php include('../templates/header.php');

?>

	<!-- Início do container -->
	<div class="container">
		<br/>

		<div class="alert alert-info">
 			 <strong></strong> 
			 <style>
			 h1 {
				font-size: 20px;
				text-align: center;
			 }
			 </style>
				<h1> Gerência de Rede - Contabilização </h1> 
			<br/>
			<br/>
			<br/>
			<button type="button" class="btn btn-default" onClick="location.href=('http://localhost/gerci/views/contabilizacao/index.php')">Voltar </button>
			<br/>
			<br/>
			<br/>
			<div>
				<?php echo "HOST: ".$_GET['ip']; ?>	
					<br/>
					<br/>
					 
					<table class="table table-condensed">
						<thead>
							<tr>
								<th>Informações </th>
								<th>Valores </th> 
							</tr>
						</thead> 
						
						<tbody/>

							<tr>
                                                                <td> Descrição da maquina </td>
                                                                <td>
                                                                <?php 
                                                                        $host = $_GET['ip'];
                                                                        $community = "public";
                                                                      	$sysdesc = snmpget($host,$community,"iso.3.6.1.2.1.1.1.0");

	                                                                echo substr($sysdesc,8);
                                                                ?>
                                                                 </td>

                                                        </tr>

							<tr>
                                                                <td> Localização da maquina </td>
                                                                <td>
                                                                <?php 
                                                                        $syslocation = snmpget($host,$community,"iso.3.6.1.2.1.1.6.0");

                                                                echo substr($syslocation,8);
                                                                ?>
                                                                 </td>

                                                        </tr>

							<tr>
                                                                <td> tempo de maquina ligada </td>
                                                                <td>
                                                                <?php 
                                                                       $sysuptime = snmpget($host,$community,"iso.3.6.1.2.1.25.1.1.0");

                                                                echo substr($sysuptime,20);
                                                                ?>
                                                                 </td>

                                                        </tr>


                                                        <tr>
                                                                <td> total de mensagens entregues ao SNMP </td>
                                                                <td>
                                                                <?php 
                                                                        $snmpmensagem = snmpget($host,$community,"iso.3.6.1.2.1.11.1.0");

                                                                echo substr($snmpmensagem,11);
                                                                ?>
                                                                 </td>

                                                        </tr>


							<tr>
                                                                <td> Interfaces de rede presentes no sistema </td>
                                                                <td>
                                                                <?php 
                                                                        $intf = snmpget($host,$community,"iso.3.6.1.2.1.2.1.0");

                                                                echo substr($intf,8);
                                                                ?>
                                                                 </td>

							<tr>
								<td> taxa de bytes recebidos </td>
								<td>
								<?php
								 $intfrecebido = snmpwalk($host,$community,"1.3.6.1.2.1.2.2.1.2");
									$outoctetrecebido = snmpwalk($host,$community,"1.3.6.1.2.1.2.2.1.10");
								for ($i=0;$i<count($intfrecebido);$i++){
								$intfrecebido[$i] = str_replace("STRING: ", "",$intfrecebido[$i]);
								$intfrecebido[$i] = str_replace("\"", "",$intfrecebido[$i]);
								$outoctetrecebido[$i] = str_replace("Counter32:", "",$outoctetrecebido[$i]);
								
								?> 
								<?= $intfrecebido[$i] ?>: <?=$outoctetrecebido[$i]?><br />
								<?php
									}
								?>
								 </td>
								
							</tr>
							
							<tr>
								<td> taxa de bytes enviados </td>
								<td> 
								<?php
								 $intfrenviado = snmpwalk($host,$community,"1.3.6.1.2.1.2.2.1.2");
									$outocteenviado = snmpwalk($host,$community,"1.3.6.1.2.1.2.2.1.16");
								for ($i=0;$i<count($intfrenviado);$i++){
								$intfrenviado[$i] = str_replace("STRING: ", "",$intfrenviado[$i]);
								$intfrenviado[$i] = str_replace("\"", "",$intfrenviado[$i]);
								$outocteenviado[$i] = str_replace("Counter32:", "",$outocteenviado[$i]);
								
								?> 
								<?= $intfrenviado[$i] ?>: <?=$outocteenviado[$i]?><br />
								<?php
									}
								?>
								</td>
								
							</tr>
							
							<tr>
								<td> taxa de pacotes unicast  recebidos </td>
								<td> 
								<?php
								$unicastrecebido = snmpwalk($host,$community,"1.3.6.1.2.1.2.2.1.2");
								$pacoteunicast = snmpwalk($host,$community,"1.3.6.1.2.1.2.2.1.17");
								for ($i=0;$i<count($unicastrecebido);$i++){
								$unicastrecebido[$i] = str_replace("STRING: ", "",$unicastrecebido[$i]);
								$unicastrecebido[$i] = str_replace("\"", "",$unicastrecebido[$i]);
								$pacoteunicast[$i] = str_replace("Counter32:", "",$pacoteunicast[$i]);
								
								?> 
								<?= $unicastrecebido[$i] ?>: <?=$pacoteunicast[$i]?><br />
								<?php
									}
								?>
								</td>
								
							</tr>
							
							<tr>
								<td> taxa de pacotes unicast  enviados </td>
								<td>
								<?php
								$unicastenviado = snmpwalk($host,$community,"1.3.6.1.2.1.2.2.1.2");
								$pacoteunicasten = snmpwalk($host,$community,"1.3.6.1.2.1.2.2.1.11");
								for ($i=0;$i<count($unicastenviado);$i++){
								$unicastenviado[$i] = str_replace("STRING: ", "",$unicastenviado[$i]);
								$unicastenviado[$i] = str_replace("\"", "",$unicastenviado[$i]);
								$pacoteunicasten[$i] = str_replace("Counter32:", "",$pacoteunicasten[$i]);
								
								?> 
								<?= $unicastrecebido[$i] ?>: <?=$pacoteunicasten[$i]?><br />
								<?php
									}

								?>
								 </td>
								
							</tr>
							
							<tr>
								<td> taxa de pacotes no-unicast recebidos </td>
								<td> 
								<?php
								$nounirecebido = snmpwalk($host,$community,"1.3.6.1.2.1.2.2.1.2");
								$pacotenouni = snmpwalk($host,$community,"1.3.6.1.2.1.2.2.1.11");
								for ($i=0;$i<count($nounirecebido);$i++){
								$nounirecebido[$i] = str_replace("STRING: ", "",$nounirecebido[$i]);
								$nounirecebido[$i] = str_replace("\"", "",$nounirecebido[$i]);
								$pacotenouni[$i] = str_replace("Counter32:", "",$pacotenouni[$i]);
								
								?> 
								<?= $nounirecebido[$i] ?>: <?=$pacotenouni[$i]?><br />
								<?php
									}
								?>
								 </td>
								
							</tr>
							
							<tr>
								<td> taxa de pacotes no-unicast enviados </td>
								<td> 
									<?php
								$nounienviado = snmpwalk($host,$community,"1.3.6.1.2.1.2.2.1.2");
								$pacotenounien = snmpwalk($host,$community,"1.3.6.1.2.1.2.2.1.11");
								for ($i=0;$i<count($nounienviado);$i++){
								$nounienviado[$i] = str_replace("STRING: ", "",$nounienviado[$i]);
								$nounienviado[$i] = str_replace("\"", "",$nounienviado[$i]);
								$pacotenounien[$i] = str_replace("Counter32:", "",$pacotenounien[$i]);
								
								?> 
								<?= $nounienviado[$i] ?>: <?=$pacotenounien[$i]?><br />
								<?php
									}
								?>
								 </td>
								
							</tr>
							
							<tr>
								<td> numero de pacotes IP enviados </td>
								<td>
								<?php 
								$ipenviado = snmpget($host,$community, "iso.3.6.1.2.1.4.10.0"); 
								
								echo substr($ipenviado,10);
								?>
								 </td>
								
							</tr>
							
							<tr>
								<td> numero de pacotes IP recebidos </td>
								<td> 
                                                                <?php 
                                                                $pacoteiprecebido = snmpget($host,$community, "iso.3.6.1.2.1.4.3.0"); 

                                                                echo substr($pacoteiprecebido,10);
                                                                ?>
                                                                </td>

								
							</tr>
							
							<tr>
								<td> numero de pacotes IP de entrada entregues com sucesso </td>
								<td> 
                                                                <?php 
                                                                $iprecebidook = snmpget($host,$community, "iso.3.6.1.2.1.4.9.0"); 

                                                                echo substr($iprecebidook,10);
                                                                ?>
                                                                </td>
								
							</tr>
							
							<tr>
								<td> numero de vezes que o sistema abriu uma conexao  </td>
								<td>
                                                                <?php
                                                                $tcpconexao = snmpget($host,$community, "iso.3.6.1.2.1.6.5.0"); 

                                                                echo substr($tcpconexao,10);
                                                                ?>
                                                                </td>

								
							</tr>
							
							<tr>
								<td> numero de vezes que o sistema recebeu um pedido de abertura de conexao  </td>
								<td>
								<?php
                                                                $tcppedidoconexao = snmpget($host,$community, "iso.3.6.1.2.1.6.6.0"); 

                                                                echo substr($tcppedidoconexao,10);
                                                                ?>
                                                                </td>

								
							</tr>
							
							<tr>
								<td> numero total de segmentos TCP recebidos  </td>
								<td>
                                                                <?php
                                                                $tcptotalrecebido = snmpget($host,$community, "iso.3.6.1.2.1.6.10.0"); 

                                                                echo substr($tcptotalrecebido,10);
                                                                ?>
                                                                </td>
								
							</tr>
							
							<tr>
								<td> numero total de segmentos TCP emitidos   </td>
								<td>
                                                                <?php
                                                                $tcptotalemitido = snmpget($host,$community, "iso.3.6.1.2.1.6.11.0"); 

                                                                echo substr($tcptotalemitido,10);
                                                                ?>
                                                                </td>

								
							</tr>
							
							<tr>
								<td> numero total de datagramas UDP recebidos  </td>
								<td>
                                                                <?php
                                                               	$udprecebido = snmpget($host,$community, "iso.3.6.1.2.1.7.1.0"); 

                                                                echo substr($udprecebido,10);
                                                                ?>
                                                                </td>

								
							</tr>
							
							<tr>
								<td> numero total de datagramas UDP enviados  </td>
								<td>
                                                                <?php
                                                                $udpenviado = snmpget($host,$community, "iso.3.6.1.2.1.7.4.0"); 

                                                                echo substr($udpenviado,10);
                                                                ?>
                                                                </td>

								
							</tr>
							
							<tr>							<tr>
								<td> taxa de pacotes SNMP recebidos </td>
								<td>
                                                                <?php
                                                                $snmprecebido = snmpget($host,$community, "iso.3.6.1.2.1.11.1.0"); 

                                                                echo substr($snmprecebido,10);
                                                                ?>
                                                                </td>

								
							</tr>
							
							<tr>
								<td> taxa de pacotes SNMP enviados </td>
								<td>
                                                                <?php
                                                                $snmpenviado = snmpget($host,$community, "iso.3.6.1.2.1.11.2.0"); 

                                                                echo substr($snmpenviado,10);
                                                                ?>
                                                                </td>

								
							</tr>
							
							<tr>
								<td> taxa de traps recebidas </td>
								<td>
                                                                <?php
                                                                $traprecebida = snmpget($host,$community, "iso.3.6.1.2.1.11.19.0"); 

                                                                echo substr($traprecebida,10);
                                                                ?>
                                                                </td>

								
							</tr>
							
							<tr>
								<td> taxa de traps enviadas </td>
								<td>
                                                                <?php
                                                                $trapenviada = snmpget($host,$community, "iso.3.6.1.2.1.11.29.0"); 

                                                                echo substr($trapenviada,10);
                                                                ?>
                                                                </td>

								
							</tr>
							
							
							
							
							
							
							
						</tbody>
					</table>
			 
			</div>
			 
			 
			 

		</div>
	</div>
	<!-- Fim do container -->

<?php include('../templates/footer.php'); ?>
