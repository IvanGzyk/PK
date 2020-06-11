<?php
session_start();
include 'Conexao.php';
$conexao = new Conexao;
$con = $conexao->open();

if (isset($_POST['senha'])) {
    $senha = md5($_POST['senha']);
    $email = $_SESSION['email'];
    $query = "UPDATE usuarios set senha = '$senha' where email = '$email'";
    pg_query($con, $query);
    header('Location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Produtividade</title>
        <link href="../../cmanager/web/css/login.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.css" rel="stylesheet">
    </head>
    <body class="login">
        <section class="h-100">
            <div class="container h-100">
                <div class="row" align="center">
                    <div class="card-wrapper">
                        <div class="card fat">
                            <div class="card-body">
                                <h4 class="card-title" align="center">CADASTRE UMA SENHA</h4>
                                <form enctype="multipart/form-data" action="#" method="POST">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Senha</label>
                                        <input type="password" class="form-control" name="senha">
                                        <div class="login btn"><button type="submit" class="btn btn-default">CADASTRAR</button></div>
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