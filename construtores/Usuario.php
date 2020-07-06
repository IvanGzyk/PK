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
        //session_start();
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
        //include '../config/Conexao.php';
        $conexao = new Conexao;
        $con = $conexao->open();
        $operador = "";
        $processamento = "";
        $data = "";
        $media = "";
        $tipouser = $_SESSION['tipo_acesso'];
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
                    operador = 'Lylian'
                    order by date
                    )t
                    where
                    date BETWEEN CURRENT_DATE - INTERVAL '$periodo DAY' AND CURRENT_DATE OR date = CURRENT_DATE
                    order by date desc";

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

    function RelatórioUsuarios() {
        $conexao = new Conexao;
        $con = $conexao->open();
        $tabela = '<table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col">Operador</th>
                        </tr>
                    </thead>
                    <tbody>';

        $query = "SELECT email, operador FROM usuarios";

        $result = pg_query($con, $query);
        while ($row = pg_fetch_row($result)) {
            $link = "'../web/update.php?email=" . $row[0] . "'";
            $link1 = "'../web/delete.php?email=" . $row[0] . "'";
            $tabela .= '<tr>'
                    . '<td>' . $row[0] . '</td>'
                    . '<td>' . $row[1] . '</td>'
                    . '<td><input type="button" value="Ressetar" class="btn btn-info btn-sm" onclick="Conteudo(' . $link . ')">  '
                    . '<input type="button" value="Deletar" class="btn btn-danger btn-sm" onclick="Conteudo(' . $link1 . ')"></td>'
                    . '</tr>';
        }
        $tabela .= '
                    </tbody>
                </table>';
        $conexao->close();
        return $tabela;
    }

    function RelatoriioInicial($ope, $mult) {
        $conexao = new Conexao;
        $con = $conexao->open();
        $mes = date('m');
        $ano = date('Y');
        $ultimoDia = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
        $ultimoDia = date('Y-m-' . $ultimoDia);
        $primeiroDia = date('Y-m-01');
        $diaAtual = date('Y-m-d');
        $qtdaDias = getWorkingDays($primeiroDia, $ultimoDia);
        $diasUties = DiasUteis($primeiroDia, $diaAtual);
        $tabela = '<table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">DATA</th>
                                <th scope="col">PRODUÇÃO DIA</th>
                                <th scope="col">ACOMULADO</th>
                                <th scope="col">PROJEÇÃO INDIVIDUAL</th>
                                <th scope="col">ESPERADO</th>
                                </tr>';

        $acumulado = 0;
        foreach ($diasUties as $value) {

            $td_VL = "";
            $td_pd = "";
            $td_ac = "";
            $td_PI = "";
            $td_ES = "";

            $query = "SELECT dia, sum(triagem + processamento + validacao) sum FROM produtividade
                    WHERE operador LIKE '$ope'
                    AND 
                    cast ((dia ||'/'|| mes ||'/' || ano) as DATE) = '$value'
                    GROUP BY dia
                    ORDER BY dia";
            $result = pg_query($con, $query);
            $meta = 28000 * $mult;
            while ($row = pg_fetch_row($result)) {
                $dia = date('Y-m-' . $row[0]);
                $qtdaDia = getWorkingDays($primeiroDia, $dia);
                    $pdia = $row[1];
                $acumulado = $pdia + $acumulado;
                $projeção = ($acumulado / $qtdaDia) * $qtdaDias;
                $projeção = number_format($projeção, 0, '', '');
                
                $td_VL .= "<td>$value</td>";
                $td_pd .= "<td>$pdia</td>";
                $td_ac .= "<td>$acumulado</td>";
                $td_PI .= "<td>$projeção</td>";
                $td_ES .= "<td>$meta</td></tr>";
            }

            $tabela .= '<tr>'
                    . $td_VL
                    . $td_pd
                    . $td_ac
                    . $td_PI
                    . $td_ES;
        }
        $tabela .= '
                    </tbody>
                </table>';
        $conexao->close();
        return $tabela;
    }

    function BuscaContrato() {

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

    function BuscaOperadores() {

        $conexao = new Conexao;
        $con = $conexao->open();

        $operadores = array();
        $query = "select operador from produtividade group by operador";
        $result = pg_query($con, $query);
        while ($row = pg_fetch_row($result)) {
            $operadores[] = $row[0];
        }
        $conexao->close();
        return $operadores;
    }

    function Cadatro($email, $nome) {
        $conexao = new Conexao;
        $con = $conexao->open();
        $query = "INSERT INTO usuarios(email, operador) VALUES('$email', '$nome')";
        if (pg_query($con, $query)) {
            echo '  <script>
                        alert("O cadastro realizado com sucesso!");
                        window.location.href = "../web/index.php";
                    </script>';
        }
    }
    
    function DadosProjecao($ope, $mult){        
        $conexao = new Conexao;
        $con = $conexao->open();
        $mes = date('m');
        $ano = date('Y');
        $ultimoDia = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
        $ultimoDia = date('Y-m-' . $ultimoDia);
        $primeiroDia = date('Y-m-01');
        $diaAtual = date('Y-m-d');
        $qtdaDias = getWorkingDays($primeiroDia, $ultimoDia);
        $diasUties = DiasUteis($primeiroDia, $diaAtual);
        $acumulado = 0;
        $dados = array();
        foreach ($diasUties as $value) {
            $query = "SELECT dia, sum(triagem + processamento + validacao) sum FROM produtividade
                    WHERE operador LIKE '$ope'
                    AND 
                    cast ((dia ||'/'|| mes ||'/' || ano) as DATE) = '$value'
                    GROUP BY dia
                    ORDER BY dia";
            $result = pg_query($con, $query);
            while ($row = pg_fetch_row($result)) {
                $dia = date('Y-m-' . $row[0]);
                $qtdaDia = getWorkingDays($primeiroDia, $dia);
                    $pdia = $row[1];
                $acumulado = $pdia + $acumulado;
                $projeção = ($acumulado / $qtdaDia) * $qtdaDias;
                $projeção = number_format($projeção, 0, '', '');
                $dados['projecao'][] = $projeção;
                $dados['data'][] = $value;
                $dados['meta'][] = 28000 * $mult;
            }
        }
        $conexao->close();
        return $dados;
    }

}
?>
    