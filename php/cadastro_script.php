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
            $adress = $_POST['endereco'];
            $cellnumber = $_POST['telefone'];
            $email = $_POST['email'];
            $password = password_hash($_POST['senha'], PASSWORD_DEFAULT);
            $borndate = $_POST['dt_nascimento'];

            $sql = "SELECT * FROM users WHERE email = '$email'";

            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                $error_message = "E-mail já cadastrado. Tente outro ou faça login.";
                header("Location: cadastro.php?error=" . urlencode($error_message));
                exit();
            }
            $sql = "INSERT INTO 
                `users`(`name`, `adress`, `cellnumber`, `email`, `password`, `borndate`) 
                VALUES 
                ('$name', '$adress', '$cellnumber', '$email', '$password', '$borndate')";

            if (mysqli_num_rows($result) <= 0 && mysqli_query($conn, $sql)) {
                header("Location: login.php");
                $conn->close();
            } else {
                header("Location: cadastro.php");
                $conn->close();
            }
            $conn->close();

            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>