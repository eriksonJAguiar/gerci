<?php 
include_once "../templates/header.php"; 
include_once "../../model/Dispositivo.php";
include_once "../../dao/GenericDAO.php";
$dao = new GenericDAO("dispositivos", "Dispositivo");
$dispositivo = new Dispositivo();
$dispositivo->setId(1);
$dispositivo->setIp("172.16.103.32");
$dispositivo->setLocal("Lab 3");
$dispositivo->setDescricao("Um pc muito legal do grimes");
$dispositivos = array();
array_push($dispositivos, $dispositivo);
?>

<div class="container" style="padding-top: 15px">
    <table class="table table-hover">
        <thead>
            <tr>
                <td>IP</td>
                <td>Local</td>
                <td>Descrição</td>
            </tr>
            <tbody>
            <?php
            foreach($dispositivos as $dispositivo){
                $cor = "";
                if(false){
                    
                }
            ?>
                <tr class="<?=$cor?>">
                    <td><?=$dispositivo->getIp()?></td>
                    <td><?=$dispositivo->getLocal()?></td>
                    <td><?=$dispositivo->getDescricao()?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </thead>
    </table>
</div>

<?php include_once "../templates/footer.php"; ?>