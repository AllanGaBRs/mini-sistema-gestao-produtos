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

            session_start();

            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $email = mysqli_real_escape_string($conn, $email);
            $senha = mysqli_real_escape_string($conn, $senha);

            $query = "SELECT password FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $query);

            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $hashArmazenado = $row['password'];
                }
            }if (password_verify($senha, $hashArmazenado) && $email != null) {
                
                $_SESSION['email'] = $email;
                $_SESSION['senha'] =  $senha;
                header("Location: main_page.php");
                $conn->close();
            } else {
                $error_message = "Usuário não encontrado. Tente novamente ou faça cadastro.";
                unset ($_SESSION['email']);
                unset ($_SESSION['senha']);
                header("Location: login.php?error=" . urlencode($error_message));
                exit();
                $conn->close();
            }
            $conn->close();
            ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>