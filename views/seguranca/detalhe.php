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
  <div class="row">

  	<div class="col-md-12">
  		<div class="panel panel-primary">
  				<div class="panel-heading">
  					<h3 class="panel-title">
  						<i class="fa fa-desktop" aria-hidden="true"></i>
  					</h3>
  				</div>
  				<div class="panel-body">
  					<div class="col-md-12">
  					<table class="table table-bordered">
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

  							<tr>
  								<td>
  									80/tcp
  								</td>
  								<td>
  									open
  								</td>
  								<td>
  									http
  								</td>
  							</tr>

  						</tbody>
  					</table>

            <span style="text-shadow: 0.01px 0.01px 0.01px #000000;">Vulnerabilidade: </span> <span class="label label-danger">Alta</span>

  				</div>
  			</div>

        <div class="panel-footer">
          <button type="button" class="btn btn-primary btn-block btn-lg">Verificar Vulnerabilidade</button>
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
