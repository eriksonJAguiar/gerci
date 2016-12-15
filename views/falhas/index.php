<?php 
include('../templates/header.php');
include('../../dao/GenericDAO.php');
include('../../model/Dispositivo.php');
 
$dao = new GenericDAO("maquinas","Dispositivo");
$dispositivos = $dao->getAll();

?>

	<!-- Início do container -->
	<div class="">
		<br/>
		<div class="alert alert-info">
 			 <strong></strong> 
	<?php
        echo('<br />'.date('H:i:s'))
	?>
 
	<script type="text/javascript">
 
    Redirect();
    function Redirect()
    {
        setTimeout("location.reload(true);",5000);   
    }
 
</script>
			 <table class="table">
    <thead>
      <tr>
        <th>IP</th>
        <th>Descrição</th>
        <th>InASNParseErrs</th>
		<th>InTooBigs</th>
		<th>InNoSuchNames</th>
		<th>InBadValues</th>
		<th>InReadOnlys</th>
		<th>InGenErrs</th>
		<th>OutTooBigs</th>
		<th>OutNoSuchNames</th>
		<th>OutBadValues</th>
		<th>OutGenErrs</th>
      </tr>
    </thead>
    <tbody>
<?php
for($i=0;$i<count($dispositivos);$i++){
	$nome = $dispositivos[$i]->getDescricao(); 

	$a = substr(snmpget($dispositivos[$i]->getIp(), "public", "1.3.6.1.2.1.11.6.0"), 11); /* InASNParseErrs */
	if($a<=10){
		$aClasse = "success";
	}else if($a<=20){
		$aClasse = "warning";
	}else{
		$aClasse = "danger";
	}

	$b = substr(snmpget($dispositivos[$i]->getIp(), "public", "1.3.6.1.2.1.11.8.0"), 11); /* InTooBigs */
	if($b<=10){
		$bClasse = "success";
	}else if($b<=20){
		$bClasse = "warning";
	}else{
		$bClasse = "danger";
	}	

	$c = substr(snmpget($dispositivos[$i]->getIp(), "public", "1.3.6.1.2.1.11.9.0"), 11); /* InNoSuchNames */
	if($c<=10){
		$cClasse = "success";
	}else if($c<=20){
		$cClasse = "warning";
	}else{
		$cClasse = "danger";
	}	

	$d = substr(snmpget($dispositivos[$i]->getIp(), "public", "1.3.6.1.2.1.11.10.0"), 11); /* InBadValues */
	if($d<=10){
		$dClasse = "success";
	}else if($d<=20){
		$dClasse = "warning";
	}else{
		$dClasse = "danger";
	}	

	$e = substr(snmpget($dispositivos[$i]->getIp(), "public", "1.3.6.1.2.1.11.11.0"), 11); /* InReadOnlys */
	if($e<=10){
		$eClasse = "success";
	}else if($e<=20){
		$eClasse = "warning";
	}else{
		$eClasse = "danger";
	}	

	$f = substr(snmpget($dispositivos[$i]->getIp(), "public", "1.3.6.1.2.1.11.12.0"), 11); /* InGenErrs */
	if($f<=10){
		$fClasse = "success";
	}else if($f<=20){
		$fClasse = "warning";
	}else{
		$fClasse = "danger";
	}
	
	$g = substr(snmpget($dispositivos[$i]->getIp(), "public", "1.3.6.1.2.1.11.20.0"), 11); /* OutTooBigs */
	if($g<=10){
		$gClasse = "success";
	}else if($g<=20){
		$gClasse = "warning";
	}else{
		$gClasse = "danger";
	}
	
	$h = substr(snmpget($dispositivos[$i]->getIp(), "public", "1.3.6.1.2.1.11.21.0"), 11); /* OutNoSuchNames */
	if($h<=10){
		$hClasse = "success";
	}else if($h<=20){
		$hClasse = "warning";
	}else{
		$hClasse = "danger";
	}	
	$k = substr(snmpget($dispositivos[$i]->getIp(), "public", "1.3.6.1.2.1.11.22.0"), 11); /* OutBadValues */
	if($k<=10){
		$kClasse = "success";
	}else if($k<=20){
		$kClasse = "warning";
	}else{
		$kClasse = "danger";
	}
	
	$j = substr(snmpget($dispositivos[$i]->getIp(), "public", "1.3.6.1.2.1.11.24.0"), 11); /* OutGenErrs  */
	if($j<=10){
		$jClasse = "success";
	}else if($j<=20){
		$jClasse = "warning";
	}else{
		$jClasse = "danger";
	}	
	
?>



      <tr>
        <td><?= $dispositivos[$i]->getIp() ?></td>
        <td><?= $nome ?></td>
		
        <td class="<?=$aClasse?>"><?= $a ?></td>
		<td class="<?=$bClasse?>"><?= $b ?></td>
		<td class="<?=$cClasse?>"><?= $c ?></td>
		<td class="<?=$dClasse?>"><?= $d ?></td>
		<td class="<?=$eClasse?>"><?= $e ?></td>
		<td class="<?=$fClasse?>"><?= $f ?></td>
		<td class="<?=$gClasse?>"><?= $g ?></td>
		<td class="<?=$hClasse?>"><?= $h ?></td>
		<td class="<?=$kClasse?>"><?= $k ?></td>
		<td class="<?=$jClasse?>"><?= $j ?></td>
      </tr>
    
<?php } ?>
<table class="table table-striped">
    <thead>
      <tr>
        <th>Error type</th>
        <th>Descrição</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Too Big</td>
        <td>A operação produziu um valor muito grande para caber em uma única mensagem SNMP.
</td>
      </tr>
      <tr>
        <td>No Such</td>
        <td>A operação especificou um objeto que não existe na MIB.</td>
      </tr>
	  <tr>
        <td>Bad Value</td>
        <td>O valor especificado pertence a um tipo não conhecido de dado, ou a sintaxe da operação está errada.</td>
      </tr>
	  <tr>
        <td>Read Only</td>
        <td>O perfil comunitário específica que o objeto não pode ser escrito.</td>
      </tr>
      <tr>
        <td>General Error</td>
        <td>SNMP falhou em completar a operação por uma razão que não é qualificada em nenhuma outra categoria.</td>
      </tr>
    </tbody>
  </table>	 
			 
		</div>
	</div>
	<!-- Fim do container -->

<?php include('../templates/footer.php'); ?>