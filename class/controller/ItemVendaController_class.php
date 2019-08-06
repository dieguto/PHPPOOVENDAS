<?php

class ItemVendaController{

    function __construct(){
        require_once("class/model/ItemVenda_class.php");
        require_once("class/model/dao/ItemVendaDAO_class.php");


    }

    private function calcularTotal($qtde, $valorUni){
        return $qtde * $valorUni;
    }

    public function inserir(){

        $itemVenda = new ItemVenda();
        $itemVenda->setCod_item_venda(0);
        $itemVenda->setQuantidade($_POST['qtde']);
        $json = $_POST['produto'];
        $quantidade = $_POST['qtde'];
        $obj = json_decode($json,true);

        $val_unitario = $obj['valor_uni'];

       

        $itemVenda->setValor_total(
            $this->calcularTotal($quantidade, $val_unitario));

        $itemVenda->setCod_produto($obj['cod']);


        $itemDAO = new ItemVendaDAO();
        if($itemDAO->inserir($itemVenda)){
            return "Inserido com sucesso!";
        }else{
            return "Problemas ao inserir!";
        }
    
    }

    public function editar(){
        $itemVenda = new ItemVenda();
        $itemVenda->setCod_item_venda($_POST['cod_item_venda']);
        $json = $_POST['produto'];
        $quantidade = $_POST['qtde'];
        $obj = json_decode($json,true);

        $val_unitario = $obj['valor_uni'];

       

        $itemVenda->setValor_total(
            $this->calcularTotal($quantidade, $val_unitario));

        $itemVenda->setCod_produto($obj['cod']);
        $itemVenda->setQuantidade($quantidade);
        

        $itemVendaDAO = new ItemVendaDAO();

        if($itemVendaDAO->editar($itemVenda)){
            return "Editado com sucesso!";
        }else{
            return "Erro ao editar";
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