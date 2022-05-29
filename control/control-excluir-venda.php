<?php
    ob_start();
    session_start();

    include '../dao/dao-venda.php';

    $daoVenda = new DAOVenda();

    $daoVenda->deletarVenda($_GET['id']);

    $_SESSION['msg'] = "Venda Excluido";

    header("location:../load-cadastro-de-venda.html");

    ob_end_flush();