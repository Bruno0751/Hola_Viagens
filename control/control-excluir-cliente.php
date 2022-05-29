<?php
    ob_start();
    session_start();

    include '../dao/dao-cliente.php';

    $daoCliente = new DAOCliente();

    if($daoCliente->verificarFKDAVenda($_GET['id']) == null){
        
        $_SESSION['msg'] = "Exclusão não Autorizada";
        header("location:../load-cadastro-de-cliente.html");
        ob_end_flush();
    }else{

        $daoCliente->deletarCliente($_GET['id']);
        $_SESSION['msg'] = "Cliente Excluido";
        header("location:../load-cadastro-de-cliente.html");
        ob_end_flush();

    }
    
    /*
    VERIFICAR SE EXISTE UMA VENDA CADASTRADA COM O ID DAQUELE CLIENTE
    */
    