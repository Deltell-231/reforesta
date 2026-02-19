<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto añadido</title>
</head>
<body>
<?php
//Importo los archivos necesarios
require_once dirname(__DIR__)."/html/modelo/Contacto.php";
require_once dirname(__DIR__)."/html/utils.php";
require_once dirname(__DIR__)."/html/config.php";

$array_errores = [];

try {
    //Valido el id, nombre, email y telefono y si no hay ningún error, creo un contacto y llamo a su función de modificar
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = validarID($array_errores, $_POST["id"], $pdo);
        $nombre = validarNombre($array_errores, $_POST["name"]);
        $email = validarEmail($array_errores, $_POST["email"], $pdo);
        $telefono = validarTelefono($array_errores, $_POST["phone"]);

        if(is_bool($id) || is_bool($nombre) || is_bool($email) || is_bool($telefono)){
            throw new Exception ("Error");
        }else{
            $usuario = new Contacto ($nombre, $email, $telefono, $id);

            $usuario->modificar($pdo);
        }
    }
} catch (Exception $e) {
    foreach ($array_errores as $error){
        echo $error . "<br>";
    }
    echo "Error en la inserción de datos: " . $e->getMessage();
} 
finally{
    $stmt = null;
    $pdo = null;
}
?>
    <br>
    <a href="./vista/modificacion_contacto.html">Volver</a>
</body>
</html>