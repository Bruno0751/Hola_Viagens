<?php
ob_start();
session_start();

include '../dao/dao-venda.php';

$daoVenda = new DAOVenda();

$daoVenda->deletarVenda($_GET['id']);

$_SESSION['msg'] = "Venda Excluido";
ob_end_clean();
ob_end_flush();
header("location:../load-cadastro-de-venda.html");
