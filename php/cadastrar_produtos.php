<?php
include "connection.php";
session_start();
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('location:login.php');
}

$sql = "SELECT name FROM suppliers";
$result = $conn->query($sql);
$fornecedores = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fornecedores[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar produtos</title>
    <link rel="stylesheet" href="../css/cadastrar_produtos.css">
</head>

<body>
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

    <div class="title">
        <h1>Cadastro de Produtos</h1>
    </div>
    <div class="form-container">
        <form action="cadastrar_produtos_script.php" method="POST">
            <label for="nome">Nome do Produto:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="descricao">Descrição:</label>
            <textarea id="descricao" name="descricao" rows="4" required></textarea>

            <label for="preco">Preço:</label>
            <input type="number" id="preco" name="preco" step="0.01" min="1" required>

            <label for="quantidade">Quantidade em Estoque:</label>
            <input type="number" id="quantidade" name="quantidade" required step="1" min="1">

            <label for="fornecedor">Fornecedor:</label>
            <select id="fornecedor" name="fornecedor" required>
                <option value="">Selecione um fornecedor</option>
                <?php foreach ($fornecedores as $fornecedor): ?>
                    <option value="<?php echo $fornecedor['name']; ?>"><?php echo htmlspecialchars($fornecedor['name']); ?></option>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit">Cadastrar Produto</button>
                
                <div class="error-message">
                    <?php
                if (isset($_GET['error'])) {
                    echo "<p>" . htmlspecialchars($_GET['error']) . "</p>";
                }
                ?>
            </div>
            <p>Não tem fornecedores cadastrados? </p>
            <a href="cadastrar_fornecedores.php" class="a_supplier">Cadastrar fornecedor</a>
        </form>
    </div>
</body>

</html>