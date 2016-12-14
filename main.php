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
    <link href="resources/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="resources/css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="resources/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="resources/css/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="resources/fonts/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- jQuery -->
    <script src="resources/js/jquery.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../../main.php">Gerci v1.0</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="main.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Áreas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="./views/contabilizacao/">Contabilização</a>
                                </li>
                                <li>
                                    <a href="./views/desempenho/">Desempenho</a>
                                </li>
                                <li>
                                    <a href="./views/falhas/">Falhas</a>
                                </li>
                                <li>
                                    <a href="./views/seguranca/">Segurança</a>
                                </li>
                                <li>
                                    <a href="./views/configuracao/">Configuração</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#form-registrar").on('submit', function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "./controllers/DispositivosController.php",
                        data: new FormData(this),
                        contentType: false,
                        processData: false,
                        cache: false,
                        success: function (response) {
                            if(response=='success'){
                                location.reload();
                            }else if(response=='empty'){
                                alert("Preencha todos os dados.");
                            }else{
                                alert(response);
                            }
                        }
                    });
                    return false;
                });
            });
        </script>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-xl-12">
                    <div class="container" style="padding-top: 15px">
                        <form id="form-registrar">
                            <table class="table table-striped table-responsive">
                                <thead>
                                    <th>IP</th>
                                    <th>Descrição</th>
                                    <th>Local</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="ip" placeholder="192.168.1.1">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="descricao" placeholder="Descrição do dispositivo">
                                        </td>
                                        <td class="form-inline">
                                            <input type="text" class="form-control" name="local" placeholder="Local do dispositivo">
                                            <input type="submit" class="btn btn-deafult" value="Enviar">
                                        </td>
                                    </tr>
                                    <?php
                                    include_once './model/Dispositivo.php';
                                    include_once './dao/GenericDAO.php';
                                    $dao = new GenericDAO("maquinas", "Dispositivo");
                                    $dispositivos = $dao->getAll();
                                    foreach($dispositivos as $dispositivo){
                                    ?>

                                    <tr>
                                        <td>
                                            <?=$dispositivo->getIp()?>
                                        </td>
                                        <td>
                                            <?=$dispositivo->getDescricao()?>
                                        </td>
                                        <td>
                                            <?=$dispositivo->getLocal()?>
                                        </td>
                                    </tr>

                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
    <!-- /.col-lg-12 -->
            </div>
           <!--conteudo da pagina-->
        </div>
        <!-- /#page-wrapper -->
    
    </div>
    <!-- /#wrapper -->

    

    <!-- Bootstrap Core JavaScript -->
    <script src="resources/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="resources/js/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="resources/js/raphael.min.js"></script>
    <script src="resources/js/morris.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="resources/js/sb-admin-2.js"></script>

    </body>
</html>
