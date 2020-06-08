<?php
include '../config/Conexao.php';
$conexao = new Conexao;
$con = $conexao->open();


header('Location:../web/index.php');