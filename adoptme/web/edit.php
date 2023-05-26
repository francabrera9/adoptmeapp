<?php
require_once('./Classes/Curl.php');

// // Ejemplo de uso
$apiBaseUrl = 'host.docker.internal:3000';
$restClient = new RestClient($apiBaseUrl);

// Ejemplo de solicitud GET
$id_mascota = $_GET['id'] ?? 0;
$response = $restClient->get("/mascotas/{$id_mascota}") ?? [];

if (empty($response)) {
    echo 'Mascota no encontrada';
    exit;
}

$a_tamanos = [
  "P" => 'Pequeño',
  "M" => 'Mediano',
  "G" => 'Grande'
];

$html_tamanos = null;
foreach ($a_tamanos as $k_tamano => $v_tamano) {
  $selected = ($response->tamano === $v_tamano) ? "selected" : null;
  $html_tamanos .= "<option value=\"{$k_tamano}\" {$selected}>{$v_tamano}</option>";
}

$a_sexo = [
  "M" => 'Macho',
  "H" => 'Hembra'
];

  $html_sexo = null;
foreach ($a_sexo as $k_sexo => $v_sexo) {
  $selected = ($response->sexo === $v_sexo) ? "selected" : null;
  $html_sexo .= "<option value=\"{$k_sexo}\" {$selected}>{$v_sexo}</option>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Editar Mascota</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

</head>
<body>
<header>
    <div class="container">
      <nav>
        <h1> <img src="./img/logo/adoptme.png" height="150px" width="180px" alt="logo">  </h1>
        <ul>
        <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
        <li><a href="new.php"><i class="fas fa-plus-circle"></i> Añadir mascota</a></li>
        <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>


        </ul>
      </nav>
    </div>
  </header>
  <div class="container">
    <h1>Editar Mascota</h1>

    <form id="edit-form">
      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?=$response->nombre?>" required>
      </div>

      <div class="form-group">
        <label for="sexo">Sexo:</label>
        <select id="sexo" name="sexo" required>
          <option value="">Seleccione</option>
          <?=$html_sexo?>
        </select>
      </div>

      <div class="form-group">
        <label for="provincia">Provincia:</label>
        <input type="text" id="provincia" name="provincia" value="<?=$response->provincia?>" required>
      </div>

      <div class="form-group">
        <label for="color">Color:</label>
        <input type="text" id="color" name="color" value="<?=$response->color?>" required>
      </div>

      <div class="form-group">
        <label for="peso">Peso:</label>
        <input type="text" id="peso" name="peso" value="<?=$response->peso?>" required>.
      </div>

      <div class="form-group">
        <label for="tamano">Tamano:</label>
        <select id="tamano" name="tamano" required>
          <option value="">Seleccione</option>
          <?=$html_tamanos?>
        </select>
      </div>

      <div class="form-group">
        <button type="submit">Guardar</button>
      </div>
    </form>
  </div>
  <footer>
    <div class="container">
      <p>Adoptme &copy; 2023 Todos los derechos reservados
        Francisco Manuel Cabrera Cañete
        
      </p>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <?php
session_start();

// Verificar si la variable de sesión 'username' está definida
if(isset($_SESSION['username'])) {
    // El usuario ha iniciado sesión
    $username = $_SESSION['username'];
    // Resto del código de la página
    // ...
} else {
    // El usuario no ha iniciado sesión, redireccionar al formulario de inicio de sesión
    header("Location: login.php");
    exit();
}
?>

  <script>
    $(document).ready(function() {
      $('#edit-form').submit(function(e) {
        e.preventDefault();
        
        // Obtener los valores del formulario
        var nombre = $('#nombre').val();
        var sexo = $('#sexo').val();
        var provincia = $('#provincia').val();
        var color = $('#color').val();
        var peso = $('#peso').val();
        var tamano = $('#tamano').val();

        // Datos a enviar en la solicitud POST
        var data = {
          nombre: nombre,
          sexo: sexo,
          provincia: provincia,
          color: color,
          peso: peso,
          tamano: tamano
        };

        // Realizar la solicitud POST a la API externa
        $.ajax({
          url: 'http://localhost:3000/mascotas/<?=$response->id?>',
          type: 'PATCH',
          data: JSON.stringify(data),
          contentType: "application/json",
          success: function(response) {
            // Redireccionar a index.php
            window.location.href = 'index.php';
          },
          error: function() {
            // Manejar el error si la solicitud AJAX falla
            alert('Error al actualizar la mascota');
          }
        });
      });
    });
  </script>
</body>
</html>
