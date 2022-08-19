<?php

include("../init.php");
class Banco{

    private $conexao;

    public function __construct()
    {
        try {
            //pt-br criando um new PDO e passando os parâmetros da conexão
            $this->conexao = new PDO("mysql:host=". BD_SERVER .";dbname=" .BD_DATABASE ,  BD_USER, BD_PASSWORD);
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        } 
    }

    public function getConnection(){
        return $this->conexao;
    }
}










?>