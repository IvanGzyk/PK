<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Menu
 *
 * @author ivan.g
 */
//session_start();
class Menu {

    function carregaMenu() {
        $operador = $_SESSION['operador'];
        $link = "'usuario.php'";
        $link_1 = "'formCadastro.php'";
        $link_2 = "'operadores.php'";
        $menu = '<nav class = "navbar-expand-lg py-2  navbar-light" style="background-color:#073954;">
                    <a href = "index.php" class = "navbar-brand">
                        <img src = "img/header-logo.png" width = "130" class = "d-inline-block align-middle mr-2">
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                        <ul class = "navbar-nav ml-auto">
                            <li class = "nav-item active">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item">
                                        <a class=nav-link href="index.php">Página Inicial</a>
                                    </li>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' . $operador . '</a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <a class="dropdown-item" href="#" onclick="Conteudo(' . $link . ')">Relatório</a>';
        if ($_SESSION['tipo_acesso'] == 'admin') {
            $menu .= '<a class="dropdown-item" href="#" onclick="Conteudo(' . $link_1 . ')">Cadastrar</a>'
                    . '<a class="dropdown-item" href="#" onclick="Conteudo(' . $link_2 . ')">Operadores</a>';
        }
        $menu .= '
                                            <a class="dropdown-item" href="script/encerrar_sessao.php">Sair</a>
                                        </div>
                                    </li></ul>
                            </li>
                        </ul>
                    </div>
                </nav>';
        return $menu;
    }

}

?>
