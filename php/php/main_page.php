<?php
include "connection.php";
session_start();
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('location:login.php');
}
$email = $_SESSION['email'];
$sql = "SELECT name FROM `users` WHERE email = '$email'";

$result = $conn->query($sql);
$logado;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $logado = $row['name'];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de gestão de produtos</title>
    <link rel="stylesheet" href="../css/main_page.css">
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

    <div style="padding: 20px;">
        <h1>Bem-vindo <?php echo $logado ?> </h1>
        <?php
        include "connection.php";

        $sql = "SELECT s.name as nameSup, p.name, p.description, p.price, p.quantity, p.cod_prod 
                FROM suppliers as s
                INNER JOIN products as p on p.supplier_id = s.cod_supp";
        $result = mysqli_query($conn, $sql);

        $produtos = array();

            while ($row = $result->fetch_assoc()) {
                $produtos[] = $row;
            }
            echo '<!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Lista de Produtos</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                }
                .container {
                    width: 80%;
                    margin: auto;
                    overflow: hidden;
                }
                h1 {
                    color: #333;
                    text-align: center;
                    padding: 20px 0;
                }

                .btn{
                    color: #333;
                    text-align: center;
                    padding: 10px 0;
                }

                table {
                    width: 100%;
                    margin: 20px 0;
                    border-collapse: collapse;
                    background: #fff;
                    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                }
                th, td {
                    padding: 12px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }
                th {
                    background-color: #4CAF50;
                    color: white;
                }
                tr:nth-child(even) {
                    background-color: #f2f2f2;
                }
                tr:hover {
                    background-color: #ddd;
                }
                .no-products {
                    text-align: center;
                    padding: 20px;
                    font-size: 1.2em;
                    color: #555;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>Lista de Produtos</h1>
                <form method="POST" action="criar_cesta.php">
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Fornecedor</th>
                            <th>Selecionar</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>';

            foreach ($produtos as $produto) {

                echo '<tr id="row-' . htmlspecialchars($produto['cod_prod']) . '">';
                echo '<td class="product-name"> ' . htmlspecialchars($produto['name']) . '</td>';
                echo '<td>' . htmlspecialchars($produto['description']) . '</td>';
                echo '<td>R$ ' . number_format($produto['price'], 2, ',', '.') . '</td>';
                echo '<td>' . htmlspecialchars($produto['quantity']) . '</td>';
                echo '<td>' . htmlspecialchars($produto['nameSup']) . '</td>';
                echo '<td><input type="checkbox" for="produtos_selecionados[]" name="produtos_selecionados[]" id="chec_box" value="' . htmlspecialchars($produto['cod_prod']) . '"></td>';
                echo '<td><button for="edit" name="edit" id="btn_edit" onclick="edita(event, \'' . htmlspecialchars($produto['cod_prod']) . '\')">Editar</button></td>';
                echo '<td><button for="delete" name="delete" id="btn_delete" onclick="deleta(event, \'' . htmlspecialchars($produto['cod_prod']) . '\')">Excluir</button></td>';
                echo '</tr>';
            }

            if($produtos == null){
                echo '<tr><td colspan="8" style="text-align: center;">Nenhum produto encontrado.</td></tr>';
            }
            echo '
            </tbody>
            </table>
            <button id="btn_confirmar" type="submit" class="btn">Confirmar produtos</button>
            </div>
            </form>
            </body>
            </html>';
        
        ?>
        <script src="../js/main_page.js"></script>