<?php

class ConexaoBD{

    private $dns;
    private $user;
    private $pass;
    private $conexao;

    function __construct(){
        $this->dns = "mysql:host=localhost;
            dbname=vendas_phppoo";
        $this->user = "root";
        $this->pass = "bcd127";
    }

    public function conectar(){
        try{
            $this->conexao = new PDO($this->dns,
                $this->user,$this->pass);
            return $this->conexao;
        }catch(PDOException $e){
            echo "Erro na conexão.... <br>
                Linha: " . $e->getLine() .
                " Mensagem de erro: " .
                $e->getMessage();
        }
    }

    public function desconectar(){
        $this->conexao = null;
    }

}

?>