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

        <link href="css/bootstrap.css" rel="stylesheet">
    </head>
    <body class="login">
        <section class="h-100">
            <div id="layoutSidenav_content">
                <main>
                    <div class="container h-100">
                        <div class="row justify-content-md-center h-100 col-lg-6">
                            <h1 class="mt-3">Produtividade</h1>
                            <div class="card-wrapper">
                                <div class=card fat">
                                     <div class="card-body col-lg-6">
                                        <h4 class="card-title" align="center">ACESSE SUA CONTA</h4>
                                        <form action="config/login.php" method="POST">
                                            <div class="form-group col-lg-12">
                                                <label for="exampleInputEmail1">Login:</label>
                                                <input type="text" class="form-control" name="login">
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label for="exampleInputPassword1">Senha</label>
                                                <input type="password" class="form-control" name="senha">
                                            </div>
                                            <div class="bottom-left col-lg-2"><button type="submit" class="btn btn-default">Enviar</button></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </section>
    </body>
</html>