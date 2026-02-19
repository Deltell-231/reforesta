<?php
//Importo los archivos necesarios
    require_once dirname(__DIR__)."/html/modelo/Contacto.php";
    require_once dirname(__DIR__)."/html/config.php";

    /**
    * Valido el ID que se inserta por formulario
    * 
    * Valido el ID insertado por formulario con el fin de que
    * sea correcto o exista
    * 
    * @param string $pdo Conexión con la base de datos.
    * @param array $array_errores Array con los errores que aparezcan
    * @param $valor El valor que se inserta, en este caso el ID
    * 
    * @return bool Devuelve un booleano en caso de haber un error
    * @return int $idValido En caso de estar correcto, devuelvo el id
    * 
    */
    function validarID(&$array_errores,$valor, $pdo){
    if (isset($valor) && !empty($valor) && is_numeric($valor)){
        $idValidado = htmlspecialchars(stripslashes(trim($valor)));
    }else{
        array_push($array_errores, "El id no es correcto");
        return false;
    }

    $lista = Contacto::listar($pdo);

    $comprobacion = false;

    foreach ($lista as $contacto){
            if($contacto["id"] == $idValidado){
                $comprobacion = true;
                return $idValidado;
            }
    }
    if($comprobacion == false){
        array_push($array_errores, "No existe ningún contacto con ese id");
        return false;
    }
    }

    /**
    * Valido el nombre que se inserta por formulario
    * 
    * Valido el nombre insertado por formulario con el fin de que
    * sea correcto
    * 
    * @param array $array_errores Array con los errores que aparezcan
    * @param $valor El valor que se inserta, en este caso el nombre
    * 
    * @return bool Devuelve un booleano en caso de haber un error
    * @return int $nombreValido En caso de estar correcto, devuelvo el nombre
    * 
    */
    function validarNombre(&$array_errores, $valor){
        if (isset($valor) && !empty($valor) && is_string($valor)){
            $nombreValidado = htmlspecialchars(stripslashes(trim($valor)));
            return $nombreValidado;
        }else{
            array_push($array_errores, "El nombre no es correcto");
            return false;
            
        }
    }

    /**
    * Valido el email que se inserta por formulario
    * 
    * Valido el email insertado por formulario con el fin de que
    * sea correcto o exista
    * 
    * @param string $pdo Conexión con la base de datos.
    * @param array $array_errores Array con los errores que aparezcan
    * @param $valor El valor que se inserta, en este caso el email
    * 
    * @return bool Devuelve un booleano en caso de haber un error
    * @return int $emailValido En caso de estar correcto, devuelvo el email
    * 
    */
    function validarEmail(&$array_errores, $valor,$pdo){
        if (isset($valor) && !empty($valor) && filter_var($valor, FILTER_VALIDATE_EMAIL)){
            $emailValidado = htmlspecialchars(stripslashes(trim($valor)));
            return $emailValidado;
        }
        else{
            array_push($array_errores, "El email no es correcto");
            return false;
        }

        $filas = Contacto::listar($pdo);
        $comprobacion = false;
        foreach ($filas as $fila){
            if($fila["email"] != $emailValidado){
                $comprobacion = true;
                return $emailValidado;
            }
        }
        if($comprobacion == false){
            array_push($array_errores, "El email ya existe");
            return false;
        }
    }

    /**
    * Valido el teléfono que se inserta por formulario
    * 
    * Valido el teléfono insertado por formulario con el fin de que
    * sea correcto
    * 
    * @param array $array_errores Array con los errores que aparezcan
    * @param $valor El valor que se inserta, en este caso el teléfono
    * 
    * @return bool Devuelve un booleano en caso de haber un error
    * @return int $telefonoValido En caso de estar correcto, devuelvo el teléfono
    * 
    */
    function validarTelefono(&$array_errores, $valor){
        $expresionRegular = "/^[0-9]{9}$/";
        if (isset($valor) && !empty($valor) && is_numeric($valor) && preg_match($expresionRegular, $valor)){
            $telefonoValidado = htmlspecialchars(stripslashes(trim($valor)));
            return $telefonoValidado;
        }else{
            array_push($array_errores, "El teléfono no es correcto");
            return false;
        }
    }

?>