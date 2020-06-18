<?php
include_once '../construtores/Usuario.php';
$email = $_POST['email'];
$nome = $_POST['nome'];
$usuario = new Usuario();
$usuario->Cadatro($email, $nome);

