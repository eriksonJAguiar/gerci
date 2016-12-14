<?php
	include('../templates/header.php');
	include('../../controllers/seguranca/controller.php');
?>

<?php




	$output = setFunction("172.16.103.5","-v");
	$saida = getPorts($output);

	foreach ($saida as $i => $value) {
		echo $saida[$i]."<br />";
	}






?>

<?php include('../templates/footer.php'); ?>
