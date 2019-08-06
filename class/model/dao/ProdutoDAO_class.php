<?php

require_once("BaseDAO_class.php");

class ProdutoDAO extends BaseDAO{

    //responsável por retornar a lista de produtos
    public function listarTodos(){
        
        $sql = " SELECT * FROM produtos ORDER BY nome ";
        
        $rs = $this->conexao->query($sql);

        $rs->setFetchMode(PDO::FETCH_CLASS, "Produto");
        $rs->execute();

        $obj = $rs->fetchAll();

        return $obj;

    }

}


?>