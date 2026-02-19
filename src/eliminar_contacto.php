<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto eliminado</title>
</head>
<body>
<?php
//Importo los archivos necesarios
require_once dirname(__DIR__)."/html/modelo/Contacto.php";
require_once dirname(__DIR__)."/html/utils.php";
require_once dirname(__DIR__)."/html/config.php";

$array_errores = [];

try {
    //Valido el id y si no hay ningún error, llamo a la función de eliminar de la clase contacto
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = validarID($array_errores, $_POST["id"], $pdo);
        
        if(is_bool($id)){
            throw new Exception ("Error");
        }else{
            Contacto::eliminar($pdo);
        }
    }else{
        header("Location: index.php");
    }    

} catch (Exception $e) {
    foreach ($array_errores as $error){
        echo $error . "<br>";
    }    
    echo "Error en la inserción de datos: " . $e->getMessage();
}finally{
    $stmt = null;
    $pdo = null;
}
?>
    <br>
    <a href="/vista/eliminacion_contacto.html/">Volver</a>
</body>
</html>
