<?php
    session_start();
    ob_start();

    include '../dao/dao-cliente.php';
    include '../model/cliente.php';
    include '../utl/padronizacao.php';
    include '../utl/validacao.php';

    $cliente = new Cliente();

    $cliente->nomeCompleto = Validacao::antiXSS(Padronizacao::padronizandoNome($_POST['textNome']));
    $cliente->email = Validacao::antiXSS($_POST['emailEmail']);
    $cliente->login = Validacao::antiXSS($_POST['textLogin']);
    $cliente->senha = Validacao::antiXSS($_POST['passwordSenha']);
    $cliente->img = $_FILES["imagem"]["name"];
    $cliente->data = $_POST['dateDataNascimento'];
    
    $daoCliente = new DAOCliente();
    
    $_SESSION['data'] = "data .$cliente->img";

    if ($cliente->data == "") {
        $cliente->data = null;
    }

    if($cliente->img == null){
        
        $cliente->img = null;

        $daoCliente->cadastrarCliente($cliente);

        $_SESSION['msg'] = "Nenhuma Foto Cadastrada";
        $_SESSION['msg2'] = "Cliente Cadastrado";

        header('location:../load-cadastro-de-cliente.html');
        //$cliente->__destruct();
        ob_end_flush();

    }else{

        $folder = '../files/'; 
        if(!is_dir($folder)){
            mkdir($folder, 0777, true);
            chmod($folder, 0755);
        }

        $fileToUpload = $folder.$cliente->img;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $folder.$cliente->img);

        $daoCliente->cadastrarCliente($cliente);
        $_SESSION['msg'] = "Cliente Cadastrado";
        header('location:../load-cadastro-de-cliente.html');
        ob_end_flush();

    }              