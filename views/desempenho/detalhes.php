<?php
include_once "../templates/header.php";
echo $_GET['ip'];


echo("jdnfvijndefiv".snmp2_get($_GET['ip'], "public", "1.3.6.1.2.1.11.1"));
echo("sidfvbisdfv".snmp2_get($_GET['ip'], "public", "1.3.6.1.2.1.11.2"));

?>

<?php include_once "../templates/footer.php"; ?>