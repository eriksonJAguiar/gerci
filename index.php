<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GERCI Login</title>

    <link href="./resources/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    
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
                                <!--<input type="submit" class="btn btn-lg btn-success btn-block" value="Entrar">-->
                                <a href="views/index.php" class="btn btn-lg btn-success btn-block">Entrar</a>
                                <p id="mensagem"></p>
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


</body>

</html>
