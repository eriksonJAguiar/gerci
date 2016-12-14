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
    <link href="resources/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="resources/css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="resources/css/sb-admin-2.css" rel="stylesheet">

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

    <script type="text/javascript">
        $(document).ready(function () {
            $("#form-logar").on('submit', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "./logar.php",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    cache: false,
                    success: function (response) {
                        if(response=='success'){
                            window.location.href = "./main.php";
                        }else if(response=='error'){
                            $("#mensagem").html("Login ou senha incorretos.");
                            $("#mensagem").addClass("alert alert-danger");
                        }else{
                            $("#mensagem").html(response);
                            $("#mensagem").addClass("alert alert-danger");
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
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Gerci - Login</h3>
                    </div>
                    <div class="panel-body">
                        <form id="form-logar" role="form" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="RA" name="ra" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha" name="password" type="password" autofocus>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                 <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
                                 <p id="mensagem" style="margin-top: 15px"></p>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Bootstrap Core JavaScript -->
    <script src="resources/js/bootstrap.min.js"></script>

</body>

</html>
