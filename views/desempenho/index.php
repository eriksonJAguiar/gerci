<?php 
include_once "../templates/header.php"; 
include_once "../../model/Dispositivo.php";
include_once "../../dao/GenericDAO.php";
$dao = new GenericDAO("maquinas", "Dispositivo");
$dispositivos = $dao->getAll();
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
                <tr class="<?=$cor?>" onMouseOver="this.style.cursor='pointer'" onclick="verDispositivo('<?=$dispositivo->getIp()?>')">
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