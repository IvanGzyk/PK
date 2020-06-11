<?php
include '../config/Conexao.php';
$conexao = new Conexao;
$con = $conexao->open();
session_start();
$login = $_POST['login'];
$query = "SELECT operador, senha, tipo FROM usuarios WHERE email = '$login'";

$result = pg_query($con, $query);

while ($row = pg_fetch_row($result)){
    if($row[1] == null){
        $_SESSION['email'] = $login;
        header('Location:cadastro.php');
    }else{
        $_SESSION['operador'] = $row[0];
        $_SESSION['senha'] = $row[1];
        $_SESSION['tipo_acesso'] = $row[2];
        header('Location:autentica.php');
    }
}