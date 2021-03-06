<?php

session_start();
if (isset($_SESSION['periodo'])) {
    $periodo = $_SESSION['periodo'];
} else {
    $periodo = 30;
}
if (isset($_SESSION['tipo'])) {
    $tipo = $_SESSION['tipo'];
} else {
    $tipo = "processamento";
}
if (isset($_SESSION['contrato'])) {
    $contrato = $_SESSION['contrato'];
} else {
    $contrato = "%%";
}
if (isset($_SESSION['operador_'])) {
    $usuario = $_SESSION['operador_'];
} else {
    $usuario = $_SESSION['operador'];
}

include_once '../config/Conexao.php';
$conexao = new Conexao;
$con = $conexao->open();

$tipouser = $_SESSION['tipo_acesso'];
$media = "";
$medias = array();
$medias_operador = array();
$operador = array();
$processamento = array();
$data = array();
$data_operador = array();
$cores = array('#98FB98','#0000FF');
$valores = array('Media','Média operador');
$id = "Chart";

if ($tipouser == 'admin') {//executa query para todos os operadores...
//Query para pegar a média geral.
    $query = "select trunc(avg($tipo),2) media from produtividade
        where
        cast ((dia ||'/'|| mes ||'/' || ano) as date) BETWEEN CURRENT_DATE - INTERVAL '$periodo DAY' AND CURRENT_DATE OR cast ((dia ||'/'|| mes ||'/' || ano) as date) = CURRENT_DATE
        and 
        $tipo > 0
        and
        contrato Like '$contrato'";
    $result = pg_query($con, $query);

    while ($row = pg_fetch_row($result)) {
        $media = $row[0];
    }

//query para pegar a produtividade por operador.
    $query = "select t.* From(
        select operador, $tipo, cast ((dia ||'/'|| mes ||'/' || ano) as date) from produtividade
        where
        $tipo > 0
        and
        contrato like '$contrato'
        order by date
        )t
        where
        date BETWEEN CURRENT_DATE - INTERVAL '$periodo DAY' AND CURRENT_DATE OR date = CURRENT_DATE
        order by date desc";

    $result = pg_query($con, $query);
    while ($row = pg_fetch_row($result)) {
        $operador[] = $row[0];
        $processamento[] = $row[1];
        $data[] = $row[2] . ' - ' . $row[0];
        $medias[] = $media;
    }
    $query = "select $tipo, cast((dia ||'/'|| mes ||'/' || ano) as date) from produtividade 
            where 
            operador = '$usuario' 
            and cast((dia ||'/'|| mes ||'/' || ano) as date) BETWEEN CURRENT_DATE - INTERVAL '$periodo DAY' 
            AND CURRENT_DATE and $tipo > 0
            and 
            contrato Like '$contrato'
            order by date desc";
    $result = pg_query($con, $query);
    while ($row = pg_fetch_row($result)) {
        $medias_operador[] = $row[0];
        $data_operador[] = $row[1];
    }
} else {
    //Query para pegar a média geral.
    $query = "select trunc(avg($tipo),2) media from produtividade
        where
        cast ((dia ||'/'|| mes ||'/' || ano) as date) BETWEEN CURRENT_DATE - INTERVAL '$periodo DAY' AND CURRENT_DATE OR cast ((dia ||'/'|| mes ||'/' || ano) as date) = CURRENT_DATE
        and 
        $tipo > 0
        and
        contrato like '$contrato'";
    $result = pg_query($con, $query);

    while ($row = pg_fetch_row($result)) {
        $media = $row[0];
    }

//query para pegar a produtividade por operador.
    $query = "select t.* From(
        select operador, $tipo, cast ((dia ||'/'|| mes ||'/' || ano) as date) from produtividade
        where
        $tipo > 0
        and
        contrato like '$contrato'
        and 
        operador = '$usuario'
        order by date
        )t
        where
        date BETWEEN CURRENT_DATE - INTERVAL '$periodo DAY' AND CURRENT_DATE OR date = CURRENT_DATE";

    $result = pg_query($con, $query);
    while ($row = pg_fetch_row($result)) {
        $operador[] = $row[0];
        $processamento[] = $row[1];
        $data[] = $row[2] . ' - ' . $row[0];
        $medias[] = $media;
    }
    
    $query = "select $tipo, cast((dia ||'/'|| mes ||'/' || ano) as date) from produtividade 
            where 
            operador = '$usuario' 
            and cast((dia ||'/'|| mes ||'/' || ano) as date) BETWEEN CURRENT_DATE - INTERVAL '$periodo DAY' 
            AND CURRENT_DATE and $tipo > 0
            and 
            contrato Like '$contrato'
            order by date desc";
            
    $result = pg_query($con, $query);
    while ($row = pg_fetch_row($result)) {
        $medias_operador[] = $row[0];
        $data_operador[] = $row[1];
    }
}
$operador = json_encode($operador);
$processamento = json_encode($processamento);
$data = json_encode($data);
$medias = json_encode($medias);
$medias_operador = json_encode($medias_operador);
$data_operador = json_encode($data_operador);
$valores = json_encode($valores);
$cores = json_encode($cores);
$conexao->close();

