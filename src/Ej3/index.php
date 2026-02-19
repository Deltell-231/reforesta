<?php

session_start();

if (isset($_SESSION['usuario'])) {
    header('Location: main.php');
    
}

?>

<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action='Ej3_main.php' method='post'>
        <label for='usuario'>Usuario:</label><br />
        <input type='text' name='usuario' id='usuario' maxlength="50" /><br />
        <label for='password'>Contraseña:</label><br />
        <input type='password' name='password' id='password' maxlength="50" /><br />
        <input type='submit' name='enviar' value='Enviar' />
    </form>
    <br>
    <a href="/registro.html">Registrar Usuario</a>
</body>
</html>