<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Gerci - Sistema de Gerenciamento de Rede</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../resources/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../resources/css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../resources/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../../resources/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../resources/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="../../resources/js/jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="container-fluid">

  <?php
      include('../../controllers/seguranca/controller.php');
      $array_port = getPortsPrivate($_GET["idIPD"]);
   ?>
 <br />
  <a href="../seguranca/" class="btn btn-success btn-lg">Voltar</a>

  <div class="row">

  	<div class="col-md-12">
      <h3 style="text-shadow: 0.1px 0.1px 0.1px #000000;" >Open Ports</h3>
  		<div class="panel panel-primary">
  				<div class="panel-heading">
  					<h3 class="panel-title">
  						<i class="fa fa-desktop" aria-hidden="true"></i>
  					</h3>
  				</div>
  					<table class="table table-bordered table-hover">
  						<thead>
  							<tr>
  								<th>
  									PORT
  								</th>
  								<th>
  									STATE
  								</th>
  								<th>
  									SERVICE
  								</th>
  							</tr>
  						</thead>
  						<tbody>
                <?php foreach($array_port as $dispositivo){ ?>
  							<tr>
  								<td>
  									<?=$dispositivo->getPort() ?>
  								</td>
  								<td>
  									<?=$dispositivo->getState() ?>
  								</td>
  								<td>
  									<?=$dispositivo->getService() ?>
  								</td>
  							</tr>
                <?php }?>

  						</tbody>
  					</table>

  				</div>
  			</div>
  </div>

<hr>

<?php
    $saida = getTopPort($_GET["idIPD"],$_POST["optradio"]);
    $array = sepPort($saida);
 ?>


  <div class="row">
      <div class="col-md-12">
          <h3 style="text-shadow: 0.1px 0.1px 0.1px #000000;">Top <?php echo $_POST["optradio"]-1 ?> Most used Ports</h3>
      <div class="panel panel-primary">
        <table class="table table-bordered table-hover">
          <div class="panel-heading">
  					<h3 class="panel-title">
  						<i class="fa fa-desktop" aria-hidden="true"></i>
  					</h3>
  				</div>
          <thead>
            <tr>
              <th>
                PORT
              </th>
              <th>
                STATE
              </th>
              <th>
                SERVICE
              </th>
            </tr>
          </thead>
          <tbody>

            <?php foreach($array as $dispositivo){ ?>
            <tr>
              <td>
                <?=$dispositivo->getPort() ?>
              </td>
              <td>
                <?=$dispositivo->getState() ?>
              </td>
              <td>
                <?=$dispositivo->getService() ?>
              </td>
            </tr>
            <?php }?>

          </tbody>
        </table>
      </div>
    </div>
  </div>



  <hr>


  <?php
    $closed = 0;
    $open = 0;
    foreach($array as $dispositivo){
      if($dispositivo->getState() == "open"){
          $open++;
      }else if($dispositivo->getState() == "closed"){
        $closed++;
      }
    }
  ?>


  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {

          var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Closed',     <?php echo $closed; ?>],
            ['Open',      <?php echo $open; ?>]
          ]);

          var options = {
            title: 'Ports Open/Closed'
          };

          var chart = new google.visualization.PieChart(document.getElementById('piechart'));

          chart.draw(data, options);
        }


      </script>

  <div class="row">

    	<div class="col-md-4">
        <h3 style="text-shadow: 0.1px 0.1px 0.1px #000000;">Ports Open/Closed</h3>
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">
              <i class="fa fa-desktop" aria-hidden="true"></i>
            </h3>
            </div>
            <div class="panel-body">
              <div id="piechart" style="width: 400px; height: 300px;"></div>
            </div>
          </div>
        </div>
  </div>

</div>



<script src="../../resources/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../../resources/js/metisMenu.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="../../resources/js/raphael.min.js"></script>
<script src="../../resources/js/morris.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../../resources/js/sb-admin-2.js"></script>

</body>
</html>
