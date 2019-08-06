<?php

    $controller = $_GET['controller'];
    $modo = $_GET['modo'];

    switch($controller){
        // identifica qual é o controller
        case 'item_venda':
            require_once("class/controller/ItemVendaController_class.php");

            $ctrl = new ItemVendaController();
            switch($modo){
                case "inserir":
                    $mensagem = $ctrl->inserir();
                    break;
                case "excluir":
                    $mensagem = $ctrl->excluir();
                    break;
                case "editar":
                    $mensagem = $ctrl->editar();
                    break;
                case "buscar":
                    //implementar editar aqui
                    $item = $ctrl->buscarPorId();
                    echo json_encode($item);
                    break;
                    
            }
            if($modo != "buscar"){
                header("Location: index.php?mensagem=".$mensagem);
            }
            
            break;
    }

?>