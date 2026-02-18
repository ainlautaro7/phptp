<?php
// Iniciar la sesión
session_start();

// Verificar si el usuario ha hecho clic en "Cerrar sesión"
if (isset($_POST['cerrar_sesion'])) {
    // Eliminar todas las variables de sesión
    session_unset();

    // Destruir la sesión
    session_destroy();

    // Redirigir al inicio del archivo para que se restablezca el estado (el formulario)
    header("Location: ". $_SERVER['PHP_SELF']);
    exit();
}

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['nombre_usuario'])) {
    // Si la sesión está activa, mostrar el mensaje de bienvenida
    echo "<h2>Sesión iniciada, bienvenido " . $_SESSION['nombre_usuario'] . "!</h2>";
    
    // Mostrar el botón para cerrar sesión
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <input type="submit" name="cerrar_sesion" value="Cerrar sesión">
    </form>
    <?php
} else {
    // Si no hay sesión activa, mostrar el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener el nombre de usuario desde el formulario
        $nombre_usuario = htmlspecialchars($_POST['nombre_usuario']);
        
        // Guardar el nombre de usuario en la sesión
        $_SESSION['nombre_usuario'] = $nombre_usuario;
        
        // Mostrar un mensaje de bienvenida tras iniciar sesión
        echo "<h2>Sesión iniciada, bienvenido " . $_SESSION['nombre_usuario'] . "!</h2>";
        
        // Mostrar el botón para cerrar sesión
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <input type="submit" name="cerrar_sesion" value="Cerrar sesión">
        </form>
        <?php
    } else {
        // Formulario de inicio de sesión
        ?>
        <h2>Formulario de inicio de sesión</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <label for="nombre_usuario">Nombre de usuario:</label><br>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required><br><br>
            <input type="submit" value="Iniciar sesión">
        </form>
        <?php
    }
}
?>
