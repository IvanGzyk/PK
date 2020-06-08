<?php
session_start();
if(isset($_POST['periodo']) && $_POST['periodo'] != null){
    $_SESSION['periodo'] = $_POST['periodo'];
}
if(isset($_POST['tipo']) && $_POST['tipo'] != null){
    $_SESSION['tipo'] = $_POST['tipo'];
}
if(isset($_POST['contrato']) && $_POST['contrato'] != null){
    $_SESSION['contrato'] = $_POST['contrato'];
}
include_once 'menu/Menu.php';
$menu = new Menu();
?>
<html lang="pt-BR">
    <head>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
        <link href="../css/styles.css" rel="stylesheet" />
        <link href="../css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="../css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="../js/funcoes.js" type="text/javascript"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="../js/all.min.js"></script>
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <meta charset="utf-8">
        <title>Produtividade</title>
    </head>
    <body>
        <div class="top">
            <main>
<?= $menu->carregaMenu(); ?>
            </main>
        </div>
        <div class="col-10 center-block" id="principal">
        </div>
    </body>
    <?php
    if (isset($_POST['periodo'])) {
        $link = "'usuario.php'";
        ?>
        <script type="text/javascript">
            Conteudo(<?= $link ?>);
        </script>
        <?php
    }
    if (isset($_POST['tipo'])) {
        $link = "'usuario.php'";
        ?>
        <script type="text/javascript">
            Conteudo(<?= $link ?>);
        </script>
        <?php
    }
    ?>