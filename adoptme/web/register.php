
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Registro de usuario</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"> 
        <link href="style_register.css" rel="stylesheet" type="text/css">
        <link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
  <div class="register">
			<h1>Ya tienes una cuenta</h1>
			<a href="login.php">Login</a>
		</div>
		<div class="register">
			<h1>Registro de usuario</h1>
			<form  id="register-form"  method="post" autocomplete="off">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Usuario" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Contraseña" id="password" required>
				<label for="email">
					<i class="fas fa-envelope"></i>
				</label>
				<input type="email" name="email" placeholder="Email" id="email" required>
				<input type="submit" value="Registrar">
			</form>
		</div>
	</body>
</html>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#register-form').submit(function(e) {
        e.preventDefault();
        
        // Obtener los valores del formulario
        var username = $('#username').val();
        var password = $('#password').val();
        var email = $('#email').val();


        // Datos a enviar en la solicitud POST
        var data = {
          username: username,
          password: password,
          email: email
          
        };

        // Realizar la solicitud POST a la API externa
        $.ajax({
          url: 'http://localhost:3000/register',
          type: 'POST',
          data: JSON.stringify(data),
          contentType: "application/json",
          success: function(response) {
            // Redireccionar a index.php
            alert('Usuario registrado con éxito!');
            
            window.location.href = 'login.php';
          },
          error: function() {
            // Manejar el error si la solicitud AJAX falla
            alert('Error al registrar el usuario');
          }
        });
      });
    });
  </script>