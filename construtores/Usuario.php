<?php

/**
 * Description of Usuario
 *
 * @author ivan.g
 */
include_once '../config/Conexao.php';
$conexao = new Conexao();
$con = $conexao->open();

class Usuario {

    function Relatorio() {
        session_start();
        if (isset($_SESSION['periodo'])) {
            $periodo = $_SESSION['periodo'];
        } else {
            $periodo = 0;
        }
        if (isset($_SESSION['tipo'])) {
            $tipo = $_SESSION['tipo'];
        } else {
            $tipo = "processamento";
        }
        if (isset($_SESSION['contrato'])) {
            $contrato = $_SESSION['contrato'];
        } else {
            $contrato = "";
        }
        //include '../config/Conexao.php';
        $conexao = new Conexao;
        $con = $conexao->open();
        $operador = "";
        $processamento = "";
        $data = "";
        $media = "";
        $tabela = '<table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Nome</th>
                            <th scope="col">' . $tipo . '</th>
                            <th scope="col">Data</th>
                            <th scope="col">Media Geral</th>
                        </tr>
                    </thead>
                    <tbody>';
        if ($tipouser == 'admin') {//executa query para todos os operadores...
            //Query para pegar a média geral.
            $query = "select trunc(avg($tipo),2) media from produtividade
                    where
                    cast ((dia ||'/'|| mes ||'/' || ano) as date) BETWEEN CURRENT_DATE - INTERVAL '$periodo DAY' AND CURRENT_DATE OR cast ((dia ||'/'|| mes ||'/' || ano) as date) = CURRENT_DATE
                    and 
                    $tipo > 0
                    and
                    contrato like '%$contrato%'";

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
                    contrato like '%$contrato%'
                    order by date
                    )t
                    where
                    date BETWEEN CURRENT_DATE - INTERVAL '$periodo DAY' AND CURRENT_DATE OR date = CURRENT_DATE";

            $result = pg_query($con, $query);
            while ($row = pg_fetch_row($result)) {
                $operador = $row[0];
                $processamento = $row[1];
                $data = $row[2];
                $tabela .= '<tr>'
                        . '<td>' . $operador . '</td>'
                        . '<td>' . $processamento . '</td>'
                        . '<td>' . $data . '</td>'
                        . '<td>' . $media . '</td>'
                        . '</tr>';
                //echo "Nome: $operador<br> Processamento: $processamento<br>  Data: $data<br>  Media Geral: $media<br><br><br>";
            }
        } else {//executa query apenas com valores para o operador logado....
            //Query para pegar a média geral.
            $query = "select trunc(avg($tipo),2) media from produtividade
                    where
                    cast ((dia ||'/'|| mes ||'/' || ano) as date) BETWEEN CURRENT_DATE - INTERVAL '$periodo DAY' AND CURRENT_DATE OR cast ((dia ||'/'|| mes ||'/' || ano) as date) = CURRENT_DATE
                    and 
                    $tipo > 0
                    and
                    contrato like '%$contrato%'";

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
                    contrato like '%$contrato%'
                    and 
                    operador = 'Lylian'
                    order by date
                    )t
                    where
                    date BETWEEN CURRENT_DATE - INTERVAL '$periodo DAY' AND CURRENT_DATE OR date = CURRENT_DATE";

            $result = pg_query($con, $query);
            while ($row = pg_fetch_row($result)) {
                $operador = $row[0];
                $processamento = $row[1];
                $data = $row[2];
                $tabela .= '<tr>'
                        . '<td>' . $operador . '</td>'
                        . '<td>' . $processamento . '</td>'
                        . '<td>' . $data . '</td>'
                        . '<td>' . $media . '</td>'
                        . '</tr>';
                //echo "Nome: $operador<br> Processamento: $processamento<br>  Data: $data<br>  Media Geral: $media<br><br><br>";
            }
        }
        $tabela .= '
                    </tbody>
                </table>';
        $conexao->close();
        return $tabela;
    }

    function BuscaContrato() {

        //include '../config/Conexao.php';
        $conexao = new Conexao;
        $con = $conexao->open();

        $contratos = array();
        $query = "select contrato from produtividade group by contrato";
        $result = pg_query($con, $query);
        while ($row = pg_fetch_row($result)) {
            $contratos[] = $row[0];
        }
        $conexao->close();
        return $contratos;
    }

}

?>
    