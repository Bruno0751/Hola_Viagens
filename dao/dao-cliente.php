<?php
  require 'conexao.php';

  class DAOCliente { //DATA ACCESS OBJECT

    private $conexao = null;

    public function __construct(){
      $this->conexao = Conexao::getInstance();
    }

    public function __destruct(){}

    public function cadastrarCliente($cliente){
      try{

        $stat = $this->conexao->prepare("INSERT INTO hola_viagens.clientes(id_cliente, nome, email, lgin, senha, foto, data_nascimento, data_registro, hora_registro)VALUES(NULL, ?, ?, ?, ?, ?, ?, NOW(), NOW());");

        $stat->bindValue(1, $cliente->nomeCompleto);
        $stat->bindValue(2, $cliente->email);
        $stat->bindValue(3, $cliente->login); //CLASSE
        $stat->bindValue(4, $cliente->senha);
        $stat->bindValue(5, $cliente->img);
        $stat->bindValue(6, $cliente->data);

        $stat->execute();
        
      }catch(PDOException $erro){
        echo "Erro ao Cadastrar Cliente: ".$erro;
        
      }
    }

    public function buscarCliente(){
      try{

        $stat = $this->conexao->query("SELECT * FROM hola_viagens.clientes;");
        $array = $stat->fetchAll(PDO::FETCH_CLASS, "Cliente");
        return $array;
        
      }catch(PDOException $erro){
        echo "Erro ao Buscar Usuarios: ".$erro;
      }
    }

    public function deletarCliente($id){
      try{
        $stat = $this->conexao->prepare("DELETE FROM hola_viagens.clientes WHERE id_cliente = ?;");
        $stat->bindValue(1,$id);
        $stat->execute();
      }catch(PDOException $erro){
        echo "Erro ao deletar cliente: ".$erro;
      }
    }
    
    public function verificarLoginCliente($cliente){
      try{
        $stat = $this->conexao->prepare("SELECT * FROM hola_viagens.clientes WHERE lgin = ? AND senha = ?;");

        $stat->bindValue(1, $cliente->login);
        $stat->bindValue(2, $cliente->senha);

        $stat->execute();

        $cliente = null;
        $cliente = $stat->fetchObject('Cliente');
        return $cliente;
      }catch(PDOException $erro){
        echo "Erro ao Verificar Cliente: ".$erro;
      }
    }

    public function verificarFKDAVenda($id){
      try{
          $stat = $this->conexao->prepare("SELECT id_venda FROM hola_viagens.vendas WHERE cliente = ?;");

          $stat->bindValue(1, $id);

          $stat->execute();
  
          //$id = null;
          //$id = $stat->fetchObject('Cliente');

          return $id;
      }catch(PDOException $erro){ 
          echo "Erro ao Verificar FK" . $erro;
      }
  }

    public function filtrarCliente($pesquisa, $filtro){
     try{
       $query = "";
       switch($filtro){
         case "todos" : $query = "";
         break;
         case "codigo" : $query = "WHERE id_cliente = ".$pesquisa;
         break;
         case "nome" : $query = "WHERE nome LIKE '%".$pesquisa."%'";
         break;
         case "email" : $query = "WHERE email LIKE '%".$pesquisa."%'";
         break;
         case "login" : $query = "WHERE lgin LIKE '%".$pesquisa."%'";
         break;
         case "senha" : $query = "WHERE senha LIKE '%".$pesquisa."%'";
         break;
         // case "img" : $query = "WHERE foto LIKE '%".$pesquisa."%'";
         // break;
       }

       $stat = $this->conexao->query("SELECT * FROM hola_viagens.clientes {$query};");
       $array = $stat->fetchAll(PDO::FETCH_CLASS, "Cliente");
       return $array;
     }catch(PDOException $erro){
       echo "Erro ao Filtrar Cliente: ".$erro;
     }
   }

   public function alterarCliente($cliente){
    try{
      $stat = $this->conexao->prepare("UPDATE hola_viagens.clientes SET nome = ?, email = ?, lgin = ?, data_nascimento = ? WHERE id_cliente = ?;");

      $stat->bindValue(1, $cliente->nomeCompleto);
      $stat->bindValue(2, $cliente->email);
      $stat->bindValue(3, $cliente->login);
      $stat->bindValue(4, $cliente->data);
      $stat->bindValue(5, $cliente->idCliente);

      $stat->execute();
    }catch(PDOException $erro){
      echo "Erro ao Alterar Cliente: ".$erro;
    }
   }
 }
