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
<style>
    tr:hover{
        cursor: hand;
    }
</style>

<script>
    function verDispositivo(ip){
        window.location.href = "./detalhes.php?ip=" + ip;
    }
</script>

<div class="" style="padding-top: 15px">
    <table class="table table-hover">
        <thead>
            <tr>
                <td><h3>IP</h3></td>
                <td><h3>Local</h3></td>
                <td><h3>Descrição</h3></td>
            </tr>
            <tbody>
            <?php
            foreach($dispositivos as $dispositivo){
                $cor = "";
                if(false){
                    
                }
            ?>
                <tr class="<?=$cor?>" onMouseOver="this.style.cursor='pointer'" onclick="verDispositivo('<?=$dispositivo->getIp()?>')">
                    <td><h4><?=$dispositivo->getIp()?></h4></td>
                    <td><h4><?=$dispositivo->getLocal()?></h4></td>
                    <td><h4><?=$dispositivo->getDescricao()?></h4></td>
                </tr>
                
            <?php
            }
            ?>
            </tbody>
        </thead>
    </table>
</div>

<?php include_once "../templates/footer.php"; ?>