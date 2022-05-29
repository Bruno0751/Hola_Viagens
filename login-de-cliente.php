<?php
session_start();
ob_start();
include_once 'utl/helper.php';
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
    <time datetime="2020-08-12"></time>

    <?php
    echo isset($_SESSION['msg']) ? Helper::alert($_SESSION['msg']) : "";
    unset($_SESSION['msg']);
    ?>

    <header>
        <a href="index.html"><img src="images/logo.png" alt="Voltar ao Inicio" title="Voltar ao Inicio"></a>
        <ul class="lado">
            <li><a href="cadastro-de-cliente.html" id="link-cadastro">Cadastrar</a></li>
            <li><a href="login-de-cliente.php" id="link-login">Login</a></li>
        </ul>
    </header>

    <section>
        <h2 style="display: none;">HolaViagens</h2>

        <?php
        if (isset($_SESSION['privateUser'])) {
        ?>

            <nav>
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="clientes-cadastrados.php">Buscar Clientes</a></li>
                    <li><a href="cadastro-de-venda.html">Cadastro de Vendas</a></li>
                    <li><a href="vendas-cadastradas.php">Buscar Vendas</a></li>
                </ul>
            </nav>

        <?php
        }

        ?>

        <div id="margem-top">
            <fieldset>

                <?php
                if (!isset($_SESSION['privateUser'])) {
                ?>

                    <legend>Login</legend>
                    <form method="post" action="control/control-verificacao-de-cliente.php">

                        <input type="text" placeholder="Login" class="cadastrar-input-margem" name="textLogin">
                        <input type="password" placeholder="Senha" class="cadastrar-input-margem" name="passSenha">
                        <div>
                            <input type="submit" value="entrar" class="cadastrar-entrar-bt-margem-tb" name="entrar">
                            <input type="reset" value="Limpar Campos" class="limpar-deslogar-bt-margem-tb">
                        </div>

                    </form>

                <?php
                } else {
                    include "model/cliente.php";
                    $user = unserialize($_SESSION['privateUser']);
                    echo "<h2>Olá, seja bem vindo!</h2>";
                }
                ?>

                <form method="post" action="control/control-deslogar-cliente.php">
                    <div class="form-group">
                        <input type="submit" name="deslogar" value="Sair">
                    </div>
                </form>



            </fieldset>
        </div>
    </section>

    <footer>

    </footer>

</body>

</html>