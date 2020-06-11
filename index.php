<?php
/*
  include 'config/Conexao.php';
  $conexao = new Conexao;
  $con = $conexao->open();
 */
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Produtividade</title>
        <link href="css/login.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body class="login">
        <section class="h-100">
            <div class="container h-100">
                <div class="row" align="center">
                    <div class="card-wrapper">
                        <div class="card fat">
                            <div class="card-body">
                                <h4 class="card-title" align="center">ACESSE SUA CONTA</h4>
                                <form id="login" enctype="multipart/form-data" action="config/login.php" method="POST">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Login:</label>
                                        <input type="text" class="form-control" name="login">
                                        <div class="login btn"><button type="submit" class="btn btn-default">Próximo</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</html>