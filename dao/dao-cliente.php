<?php
require 'conexao.php';

class DAOCliente
{ //DATA ACCESS OBJECT

  private $conexao = null;

  public function __construct()
  {
    $this->conexao = Conexao::getInstance();
  }

  public function __destruct()
  {
  }

  public function cadastrarCliente($cliente)
  {
    try {

      $stat = $this->conexao->prepare("INSERT INTO hola_viagens.cliente(id_cliente, nome, email, login, senha, foto, data_nascimento, cpf, cnpj, data_registro, hora_registro) VALUES(NULL, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW());");

      $stat->bindValue(1, $cliente->nomeCompleto);
      $stat->bindValue(2, $cliente->email);
      $stat->bindValue(3, $cliente->login); //CLASSE
      $stat->bindValue(4, $cliente->senha);
      $stat->bindValue(5, $cliente->img);
      $stat->bindValue(6, $cliente->data);
      $stat->bindValue(7, $cliente->cpf);
      $stat->bindValue(8, $cliente->cnpj);

      $stat->execute();
    } catch (PDOException $erro) {
      echo "<script>window.alert('Erro ao Cadastrar Cliente');</script>";
      // echo "Erro ao Cadastrar Cliente: " . $erro;
    }
  }

  public function buscarCliente()
  {
    try {

      $stat = $this->conexao->query("SELECT * FROM hola_viagens.cliente ORDER BY id_cliente DESC;");
      $array = $stat->fetchAll(PDO::FETCH_CLASS, "Cliente");
      return $array;
    } catch (PDOException $erro) {
      echo "<script>window.alert('Erro ao Buscar cliente');</script>";
      // echo "Erro ao Buscar Usuarios: " . $erro;
    }
  }

  public function deletarCliente($id)
  {
    try {
      $stat = $this->conexao->prepare("DELETE FROM hola_viagens.cliente WHERE id_cliente = ?;");
      $stat->bindValue(1, $id);
      $stat->execute();
    } catch (PDOException $erro) {
      echo "<script>window.alert('Erro ao deletar cliente');</script>";
      // echo "Erro ao deletar cliente: " . $erro;
    }
  }

  public function verificarLoginCliente($cliente)
  {
    try {
      $stat = $this->conexao->prepare("SELECT * FROM hola_viagens.cliente WHERE login = ? AND senha = ?;");

      $stat->bindValue(1, $cliente->login);
      $stat->bindValue(2, $cliente->senha);

      $stat->execute();

      $cliente = null;
      $cliente = $stat->fetchObject('Cliente');
      return $cliente;
    } catch (PDOException $erro) {
      echo "<script>window.alert('Erro ao Verificar Cliente');</script>";
      // echo "Erro ao Verificar Cliente: " . $erro;
    }
  }

  public function verificarFKDAVenda($id)
  {
    try {
      $stat = $this->conexao->prepare("SELECT id_venda FROM hola_viagens.venda WHERE cliente = ?;");

      $stat->bindValue(1, $id);

      $stat->execute();

      //$id = null;
      //$id = $stat->fetchObject('Cliente');

      return $id;
    } catch (PDOException $erro) {
      echo "Erro ao Verificar FK" . $erro;
    }
  }

  public function filtrarCliente($pesquisa, $filtro)
  {
    try {
      $query = "";
      switch ($filtro) {
        case "todos":
          $query = "";
          break;
        case "codigo":
          $query = "WHERE id_cliente = " . $pesquisa;
          break;
        case "nome":
          $query = "WHERE nome LIKE '%" . $pesquisa . "%'";
          break;
        case "email":
          $query = "WHERE email LIKE '%" . $pesquisa . "%'";
          break;
        case "login":
          $query = "WHERE lgin LIKE '%" . $pesquisa . "%'";
          break;
        case "senha":
          $query = "WHERE senha LIKE '%" . $pesquisa . "%'";
          break;
          // case "img" : $query = "WHERE foto LIKE '%".$pesquisa."%'";
          // break;
      }

      $stat = $this->conexao->query("SELECT * FROM hola_viagens.cliente {$query};");
      $array = $stat->fetchAll(PDO::FETCH_CLASS, "Cliente");
      return $array;
    } catch (PDOException $erro) {
      echo "<script>window.alert('Erro ao Filtrar Cliente');</script>";
      // echo "Erro ao Filtrar Cliente: " . $erro;
    }
  }

  public function alterarCliente($cliente)
  {
    try {
      $stat = $this->conexao->prepare("UPDATE hola_viagens.cliente SET nome = ?, email = ?, login = ?, data_nascimento = ?, cpf = ?, cnpj = ? WHERE id_cliente = ?;");

      $stat->bindValue(1, $cliente->nomeCompleto);
      $stat->bindValue(2, $cliente->email);
      $stat->bindValue(3, $cliente->login);
      $stat->bindValue(4, $cliente->data);
      $stat->bindValue(5, $cliente->cpf);
      $stat->bindValue(6, $cliente->cnpj);
      $stat->bindValue(7, $cliente->idCliente);

      $stat->execute();
    } catch (PDOException $erro) {
      echo "<script>window.alert('Erro ao Alterar Cliente');</script>";
      // echo "Erro ao Alterar Cliente: " . $erro;
    }
  }
}
