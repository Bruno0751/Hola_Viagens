<?php
    session_start();
    ob_start();

    unset($_SESSION['privateUser']);
    $_SESSION['msg'] = "Até Mais";
    header("location:../load-login-de-cliente.html");

    ob_end_flush();