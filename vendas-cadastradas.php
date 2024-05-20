<?php
session_start();
ob_start();

include 'model/venda.php';
include 'dao/dao-venda.php';
include 'utl/helper.php';

$daoVenda = new DAOVenda();
$array = $daoVenda->buscarVenda();
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
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="clientes-cadastrados.php">Buscar Clientes</a></li>
                <li><a href="cadastro-de-venda.html">Cadastro de Vendas</a></li>
                <li><a href="vendas-cadastradas.php">Buscar Vendas</a></li>
            </ul>
        </nav>

        <?php
        if (count($array) == 0) {
            echo "<h1 id='vazio'>Não Há Vendas Cadastrados</h1>";
            return;
        }
        ?>

        <fieldset id="field-search">
            <legend style="text-align: center;">Digite Sua Pesquisa</legend>

            <form method="post" action="#">
                <input type="text" placeholder="Digite o Que Deseja!" name="textPesquisa" class="entradas-de-filtro">

                <select name="selecionarFiltro" class="entradas-de-filtro">
                    <option value="todos">Todos</option>
                </select>
                <div>
                    <input type="submit" value="Procurar" name="filtrar" class="entradas-de-filtro" style="width: 99%;"
                        onClick='informando()'>
                </div>

            </form>

            <?php
            if (isset($_POST['filtrar'])) {
                $pesquisa = $_POST['textPesquisa'];
                $filtro = $_POST['selecionarFiltro'];

                if (!empty($pesquisa)) {
                    $daoVenda = new DAOVenda();
                    $array = $daoVenda->filtrarVenda($pesquisa, $filtro);
                    if (count($array) == 0) {
                        echo "<h2 style='color: #FF4500; text-align: center; font-size: 30px;'>Pesquisa Não Encontrada</h2>
                                <br>
                                <p style='color: green; text-align: center; font-size: 30px;'>Tente Novamente</h2>";
                        return;
                    }
                }
            }

            ?>

        </fieldset>

        <div class="tabela-de-usuarios">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Data Venda</th>
                        <th>Vendedor</th>
                        <th>ID Cliente</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Excluir</th>
                        <th>Alterar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($array as $linhas) {
                        echo "<tr>";
                        echo "<td>$linhas->id_venda</td>";
                        echo "<td>$linhas->data_venda</td>";
                        echo "<td>$linhas->vendedor</td>";
                        echo "<td>$linhas->id_cliente</td>";
                        echo "<td>$linhas->data_registro</td>";
                        echo "<td>$linhas->hora_registro</td>";

                        echo "<td><a href='control/control-excluir-venda.php?id=$linhas->id_venda'>Excluir</a></td>";
                        //echo "<td><a href='alterar-venda.php?id=$linhas->id_venda'>Alterar</a></td>";
                    
                        echo "<td><a href='#' onClick='informando()'>Alterar</a></td>";
                        echo "</tr>";
                    }
                    ?>

                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Data Venda</th>
                        <th>Nome Vendedor</th>
                        <th>ID Cliente</th>
                        <th>Data</th>
                        <th>Hora</th>
                        <th>Excluir</th>
                        <th>Alterar</th>
                    </tr>
                </tfoot>
            </table>
        </div>

    </section>

    <footer>

    </footer>
</body>

</html>