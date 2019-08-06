<?php

class ProdutoController{

    function __construct(){
        require_once("class/model/dao/ProdutoDAO_class.php");
        require_once("class/model/Produto_class.php");
    }

    public function listar(){
        $produtoDAO = new ProdutoDAO();
        return $produtoDAO->listarTodos();
    }

}

?>