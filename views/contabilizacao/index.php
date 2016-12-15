<?php 
include('../templates/header.php');
include('../../model/Dispositivo.php');
include('../../dao/GenericDAO.php');

$dao = new GenericDAO('maquinas','Dispositivo');

$dispositivos = $dao->getAll();
 ?>

	<!-- Início do container -->
	<div class="container">
		<br/>
		<div class="alert alert-info">
 			 <strong> </strong> 
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
			 <br/>
			 <button type="button" class="btn btn-default" onClick="location.href=('')">Voltar </button>
			 <br/>
			 <br/>
			 <br/>
			 
			 
			 <div>
			 

				<table  class="table table-condensed">
					<thead>
						<tr>
							<th>Endereço IP </th>
							
							
							</tr>
							
					</thead>
					
					<tbody>
						<?php
						foreach($dispositivos as $dispositivo){
						?>
						<tr>
							<td><?=$dispositivo->getIp()?></td>
							<td><button type="button" class="btn btn-default" onClick="location.href=('http://localhost/gerci/views/contabilizacao/results.php?ip=<?=$dispositivo->getIp()?>')">Selecionar</button></td>
							
						</tr>
						<?php } ?>
					</tbody>
				</table>


			 </div>
			 
			 
		</div>
		
	</div>
	<!-- Fim do container -->

<?php include('../templates/footer.php'); ?>
