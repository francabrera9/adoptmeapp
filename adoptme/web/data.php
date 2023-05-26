<?php
require_once('./Classes/Curl.php');


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
        <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>


        </ul>
      </nav>
    </div>
  </header>
  <div class="container">
    <h1>Detalle Mascota</h1>

    <form id="edit-form">
      
    <div class="image-container">
      <img width="600px" src="https://images.hola.com/imagenes/mascotas/20221007218657/perros-consejos-adopcion-dn/1-149-28/consejos-decidir-adoptar-perro-t.jpg" alt="Perro" />
    </div>

      <div class="form-group">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?=$response->nombre?>" readonly>
      </div>

      <div class="form-group">
        <label for="sexo">Sexo:</label>
        <input type="text" id="sexo" name="sexo" value="<?=$response->sexo?>" readonly>
      </div>

      <div class="form-group">
        <label for="provincia">Provincia:</label>
        <input type="text" id="provincia" name="provincia" value="<?=$response->provincia?>" readonly>
      </div>

      <div class="form-group">
        <label for="color">Color:</label>
        <input type="text" id="color" name="color" value="<?=$response->color?>" readonly>
      </div>

      <div class="form-group">
        <label for="peso">Peso:</label>
        <input type="text" id="peso" name="peso" value="<?=$response->peso?>" readonly>.
      </div>

      <div class="form-group">
        <label for="tamano">Tamano:</label>
        <input type="text" id="tamano" name="tamano" value="<?=$response->tamano?>" readonly>
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
</body>
</html>
