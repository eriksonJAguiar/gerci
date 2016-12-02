<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GERCI Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="./resources/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="./resources/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./resources/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./resources/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>
    <script>
        $(document).ready(function () {
            $("#form-logar").on('submit', function (e) {
                $('#logar-loading').css('display', 'inline');
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../controllers/LoginController.php",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (response) {
                        if (response == 'success') {
                            $("#mensagem").removeClass("alert-danger alert-warning");
                            $("#mensagem").addClass("alert alert-success");
                            $("#mensagem").html("Logado com sucesso!");
                            window.location.href = "./index.php";
                        }
                        else if (response == 'error') {
                            $("#mensagem").removeClass("alert-success alert-warning");
                            $("#mensagem").addClass("alert alert-danger");
                            $("#mensagem").html("Usuário ou senha incorretos.");
                            $('#logar-loading').css('display', 'none');
                        }
                        else if (response == 'empty') {
                            $("#mensagem").removeClass("alert-success alert-danger");
                            $("#mensagem").addClass("alert alert-warning");
                            $("#mensagem").html("Preencha todos os campos.");
                            $('#logar-loading').css('display', 'none');
                        }
                        else if(response.indexOf("Array")!==-1){
                            $("#mensagem").removeClass("alert-success alert-warning");
                            $("#mensagem").addClass("alert alert-danger");
                            $("#mensagem").html("Mude pelo menos um campo.");
                            $('#logar-loading').css('display', 'none');
                        }
                        else{
                            $("#mensagem").removeClass("alert-success alert-warning");
                            $("#mensagem").addClass("alert alert-danger");
                            $("#mensagem").html(response);
                            $('#logar-loading').css('display', 'none');
                        }
                    }
                });
                return false;
            });
        });
    </script>
    
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default" style="margin-top: 25%">
                    <div class="panel-heading">
                        <h3 class="panel-title">Logar</h3>
                    </div>
                    <div class="panel-body">
                        <form id="form-logar" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="RA" name="ra" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="senha" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="lembrar" type="checkbox" value="Lembrar">Lembrar
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Entrar">

   
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="./resources/js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./resources/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./resources/js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="./resources/js/sb-admin-2.js"></script>

    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
