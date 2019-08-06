<?php

require_once("BaseDAO_class.php");

class ItemVendaDAO extends BaseDAO{

    public function inserir(ItemVenda $itemVenda){

        $sql = " INSERT INTO item_venda VALUES 
            (:cod_item_venda, :cod_produto, 
            :quantidade, :valor_total) ";

        $smtp = $this->conexao->prepare($sql);

        $dados = [
            'cod_item_venda' => $itemVenda->getCod_item_venda(),
            'cod_produto' => $itemVenda->getCod_produto(),
            'quantidade' => $itemVenda->getQuantidade(),
            'valor_total' => $itemVenda->getValor_total()
        ];

//        $smtp->execute($dados);

        //executa utilizando o objeto como array
        //$smtp->execute((array)$itemVenda);

        
        return $smtp->execute($dados);
        
        
    }
    
    public function excluir($codItemVenda){
        
        $sql = "DELETE FROM item_venda WHERE cod_item_venda = ?";
        
        $smtp = $this->conexao->prepare($sql);
        
        $smtp->bindParam(1,$codItemVenda);
        
        if($smtp->execute()){
             return true;
        }else{
            // die - mata a execução do código
            die("Erro ao deletar");
            return false;
        }
            
        
        
    }
    
    public function editar($itemVenda){
        $sql = " UPDATE item_venda 
                SET cod_produto =?,
                quantidade =  ?,
                valor_total = ?
                WHERE cod_item_venda = ?";
        
        $smtp = $this->conexao->prepare($sql);
        $smtp->bindParam(1, $itemVenda->getCod_produto());
        $smtp->bindParam(2, $itemVenda->getQuantidade());
        $smtp->bindParam(3, $itemVenda->getValor_total());
        $smtp->bindParam(4, $itemVenda->getCod_item_venda());
    
        return $smtp->execute();
    }

    public function buscarPorId($codItem){
        $sql = " SELECT * FROM item_venda
            WHERE cod_item_venda = ? ";

        $smtp = $this->conexao->prepare($sql);
        $smtp-> bindParam(1,$codItem);

        $smtp-> setFetchMode(PDO::FETCH_CLASS, "ItemVenda");

        $smtp-> execute();

    

        // retornar uma class do tipo itemVenda, ao invés do fetchAll que traria uma list, como sabemos que só ira trazer um, damos um fetch
        $item = $smtp->fetch();

        $arr = array('codItemVenda' => $item->getCod_item_venda(),
                'codProduto' => $item->getCod_produto(),
                'quantidade' => $item->getQuantidade(),
                'valorTotal' => $item->getValor_total());


        return $arr;
    }

    public function listarTodos(){
        
        $sql = " SELECT * FROM item_venda i
               INNER JOIN produtos p 
               ON i.cod_produto = p.cod_produto";

        $rs = $this->conexao->query($sql);

        $rs->setFetchMode(PDO::FETCH_CLASS, "ItemVenda");
        $rs->execute();

        $obj = $rs->fetchAll();

        return $obj;

    }

}


?>