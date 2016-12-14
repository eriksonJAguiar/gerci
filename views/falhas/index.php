<?php 
include('../templates/header.php'); 
$a = snmpwalk("172.16.103.11", "public", "1.3.6.1.2.1.11.6"); 
$b = snmpwalk("172.16.103.11", "public", "1.3.6.1.2.1.11.8"); 
$c = snmpwalk("172.16.103.11", "public", "1.3.6.1.2.1.11.9");
$d = snmpwalk("172.16.103.11", "public", "1.3.6.1.2.1.11.10");
$e = snmpwalk("172.16.103.11", "public", "1.3.6.1.2.1.11.11");
$f = snmpwalk("172.16.103.11", "public", "1.3.6.1.2.1.11.12");
$g = snmpwalk("172.16.103.11", "public", "1.3.6.1.2.1.11.20");
$h = snmpwalk("172.16.103.11", "public", "1.3.6.1.2.1.11.21");
$i = snmpwalk("172.16.103.11", "public", "1.3.6.1.2.1.11.22");
$j = snmpwalk("172.16.103.11", "public", "1.3.6.1.2.1.11.24");
foreach ($a as $val) {
    echo "$val\n";
}
foreach ($b as $val) {
    echo "$val\n";
}
foreach ($c as $val) {
    echo "$val\n";
}
foreach ($d as $val) {
    echo "$val\n";
}
foreach ($e as $val) {
    echo "$val\n";
}
foreach ($f as $val) {
    echo "$val\n";
}
foreach ($g as $val) {
    echo "$val\n";
}
foreach ($h as $val) {
    echo "$val\n";
}
foreach ($i as $val) {
    echo "$val\n";
}
foreach ($j as $val) {
    echo "$val\n";
}
?>

	<!-- Início do container -->
	<div class="">
		<br/>
		<div class="alert alert-info">
 			 <strong>Info!</strong> 
			 
			 <table class="table table-hover">
			 
			 
			 
		</div>
	</div>
	<!-- Fim do container -->

<?php include('../templates/footer.php'); ?>
