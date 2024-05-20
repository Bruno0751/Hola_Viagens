<?php
require 'Conexao.php';

class DAOVenda
{ //DATA ACCESS OBJECT

  private $conexao = null;

  public function __construct()
  {
    $this->conexao = Conexao::getInstance();
  }

  public function __destruct()
  {
  }

  public function cadastrarVenda($venda)
  {
    try {

      $stat = $this->conexao->prepare("INSERT INTO hola_viagens.venda VALUES(NULL, ?, ?, ?, NOW(), NOW());");

      $stat->bindValue(1, $venda->dataDAVenda);
      $stat->bindValue(2, $venda->nomeDOVendedor);
      $stat->bindValue(3, $venda->cliente); //CLASSE

      $stat->execute();
    } catch (PDOException $erro) {
      echo "<script>window.alert('Erro ao Cadastrar Venda');</script>";
      // echo "Erro ao Cadastrar Venda: " . $erro;
    }
  }

  public function buscarVenda()
  {
    try {
      $stat = $this->conexao->query("SELECT * FROM venda;");
      // $stat = $this->conexao->query("SELECT tv.*, tc.nome FROM hola_viagens.venda AS tv INNER JOIN hola_viagens.cliente AS tc, ON tc.id_cliente = tv.id_cliente;");
      $array = $stat->fetchAll(PDO::FETCH_CLASS, "Venda");
    } catch (PDOException $erro) {
      echo "<script>window.alert('Erro ao Buscar Vendas');</script>";
      // echo "Erro ao Buscar Vendas: " . $erro;
    }
    $nomeCliente = $this->conexao->query("SELECT tc.nome FROM hola_viagens.venda AS tv INNER JOIN hola_viagens.cliente AS tc, ON tc.id_cliente = tv.id_cliente;");
    $array = $stat->fetch (PDO::FETCH_CLASS, "Venda");
    // $array->id_cliente = $nome;
    return $array;
  }

  public function deletarVenda($id)
  {
    try {
      $stat = $this->conexao->prepare("DELETE FROM venda WHERE id_venda = ?;");
      $stat->bindValue(1, $id);
      $stat->execute();
    } catch (PDOException $erro) {
      echo "<script>window.alert('Erro ao Deletar Venda');</script>";
      // echo "Erro ao Deletar Venda: " . $erro;
    }
  }

  public function verificarIDDAVenda($id)
  {
    try {
      $stat = $this->conexao->prepare("SELECT id_venda FROM venda WHERE id_venda = ?;");

      $stat->bindValue(1, $id);

      $stat->execute();

      $id = null;
      $id = $stat->fetchALL(PDO::FETCH_CLASS, 'Venda');

      return $id;
    } catch (PDOException $erro) {
      echo "<script>window.alert('Erro ao Verificar ID Venda');</script>";
      // echo "Erro ao Verificar ID Venda: " . $erro;
    }
  }

  public function verificarIDClienteFK($fk)
  {
    try {
      $stat = $this->conexao->prepare("SELECT id_cliente FROM cliente WHERE id_cliente = ?");
      $stat->bindValue(1, $fk);
      $stat->execute();

      $fk = null;
      $fk = $stat->fetchObject('Venda');

      return $fk;
    } catch (PDOException $erro) {
      echo "<script>window.alert('Erro ao Verificar FK');</script>";
      // echo "Erro ao Verificar FK" . $erro;
    }
  }

  public function filtrarVenda($pesquisa, $filtro)
  {
    try {
      $query = "";
      switch ($filtro) {
        case "todos":
          $query = "";
          break;
        case "codigo":
          $query = "WHERE id_Venda = " . $pesquisa;
          break;
        case "nome":
          $query = "WHERE data_venda LIKE '%" . $pesquisa . "%'";
          break;
        case "email":
          $query = "WHERE nome_vendedor LIKE '%" . $pesquisa . "%'";
          break;
        case "login":
          $query = "WHERE cliente LIKE '%" . $pesquisa . "%'";
          break;
      }

      //echo "query: ".$query;
      $stat = $this->conexao->query("SELECT * FROM venda {$query};");
      $array = $stat->fetchAll(PDO::FETCH_CLASS, "Venda");
      return $array;
    } catch (PDOException $erro) {
      echo "<script>window.alert('Erro ao Filtrar Venda');</script>";
      // echo "Erro ao Filtrar Venda: " . $erro;
    }
  }
  /*
   public function alterarVenda($venda){
    try{
      $stat = $this->conexao->prepare("UPDATE vendas SET nome_vendedor = ? WHERE id_Venda=?");

      $stat->bindValue(1, $venda->nomeDOVendedor);
      $stat->bindValue(2, $venda->idVenda);

      $stat->execute();
    }catch(PDOException $erro){
      echo "Erro ao Alterar Venda: ".$erro;
    }
   }
   */
}
