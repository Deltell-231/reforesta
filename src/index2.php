<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactos</title>
</head>
<body>
    <h1>Lista de contactos</h1>
    <?php
    //Importo los archivos necesarios
    require_once dirname(__DIR__)."/html/modelo/Contacto.php";
    require_once dirname(__DIR__)."/html/config.php";

    try {
        //Si hay contactos los listo, si no muestro un mensaje que diga que no hay usuarios
        $filas = Contacto::listar($pdo);

        if($filas) {
            foreach ($filas as $fila) {
                echo "ID: " . $fila["id"] . "<br>";
                echo "Nombre: " . $fila["name"] . "<br>";
                echo "Email: " . $fila["email"] . "<br>";
                echo "Número de teléfono: " . $fila["phone"] . "<br><br>";
            }
        }else{
            echo "No se ha encontrado ningun usuario. <br>";
        }
    }
    catch(PDOException $e) {
        echo "Error";
    }
    finally {
        $stmt = null;
        $pdo = null;
    }
?>
    <a href="/vista/nuevo_contacto.html/">Añadir un nuevo contacto</a><br>
    <a href="/vista/modificacion_contacto.html">Modificar un contacto</a><br>
    <a href="/vista/eliminacion_contacto.html/">Eliminar un contacto</a>
</body>
</html>
