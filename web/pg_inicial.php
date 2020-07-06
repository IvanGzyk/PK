<?php
include_once '../construtores/Grafico.php';
include_once '../construtores/Usuario.php';
include_once '../config/Conexao.php';
$usuario = new Usuario();
$grafico = new Grafico();
$conexao = new Conexao();
$mult = 1;
if ($_SESSION['tipo_acesso'] == 'admin') {
    $con = $conexao->open();
    $query = "SELECT COUNT(operador) total FROM usuarios WHERE tipo <> 'admin'";
    $result = pg_query($con, $query);
    $qtd = 1;
    while ($row = pg_fetch_row($result)) {
        $qtd = $row[0];
    }
    if (isset($_SESSION['operador_pi'])) {
        $operador_ = $_SESSION['operador_pi'];
        if ($operador_ == "%%") {
            $operador_ = "Todos";
            $mult = $qtd;
        }
        $ope = $_SESSION['operador_pi'];
    } else {
        $operador_ = "";
        $ope = '%%';
        $mult = $qtd;
    }
    $con = $conexao->close();
} else {
    $ope = $_SESSION['operador'];
}
$dados = $usuario->DadosProjecao($ope, $mult);
@$projecao = $dados['projecao'];
@$data = $dados['data'];
@$meta = $dados['meta'];
$projecao = json_encode($projecao);
$data = json_encode($data);
$meta = json_encode($meta);
$id = 'Chart';
$titulo = 'Projeção';
$titulo1 = 'Meta';
?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <form action="#" class="form-inline" method="POST">
                <?php
                if ($_SESSION['tipo_acesso'] == 'admin') {
                    ?>
                    <div class="form-group mb-2">
                        <label>Operador:</label>
                        <select class="form-control form-control-lg" name="operador_pi" onchange="this.form.submit()">
                            <option value=""><?= $operador_ ?></option>
                            <?= $options ?>
                        </select>
                    </div>
                    <?php
                }
                ?>
            </form>
        </div>
        <div class="container-fluid">
            <div class="row p-3">
                <div class="col-lg-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-line mr-1"></i>Média X Processsados                              
                        </div>

                        <?= $grafico->grafico_linha($data, $titulo, $titulo1, $projecao, $meta, $id) ?>
                    </div>
                </div>
            </div>
            <?= $usuario->RelatoriioInicial($ope, $mult); ?>
        </div>
    </main>
</div>