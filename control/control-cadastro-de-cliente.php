<?php
session_start();
ob_start();

include '../dao/dao-cliente.php';
include '../model/cliente.php';
// include '../utl/padronizacao.php';
// include '../utl/validacao.php';
$erro = null;
if ($_POST['textNome'] == "" || $_POST['textLogin'] == "" || $_POST['passwordSenha'] == "" || $_POST['dateDataNascimento'] == "") {
    $erro = "Dados Inválidos";
    $_SESSION['msg'] = $erro;
} else {
    $cliente = new Cliente();
    $cliente->nomeCompleto = $_POST['textNome'];
    $cliente->email = $_POST['emailEmail'];
    $cliente->login = $_POST['textLogin'];
    $cliente->senha = $_POST['passwordSenha'];
    $cliente->img = $_FILES["imagem"]["name"];
    $cliente->data = $_POST['dateDataNascimento'];
    $cliente->cpf = $_POST['txtCPF'];
    $cliente->cnpj = $_POST['txtCNPJ'];
    $daoCliente = new DAOCliente();
    $_SESSION['data'] = "data .$cliente->img";
    if ($cliente->img == null) {
        $cliente->img = null;
        $_SESSION['msg'] = "Nenhuma Foto Cadastrada";
        $_SESSION['msg2'] = "Cliente Cadastrado";
        $daoCliente->cadastrarCliente($cliente);
    } else {
        $folder = '../files/';
        if (!is_dir($folder)) {
            mkdir($folder, 0777, true);
            chmod($folder, 0755);
        }
        $fileToUpload = $folder . $cliente->img;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $folder . $cliente->img);
        $_SESSION['msg'] = "Cliente Cadastrado";
        $daoCliente->cadastrarCliente($cliente);
    }
}
ob_end_flush();
ob_end_clean();
header('location:../load-cadastro-de-cliente.html');
