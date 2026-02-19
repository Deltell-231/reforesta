<?php
    $personaje = file_get_contents("https://thesimpsonsapi.com/api/characters/1");
    $personajeJSON = json_decode($personaje);

?>
<!DOCTYPE html>
<html lang="es-ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personajes "The Simpsons"</title>
</head>
<body>
    <h1>Información sobre el personaje Homer Simpson</h1>
	<h2>Datos en bruto en formato JSON:</h2>
	<p><?= $personaje?></p>
	<hr>
	<h2>Datos en un objeto JSON:</h2>
	<p><?= var_dump($personajeJSON)?></p>
	<hr>
	<h2>Información formateada:</h2>
	<p>
		Nombre: <?=$personajeJSON->name?><br>
		Género: <?=$personajeJSON->gender?><br>
		Edad: <?=$personajeJSON->age?>años<br>
        Estado: <?=$personajeJSON->status?>
	</p>
</body>
</html>