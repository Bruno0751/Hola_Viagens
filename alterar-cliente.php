<?php
session_start();
ob_start();
include 'utl/helper.php';

if (isset($_GET['id'])) {
    include 'dao/dao-cliente.php';
    include 'model/cliente.php';

    $daoCliente = new DAOCliente();
    $array = $daoCliente->filtrarCliente($_GET['id'], "codigo");

    $cliente = $array[0];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!--50 caracteres-->
    <title>HolaViagens</title>

    <meta charset="UTF-8">
    <meta name="author" content="Bruno Gressler da Silveira">
    <!--caracters 150-->
    <meta name="description" content="Site de Viagens">
    <!--5 keywords-->
    <meta name="keywords" content="Viagens">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index,nofolow">

    <link rel="stylesheet" type="text/css" href="style/styles.css">
    <link rel="shortcut icon" href="images/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">

    <script src="js/script.js"></script>
</head>

<body>
    <time datetime="2012-02-15"></time>

    <header>
        <a href="index.html"><img src="images/logo.png" alt="Voltar ao Inicio" title="Voltar ao Inicio"></a>
        <ul class="lado">
            <li><a href="cadastro-de-cliente.html" id="link-cadastro">Cadastrar</a></li>
            <li><a href="login-de-cliente.php" id="link-login">Login</a></li>
        </ul>
    </header>

    <section>

        <h2 style="display: none;">HolaViagens</h2>

        <nav>

            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="clientes-cadastrados.php">Buscar Clientes</a></li>
                <li><a href="cadastro-de-venda.html">Cadastro de Venda</a></li>
                <li><a href="vendas-cadastradas.php">Buscar Vendas</a></li>
            </ul>

        </nav>

        <fieldset>
            <legend>Alterar Usuário</legend>

            <form method="post" action="#">

                <input type="text" class="cadastrar-input-margem" name="textNomeCompleto" value="<?php if (isset($cliente)) {
                                                                                                        echo $cliente->nome;
                                                                                                    } ?>">

                <input type="email" class="cadastrar-input-margem" name="email" value="<?php if (isset($cliente)) {
                                                                                            echo $cliente->email;
                                                                                        } ?>">

                <input type="text" class="cadastrar-input-margem" name="textLogin" value="<?php if (isset($cliente)) {
                                                                                                echo $cliente->lgin;
                                                                                            } ?>">

                <input type="date" class="input-date" name="dateDataNascimento" value="<?php if (isset($cliente)) {
                                                                                            echo $cliente->data_nascimento;
                                                                                        } ?>">

                <div class="bt-cadastrar-bt-limpar">
                    <li>
                        <input type="submit" value="Alterar" name="alterar" class="cadastrar-entrar-bt-margem-tb">
                    </li>
                </div>

            </form>
        </fieldset>
    </section>

    <footer>

    </footer>
    <?php
    if (isset($_POST['alterar'])) {
        include_once 'dao/dao-cliente.php';

        //include 'util/padronizacao.php';

        $cliente = new Cliente();

        $cliente->idCliente = $_GET['id'];
        $cliente->nomeCompleto = $_POST['textNomeCompleto'];
        $cliente->email = $_POST['email'];
        $cliente->login = $_POST['textLogin'];
        $cliente->data = $_POST['dateDataNascimento'];

        $daoCliente = new DAOCliente();
        $daoCliente->alterarCliente($cliente);

        $_SESSION['msg'] = "Cliente Alterado";

        header("location:clientes-cadastrados.php");

        ob_end_flush();
    }
    ?>
</body>

</html>