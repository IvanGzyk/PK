<?php

include_once '../config/Conexao.php';
$conexao = new Conexao;
$con = $conexao->open();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$email = $_GET['email'];

$query = "UPDATE usuarios set senha = '(NULL)' WHERE email = '$email'";
pg_query($con, $query);
echo '  <script>
            alert("A senha do usuario '.$email.' foi resetada!");
            Conteudo("../web/operadores.php");
        </script>';
