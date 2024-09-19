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
            $cnpj_cpf = $_POST['cnpj_cpf'];

            $sql = "SELECT * FROM suppliers WHERE cnpj_cpf = '$cnpj_cpf'";

            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $error_message = "Fornecedor já cadastrado. Tente outro.";
                header("Location: cadastrar_fornecedores.php?error=" . urlencode($error_message));
                exit();
            }
            $sql = "INSERT INTO 
                `suppliers`(`name`, `cnpj_cpf`) 
                VALUES 
                ('$name', '$cnpj_cpf')";

            if (mysqli_num_rows($result) <= 0 && mysqli_query($conn, $sql)) {
                header("Location: cadastrar_fornecedores.php");
                $conn->close();
            } else {
                header("Location: cadastrar_fornecedores.php");
                $conn->close();
            }
            $conn->close();

            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>