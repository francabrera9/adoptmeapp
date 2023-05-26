<?php
require_once('./Classes/Curl.php');


session_start();


// Verificar si la variable de sesión 'username' está definida
if(isset($_SESSION['username'])) {
    // El usuario ha iniciado sesión
    $username = $_SESSION['username'];
    
} else {
    // El usuario no ha iniciado sesión, redireccionar al formulario de inicio de sesión
    header("Location: login.php");
    exit();
}



// // Ejemplo de uso
$apiBaseUrl = 'host.docker.internal:3000';
$restClient = new RestClient($apiBaseUrl);

// Ejemplo de solicitud GET
$response = $restClient->get('/mascotas') ?? [];

$mascotas_list_html = null;
foreach ($response as $mascota) {
    $mascotas_list_html .= <<<html
    <tr>
        <td>
            <a href="data.php?id={$mascota->id}">
                {$mascota->id}
            </a>
        </td>
        <td>
            <a href="data.php?id={$mascota->id}">
                {$mascota->nombre}
            </a>
        </td>
        <td>
            <a href="data.php?id={$mascota->id}">
                {$mascota->sexo}
            </a>
        </td>
        <td>
            <a href="data.php?id={$mascota->id}">
                {$mascota->provincia}
            </a>
        </td>
        <td>
            <a href="data.php?id={$mascota->id}">
                {$mascota->color}
            </a>
        </td>
        <td>
            <a href="data.php?id={$mascota->id}">
                {$mascota->peso}
            </a>
        </td>
        <td>
            <a href="data.php?id={$mascota->id}">
                {$mascota->tamano}
            </a>
        </td>
        <td>
            <a href="edit.php?id={$mascota->id}">
                Editar
            </a>
        </td>
        <td>
            <a href="delete.php?id={$mascota->id}">
                Eliminar
            </a>
        </td>
    </tr>
html;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Adoptme</title>
  <!-- <link rel="stylesheet" href="adoptme.css"> -->
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
  <h1>Adoptme <i class="fas fa-paw"></i></h1> 

  <table>
    <thead>
      <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Sexo</th>
        <th>Provincia</th>
        <th>Color</th>
        <th>Peso</th>
        <th>Tamaño</th>
        <th colspan="2">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?=$mascotas_list_html?>
    </tbody>
  </table>
  <br />
  <button type="button" class="open-tooltip"  onclick="location.href='new.php'">Añadir Mascota</button>
  <footer>
    <div class="container">
      <p>Adoptme &copy; 2023 Todos los derechos reservados
        Francisco Manuel Cabrera Cañete
        
      </p>
    </div>
  </footer>
</body>
</html>
