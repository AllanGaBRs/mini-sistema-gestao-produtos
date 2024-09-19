<!DOCTYPE html>
<html lang="pt-BR">

<head>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="../css/cadastro.css">
		<title>Tela de cadastro</title>
	</head>

<body>
	<div class="container">
		<div class="row">
			<div class="col">
				<h1>Cadastro</h1>
				<form action="cadastro_script.php" method="POST">
					<div class="form-group">
						<label for="name">Nome completo</label>
						<input type="text" class="form-control" placeholder="Digite seu nome aqui" name="nome" required>
					</div>
					<div class="form-group">
						<label for="endereco">Endereço</label>
						<input type="text" class="form-control" placeholder="Digite seu endereço aqui" name="endereco" required>
					</div>
					<div class="form-group">
						<label for="telefone">Telefone</label>
						<input type="tel" maxlength="16" class="form-control" pattern="\(\d{2}\) \d{5}-\d{4}" placeholder="(99) 99999-9999" name="telefone" required>
						<small>Formato: (99) 99999-9999</small>
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" class="form-control" placeholder="Digite seu email aqui" name="email" required>
					</div>
					<div class="form-group">
						<label for="senha">Senha</label>
						<input type="text" class="form-control" name="senha" placeholder="Digite sua senha aqui" required>
					</div>
					<div class="form-group">
						<label for="dt_nascimento">Data de nascimento</label>
						<input type="date" class="form-control" name="dt_nascimento" required>
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-success">
					</div>
					<div class="login-link">
						<p>Já tem uma conta? <a href="login.php">Faça login</a></p>
					</div>
					<div class="error-message">
						<?php
						if (isset($_GET['error'])) {
							echo "<p>" . htmlspecialchars($_GET['error']) . "</p>";
						}
						?>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>