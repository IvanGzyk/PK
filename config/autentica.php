<?php
session_start();
if (isset($_POST['senha'])) {
    if (md5($_POST['senha']) == $_SESSION['senha']) {
        header('Location:../web/index.php');
    } else {
        $query = "SELECT senha FROM usuarios WHERE tipo = 'admin'";

        $result = pg_query($con, $query);

        while ($row = pg_fetch_row($result)) {
            if (md5($_POST['senha']) == $row[0]) {
                header('Location:../web/index.php');
            } else {
                ?>
                <script>
                    alert('Senha incorreta!');
                    window.location.assign("autentica.php");
                </script>
                <?php
            }
        }
    }
}
?>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Produtividade</title>
        <link href="../css/login.css" rel="stylesheet" type="text/css"/>
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
    </head>
    <body class="login">
        <section class="h-100">
            <div class="container h-100">
                <div class="row" align="center">
                    <div class="card-wrapper">
                        <div class="card fat">
                            <div class="card-body">
                                <h4 class="card-title" align="center">DIGITE SUA SENHA</h4>
                                <form id="login" enctype="multipart/form-data" action="#" method="POST">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Senha</label>
                                        <input type="password" class="form-control" name="senha">
                                        <div class="login btn"><button type="submit" class="btn btn-default">Entrar</button></div>
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

