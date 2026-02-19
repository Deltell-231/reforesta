<?php
//Importamos lo necesario
require_once dirname(__DIR__)."/html/Ej3_conexion.php";

require_once dirname(__DIR__)."/html/modelo/Usuario.php";

try{
    //Si los datos se han insertado por "POST" recogemos los datos
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $usuarioInsertado = $_POST['usuarioInsertado'];

        $passwordInsertada = $_POST['passwordInsertada'];

        
        $passwordCifrada = hash('sha256',$passwordInsertada);

        $usuarioNuevo = new Usuario($usuarioInsertado, $passwordCifrada);

        $usuarioNuevo->aniadir($pdo);
    }
}
catch(Exception $e){
    echo $e->getMessage();
}

?>
