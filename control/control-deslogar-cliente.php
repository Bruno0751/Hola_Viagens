<?php
session_start();
ob_start();

unset($_SESSION['privateUser']);
$_SESSION['msg'] = "Até Mais";
ob_end_clean();
ob_end_flush();
header("location:../load-login-de-cliente.html");
