<?php
include_once '../construtores/Usuario.php';
$usuario = new Usuario();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div id="layoutSidenav_content">
    <div class="container-fluid">
        <h1 class="mt-3">Gerenciar Operadores</h1>
        <div class="card mb-2"></div>
        <?= $usuario->RelatórioUsuarios() ?>
    </div>
</div> 


