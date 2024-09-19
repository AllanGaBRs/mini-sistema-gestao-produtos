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
    <title>Cesta</title>
    <link rel="stylesheet" href="../css/criar_cesta.css">
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

    <?php
    include "connection.php";

    $sql = "SELECT name, price, cod_prod from products";
    $result = mysqli_query($conn, $sql);

    $produtos = array();

    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $produtos[] = $row;
        }
    }
    
    $sql = "SELECT cod_user from users WHERE email = '$_SESSION[email]'";
    $result = mysqli_query($conn, $sql);
    
    $userId = 0;
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $userId = $row['cod_user'];
    }

   // $produtos_selecionados = $_POST['produtos_selecionados'];
    $produtos_selecionados = isset($_POST['produtos_selecionados']) ? $_POST['produtos_selecionados'] : [];
    if($produtos_selecionados == null){
        echo '<div class="basket-container">';
        echo '<h1>Cesta Vazia</h1>';
        echo '<p>Você não selecionou nenhum produto.</p>';
        echo '</div>';
        exit();
    }

   
    $totalprice = 0.0;
    $quantity = 0;

    foreach ($produtos as $p) {
        foreach ($produtos_selecionados as $ps) {
            if ($p['cod_prod'] === $ps) {
                $totalprice += $p['price'];
                $quantity++;
            }
        }
    }
    $sql = "INSERT INTO 
                `basket`(`totalprice`, `quantity`, `user_id`) 
                VALUES 
                ('$totalprice', '$quantity', '$userId')";

    mysqli_query($conn, $sql);
    ?>

    <div class="basket-container">
        <h1>Resumo da Cesta</h1>
        <div class="basket-details">
            <div class="detail">
                <span class="label">Quantidade de Produtos:</span>
                <span class="value"><?php echo $quantity; ?></span>
            </div>
            <div class="detail">
                <span class="label">Preço Total:</span>
                <span class="value">R$ <?php echo number_format($totalprice, 2, ',', '.'); ?></span>
            </div>
        </div>
        <button class="checkout-btn">Finalizar Compra</button>
    </div>

</body>

</html>