<?php
  class Cliente {

    private $idCliente;
    private $nomeCompleto;
    private $email;
    private $login;
    private $senha;
    private $img;
    private $data;
    private $imgTemp;

    public function __construct(){}

    public function __destruct(){}

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    public function __toString(){
      return nl2br("Nome : $this->nomeCompleto
                    Email: $this->email
                    Login: $this->login
                    Senha: $this->senha
                    Imagem: $this->img
                    Data: $this->data
                    IMG: $this->imgTemp");
    }
  }
