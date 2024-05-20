<?php
ob_start();
session_start();

include '../dao/dao-cliente.php';

$daoCliente = new DAOCliente();

if ($daoCliente->verificarFKDAVenda($_GET['id']) == null) {

    $_SESSION['msg'] = "Exclusão não Autorizada";
    header("location:../load-cadastro-de-cliente.html");
    ob_end_flush();
} else {

    $daoCliente->deletarCliente($_GET['id']);
    $_SESSION['msg'] = "Cliente Excluido";
    ob_end_clean();
    ob_end_flush();
    header("location:../load-cadastro-de-cliente.html");
}
