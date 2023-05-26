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

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $mascotaId = $_GET['id'];

    // Realizar la solicitud DELETE a la API mediante AJAX y jQuery
    $url = 'http://localhost:3000/mascotas/' . $mascotaId;

    // Incluir la biblioteca jQuery
    echo '<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>';

    // Realizar la solicitud DELETE utilizando AJAX y jQuery
    echo <<<HTML
    <script>
        $(document).ready(function() {
            $.ajax({
                url: '$url',
                type: 'DELETE',
                success: function(response) {
                    // Mascota eliminada exitosamente, redirigir a la página principal
                    window.location.href = 'index.php';
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 404) {
                        // La mascota no fue encontrada
                        alert('Mascota no encontrada');
                    } else {
                        // Error al eliminar la mascota
                        alert('Error al eliminar la mascota');
                    }
                }
            });
        });
    </script>
HTML;
} else {
    // No se proporcionó un ID de mascota válido
    echo 'ID de mascota no válido';
}
?>
