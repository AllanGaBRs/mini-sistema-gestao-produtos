<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <title>Sistema de gestão de produtos</title>
    </head>

<body>
    <div class="container">
        <div class="row">
            <?php
            include "connection.php";

            $name = $_POST['nome'];
            $description = $_POST['descricao'];
            $price = $_POST['preco'];
            $quantity = $_POST['quantidade'];
            $supplier = $_POST['fornecedor'];

            $sql = "SELECT * FROM products WHERE name = '$name'";

            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $error_message = "Produto já cadastrado. Tente outro.";
                header("Location: cadastrar_produtos.php?error=" . urlencode($error_message));
                exit();
            }

            $sql = "SELECT * FROM suppliers WHERE name = '$supplier'";
            $resultado = mysqli_query($conn, $sql);

            $supplierId = 0;
            if ($resultado->num_rows > 0) {
                $row = $resultado->fetch_assoc();
                $supplierId = $row['cod_supp'];
            }
                $sql = "INSERT INTO 
                    `products`(`name`, `description`, `price`,  `quantity`, `supplier_id`) 
                    VALUES 
                    ('$name', '" . htmlspecialchars($description, ENT_QUOTES) . "' , '$price', '$quantity', '$supplierId')";
            if (mysqli_query($conn, $sql)) {
                header("Location: cadastrar_produtos.php");
                $conn->close();
            } else {
                header("Location: cadastrar_produtos.php");
                $conn->close();
            }
            $conn->close();

            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>