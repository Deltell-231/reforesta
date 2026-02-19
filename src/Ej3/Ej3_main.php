<?php

//Iniciamos las sesiones
    session_start();

    //Creamos un array con los usuarios que existen
    require_once dirname(__DIR__)."/html/Ej3_conexion.php";
    require_once dirname(__DIR__)."/html/modelo/Usuario.php";


    //Creamos una función para validar los datos que se inserten en el formulario
    function validarDato($dato){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(isset($dato) && !empty($dato)){
                $datoValidado = htmlspecialchars(stripslashes(trim($dato)));
                return $datoValidado;
            }
            else{
                return false;
            }
        }
    }

    //Validamos los campos de usuario y contraseña
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $usuarioCuenta = validarDato($usuario);
    $passwordCuenta = validarDato($password);  
    
    $passwordCifrada = hash('sha256',$passwordCuenta);

    //Si la contraseña y el usuario son correctos, creo un usuario y llamo
    //a la función de mostrar el usuario que tenga ese nombre y contraseña, 
    //presente en la clase de usuario
    if($usuarioCuenta && $passwordCifrada){
        $usuario = new Usuario($usuarioCuenta, $passwordCifrada);

        $fila = $usuario->listar($pdo);

        //Si existe el usuario, creo una sesion con ese usuario
        if($fila) {
            $_SESSION['usuario'] = $usuarioCuenta;
        }else{
            header('location: index.php');
        }
    }else{
        header('location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="es-ES">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Listado de productos</title>
</head>
<body>
    <h1>Bienvenido <?=$_SESSION['usuario']?><h1>
    <p>Pulse <a href="./logout.php">aquí</a> para salir</p>
    <p>Volver al <a href="#">inicio</a></p>
    <h2>Listado de productos</h2>
    <ul>
        <li>Habichuelas</li>
        <li>Pepinos</li>
        <li>Atún</li>
    </ul>
</body>
</html>
