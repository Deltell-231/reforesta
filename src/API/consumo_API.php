<?php
    $numero = json_decode(file_get_contents("https://api.openweathermap.org/data/2.5/weather?lat=44.34&lon=10.99&appid=7bc4250dc4c2abfedea6c778208cf9b6"));

    var_dump($numero);
?>