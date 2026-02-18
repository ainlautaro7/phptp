<?php
// Iniciar la sesión
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Guardar los datos en la sesión
    $_SESSION['nombre'] = htmlspecialchars($_POST['nombre']);
    $_SESSION['correo'] = htmlspecialchars($_POST['correo']);
    
    // Mostrar mensaje de éxito
    echo "<h2>Formulario enviado correctamente.</h2>";
} 

// Verificar si los datos están en la sesión y mostrarlos
if (isset($_SESSION['nombre']) && isset($_SESSION['correo'])) {
    echo "<h2>Datos guardados en la sesión:</h2>";
    echo "Nombre: " . $_SESSION['nombre'] . "<br>";
    echo "Correo: " . $_SESSION['correo'] . "<br>";
} else {
    // Si no hay datos en la sesión, mostrar el formulario
?>
    <h2>Formulario de contacto</h2>
    <form action="formulario.php" method="POST">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br><br>
        
        <label for="correo">Correo electrónico:</label><br>
        <input type="email" id="correo" name="correo" required><br><br>
        
        <input type="submit" value="Enviar">
    </form>
<?php
}
?>
