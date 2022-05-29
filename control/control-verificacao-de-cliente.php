<?php
    session_start();
    ob_start();

    require_once '../model/cliente.php';
    require_once '../dao/dao-cliente.php';
    include '../utl/validacao.php';
                
    $c = new Cliente();

    $c->login = Validacao::antiXSS($_POST['textLogin']);
    $c->senha = Validacao::antiXSS($_POST['passSenha']);
                
    $clienteDAO = new DAOCliente();
    $cliente = $clienteDAO->verificarLoginCliente($c);

    if($cliente == null){

        $_SESSION['msg'] = "Cliente Inválido";
        header("location:../login-de-cliente.php");

    }else{

        $_SESSION['privateUser'] = serialize($cliente);

        header("location:../load-login-de-cliente.html");

    }