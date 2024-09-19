<?php
include "connection.php";
session_start();
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Fornecedor</title>
    <link rel="stylesheet" href="../css/cadastrar_fornecedores.css">
</head>

<body>
    <header class="">
        <div class="menu-bar">
            <div>
                <a href="main_page.php">Home</a>
                <a href="cadastrar_produtos.php">Cadastrar Produtos</a>
                <a href="cadastrar_fornecedores.php">Cadastrar Fornecedores</a>
                <a href="criar_cesta.php">Cesta</a>
            </div>
            <div>
                <a class="sair" href="logout.php">Sair</a>
            </div>
        </div>
    </header>
    <div class="main">
        <div class="title">
            <h1>Cadastro de Fornecedor</h1>
        </div>
        <div class="form-container">
            <form action="cadastrar_fornecedor_script.php" method="post">
                <label for="nome">Nome do Fornecedor:</label>
                <input type="text" id="nome" name="nome" required>

                <label for="cnpj_cpf">CNPJ/CPF do Fornecedor:</label>
                <input type="text" id="nome" name="cnpj_cpf" required>

                <button type="submit">Cadastrar Fornecedor</button>
            </form>

            <div class="error-message">
                <?php
                if (isset($_GET['error'])) {
                    echo "<p>" . htmlspecialchars($_GET['error']) . "</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>