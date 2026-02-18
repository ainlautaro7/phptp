<?php
// Verificar si el usuario ha hecho clic en "Cerrar sesión"
if (isset($_POST['cerrar_sesion'])) {
    // Eliminar la cookie estableciendo su expiración en el pasado
    setcookie("nombre_usuario", "", time() - 3600, "/"); // 3600 segundos = 1 hora
    
    // Redirigir al inicio para restablecer la página (usando la ruta completa del archivo actual)
    header("Location: " . $_SERVER['PHP_SELF']); // Esto garantiza que se redirija a la misma página
    exit();
}

// Verificar si la cookie ya está establecida
if (isset($_COOKIE['nombre_usuario']) && $_COOKIE['nombre_usuario'] !== '') {
    // Si la cookie está configurada, mostrar el mensaje con el nombre almacenado
    echo "<h2>Hola, " . $_COOKIE['nombre_usuario'] . "! Bienvenido de nuevo.</h2>";
    
    // Mostrar el botón para cerrar sesión
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> <!-- Dirección relativa -->
        <input type="submit" name="cerrar_sesion" value="Cerrar sesión">
    </form>
    <?php
} else {
    // Si no existe la cookie, mostrar el formulario para ingresar el nombre
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener el nombre desde el formulario
        $nombre_usuario = htmlspecialchars($_POST['nombre_usuario']);
        
        // Establecer la cookie que expirará en 30 días
        setcookie("nombre_usuario", $nombre_usuario, time() + (86400 * 30), "/"); // 86400 = 1 día
        
        // Redirigir para mostrar el mensaje con el nombre de usuario
        header("Location: " . $_SERVER['PHP_SELF']); // Redirigir al mismo archivo
        exit();
    } else {
        // Mostrar el formulario si la cookie no está establecida
        ?>
        <h2>Formulario de ingreso de nombre</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST"> <!-- Dirección relativa -->
            <label for="nombre_usuario">Nombre de usuario:</label><br>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required><br><br>
            <input type="submit" value="Guardar nombre">
        </form>
        <?php
    }
}
?>
