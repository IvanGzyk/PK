<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Conexao
 *
 * @author ivan.g
 */

Class Conexao {

    function __construct() {
        
    }

    function open() {
        $this->con = pg_connect('host= 191.32.31.101 port= 5450  user = central password = central dbname = central-reports');
        return $this->con;
    }

    function close() {
        @pg_close($this->con);
    }

    function statusCon() {
        if (!$this->con) {
            echo '<h3>O sistema não está conectado à [$this->dbname] em [$this->host].</h3>';
            exit;
        } else {
            echo '<h3>O sistema está conectado à [$this->dbname] em [$this->host].</h3>';
        }
    }

}
