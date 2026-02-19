<?php
$host = "proyecto_docker_compose-db-1";
$usuario = "adrianD";
$password = "adrian";
$nombreBD = "ejercicios_6_PDO";

try {
    //Realizo la conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$nombreBD;charset=utf8", $usuario, $password);


} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>