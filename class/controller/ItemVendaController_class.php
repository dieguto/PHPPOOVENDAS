<?php

class ItemVendaController{

    function __construct(){
        require_once("class/model/ItemVenda_class.php");
        require_once("class/model/dao/ItemVendaDAO_class.php");


    }

    public function inserir(){

        $itemVenda = new ItemVenda();
        $itemVenda->setCod_item_venda(0);
        $itemVenda->setCod_produto($_POST['produto']);
        $itemVenda->setQuantidade($_POST['qtde']);
        $itemVenda->setValor_total($_POST['valor_uni'] * 
            $itemVenda->getQuantidade());


        $json = $_POST['produto'];

        $obj = json_decode($json,true);

        $val_unitario = $obj['valor_uni'];

        $itemVenda->setValor_total($val_unitario *
            $itemVenda->getQuantidade());

        $itemVenda->setCod_produto($obj['cod']);

        $itemDAO = new ItemVendaDAO();
        if($itemDAO->inserir($itemVenda)){
            return "Inserido com sucesso!";
        }else{
            return "Problemas ao inserir!";
        }
    
    }

    public function buscarPorId(){
        $codItem = $_POST['cod'];
        $itemVendaDAO = new ItemVendaDAO();

        return $itemVendaDAO->buscarPorId($codItem);
    }
    
    

    
    public function listar(){
        $itemVendaDAO = new ItemVendaDAO();
        return $itemVendaDAO->listarTodos();
    }
    
    // método para exclusão
    public function excluir(){
        $codItem = $_GET['codItem'];
        $itemVendaDAO = new ItemVendaDAO();
        
        if($itemVendaDAO->excluir($codItem)){
            return "Excluido com sucesso!";
        }else{
            return "Problemas ao excluir!";
        };
    }

}

?>