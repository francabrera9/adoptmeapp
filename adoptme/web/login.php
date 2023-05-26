<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="style.css" rel="stylesheet" type="text/css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	</head>
	<body>
    <div class="register">
			<h1>Registrarse</h1>
			<a href="register.php">Crear una cuenta</a>
		</div>

		<div class="login">
			<h1>Login</h1>
			<form id="login-form">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Usuario" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Contraseña" id="password" required>
				<input type="submit" value="Login">
			</form>
		</div>

		<script>
			$(document).ready(function() {
				$('#login-form').submit(function(e) {
					e.preventDefault();

					// Obtener los valores del formulario
					var username = $('#username').val();
					var password = $('#password').val();

					// Datos a enviar en la solicitud POST
					var data = {
						username: username,
						password: password
					};

					// Realizar la solicitud POST a la API externa
					$.ajax({
						url: 'http://localhost:3000/login',
						type: 'POST',
						data: JSON.stringify(data),
						contentType: 'application/json',
						success: function(response) {
							// Redireccionar a la página de inicio o realizar otras acciones
                           
                            <?php $_SESSION['username'] = "' + username + '"; ?>
                            <?php ?>
							window.location.href = 'index.php';
						},
						error: function() {
							// Manejar el error si la solicitud AJAX falla
							alert('Error al iniciar sesión');
						}
					});
				});
			});
		</script>
	</body>
</html>
