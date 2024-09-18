<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="../css/login.css">

<body>
    <div class="container">
        <form action="login_script.php" method="post">
            <h2>Login</h2>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" name="senha" id="senha" required>
                <button type="button" class="toggle-password" onclick="togglePassword()">
                                <span id="toggle-icon" class="eye-icon">&#128065;</span>
                            </button>
                
            </div>
            <button class="btn btn-success" type="submit">Entrar</button>
        </form>
        <div class="form-group">
            <p>Não tem uma conta?</p>
            <button class="btn btn-success" onclick="window.location.href='cadastro.php'">Cadastre-se</button>
        </div>
        <div class="error-message">
            <?php
            if (isset($_GET['error'])) {
                echo "<p>" . htmlspecialchars($_GET['error']) . "</p>";
            }
            ?>
        </div>
    </div>

    <script src="../js/login.js"></script>

</body>

</html>