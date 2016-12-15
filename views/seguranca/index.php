<?php
	include('../templates/header.php');
	include('../../controllers/seguranca/controller.php');
?>

<style >
.segun{
	background: #fcfff4; /* Old browsers */
	background: -moz-linear-gradient(top,  #fcfff4 0%, #e9e9ce 100%); /* FF3.6-15 */
	background: -webkit-linear-gradient(top,  #fcfff4 0%,#e9e9ce 100%); /* Chrome10-25,Safari5.1-6 */
	background: linear-gradient(to bottom,  #fcfff4 0%,#e9e9ce 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#e9e9ce',GradientType=0 ); /* IE6-9 */
}
</style>

<br />
<div class="row">

	<?php foreach(getDispositivos() as $dispositivo){ ?>
		<form action="detalhes.php?idIPD=<?=$dispositivo->getId()?>" method="post">
			<div class="col-md-2">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<img src="img/desktop.png" width="200" class="img-responsive img-rounded">
					</div>
						<div class="segun panel-footer">
							<h5 class="text-center" style="text-shadow: 0.1px 0.1px 0.1px #000000;">IP: <?=$dispositivo->getIp() ?> </h5>
							<div class="row text-center">
								<label class="radio"><input type="radio" value="11" name="optradio">10 Open/Closed</label>
								<label class="radio"><input type="radio" value="21" name="optradio">20 Open/Closed</label>
								<label class="radio"><input type="radio" value="31" name="optradio">30 Open/Closed</label>
							</div>
							<input type="submit" value="Visualizar" class="btn btn-primary btn-block" />
						</div>
				</div>
			</div>
		</form>
	<?php } ?>


</div>

<hr>


<?php
	include('../templates/footer.php');
?>
