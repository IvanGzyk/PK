<?php
include '../construtores/Usuario.php';
include_once '../construtores/Grafico.php';
include_once 'DadosGrafico.php';

//session_start();
if (isset($_SESSION['periodo'])) {
    $periodo = $_SESSION['periodo'];
    switch ($periodo) {
        case 15:
            $periodo = "15 dias";
            break;
        case 30:
            $periodo = "Um mês";
            break;
        case 90:
            $periodo = "Três Mêses";
            break;
        case 180:
            $periodo = "Seis mêses";
            break;
        case 360:
            $periodo = "Um ano";
            break;
    }
} else {
    $periodo = "";
}
if (isset($_SESSION['tipo'])) {
    $tipo = $_SESSION['tipo'];
} else {
    $tipo = "";
}
if (isset($_SESSION['contrato'])) {
    $contrato = $_SESSION['contrato'];
} else {
    $contrato = "";
}

$usuario = new Usuario();
$grafico = new Grafico();
$contratos = $usuario->BuscaContrato();
//print_r($contratos);
$option = "";
foreach ($contratos as $value) {
    $option .= '<option value="' . $value . '">' . $value . '</option>';
}
?>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8" />
    </head>
    <body>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <form action="#" class="form-inline" method="POST">
                        <div class="form-group mb-2">
                            <label>Periodo:</label>
                            <select class="form-control form-control-lg" name="periodo" onchange="this.form.submit()">
                                <option value=""><?= $periodo ?></option>
                                <option value="15">15 dias</option>
                                <option value="30">Um mês</option>
                                <option value="90">Três mêses</option>
                                <option value="180">Seis mêses</option>
                                <option value="360">Um ano</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Tipo:</label>
                            <select class="form-control form-control-lg" name="tipo" onchange="this.form.submit()">
                                <option value=""><?= $tipo ?></option>
                                <option value="triagem">Triagem</option>
                                <option value="processamento">Processamento</option>
                                <option value="validacao">Validacao</option>
                            </select>
                        </div>
                        <div class="form-group mb-2">
                            <label>Contrato:</label>
                            <select class="form-control form-control-lg" name="contrato" onchange="this.form.submit()">
                                <option value=""><?= $contrato ?></option>
                                <?= $option ?>
                            </select>
                        </div>
                    </form>
                    <div class="row p-3">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie mr-1"></i>Média X Processsados                              
                                </div>
                                <?php $grafico->grafico_pizza($valores, $valores, $medias_operador, 'Charts_g', $cores); ?>  
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar mr-1"></i><?= $tipo ?> <button type="button" class="btn btn-info btn-sm float-right" data-toggle="modal" data-target="#relatorio">EXTRATO DETALHADO</button>
                                </div>
                                <?php $grafico->carrega_grafico_barras2($data, 'Processado', 'Média', $processamento, $medias, "'#98FB98'", "'#FF6347'", $id) ?>
                            </div>
                        </div>

                    </div>
                    <div class="row p-3">
                        <div class="modal fade" id="relatorio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title" id="myModalLabel">Relatório detalhado</h6>
                                    </div>
                                    <div class="modal-body">
                                        <small><?= $usuario->Relatorio(); ?></small>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">Fechar Relatório</button>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>             
            </main>
        </div>        
    </body>
</html>
