<?php

class ItemVenda{

    public $cod_item_venda;
    public $cod_produto;
    public $quantidade;
    public $valor_total;

    public function getCod_item_venda() {
        return $this->cod_item_venda;
    }
    public function setCod_item_venda($cod_item_venda) {
        $this->cod_item_venda = $cod_item_venda;
    }


    public function getCod_produto() {
    	return $this->cod_produto;
    }
    public function setCod_produto($cod_produto) {
    	$this->cod_produto = $cod_produto;
    }


    public function getQuantidade() {
    	return $this->quantidade;
    }
    public function setQuantidade($quantidade) {
    	$this->quantidade = $quantidade;
    }


    public function getValor_total() {
    	return $this->valor_total;
    }
    public function setValor_total($valor_total) {
    	$this->valor_total = $valor_total;
    }



}
