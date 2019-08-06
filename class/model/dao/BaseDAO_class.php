<?php

abstract class BaseDAO{

    protected $conexao;

    //contrutor faz o require da classe ConexaoBD
    // e já faz a conexão com o banco de dados
    public function __construct(){
        require_once('ConexaoBD_class.php');

        $conexaoBD = new ConexaoBD();

        $this->conexao = $conexaoBD->conectar();
    }

    //método abstrato, deve ser implementado nas classes filhas
    abstract function listarTodos();

}


?>