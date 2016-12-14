<?php 
include_once "../templates/header.php"; 
include_once "../../model/Dispositivo.php";
include_once "../../dao/GenericDAO.php";
include_once "../../controllers/configuracao/C_Dispositivos.php";
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
				<td><h3>Status</h3></td>
            </tr>
            <tbody>
            <?php
			$dispositivos = pegarDispositivos();
            foreach($dispositivos as $dispositivo){
				$status = @statusDispositivo($dispositivo->getIp(), "public");
			if(empty($status)){
				$status = "<img src='img/offline2.png'\>";
			}else{
				$status = "<img src='img/online2.png'\>";
			}
            ?>
                <tr class="<?=$cor?>" onMouseOver="this.style.cursor='pointer'" onclick="verDispositivo('<?=$dispositivo->getIp()?>')">
                    <td><h4><?=$dispositivo->getIp()?></h4></td>
                    <td><h4><?=$dispositivo->getLocal()?></h4></td>
                    <td><h4><?=$dispositivo->getDescricao()?></h4></td>
					<td><h4><?=$status?></h4></td>
                </tr>
                
            <?php
            }
            ?>
            </tbody>
        </thead>
    </table>
</div>

<?php include_once "../templates/footer.php"; ?>