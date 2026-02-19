<?php
    //Iniciamos las sesiones
    session_start();

    //Si existe una sesion de ese usuario, la eliminamos
    if (isset($_SESSION["usuario"])) {
        unset($_SESSION['usuario']);
    }

    //Destruimos la sesion
    session_destroy();

    //Enviamos al usuario de vuelva al apartado de login
    header("location:index.php");
?>