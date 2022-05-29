<?php
  class Venda {

    private $idVenda;
    private $dataDAVenda;
    private $nomeDOVendedor;
    private $cliente;  

    public function __construct(){}

    public function __destruct(){}

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    public function __toString(){
      return nl2br("Identificação da Venda: $this->idVenda
                    Data da Venda: $this->dataDAVenda
                    Nome do Vendedor: $this->nomeDOVendedor
                    Cliente: $this->cliente");
    }
  }
