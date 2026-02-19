<?php
    require_once dirname(__DIR__)."/Ej3_conexion.php";

    class Usuario{
        private $id;
        private $nombre;
        private $contrasenia;

        public function __construct($nombre, $contrasenia, $id = 0) {
            $this->id = $id;
            $this->nombre = $nombre;
            $this->contrasenia = $contrasenia;
        }

        /**
         * Hago un getter mágico que servirá para todos los valores del contacto
         * 
         * @param string $propiedad El valor del contacto
         * 
         * @return string $propiedad El valor del contacto
         */
        public function __get($propiedad){
            if(property_exists($this, $propiedad)){
                $this->$propiedad;
            }
        }

        /**
         * Hago un setter mágico que servirá para todos los valores del contacto
         * 
         * @param string $propiedad El valor del contacto.
         * @value string $value El valor que insertar el usuario para cambiar 
         * el valor de contacto
         * 
         * @return string $propiedad El valor del contacto
         */
        public function __set($propiedad, $value){
            if(property_exists($this, $propiedad)){
                $this->$propiedad = $value;
            }
        }

        public function listar($pdo){
            try{
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $pdo->beginTransaction();

                $sql = "SELECT * FROM usuarios WHERE nombre=:nombre && contrasenia=:contrasenia";

                $stmt = $pdo->prepare($sql);

                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->bindParam(':contrasenia', $this->contrasenia);

                $stmt->execute();

                $filas = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return $filas;
            }catch(PDOException $e){
                echo "Error: ". $e->getMessage();
            }
            finally {
                $stmt = null;
                $pdo = null;
            }
        }

        public function aniadir($pdo){
            try {
                $pdo->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $pdo->beginTransaction();

                $insercion = "INSERT INTO usuarios (nombre, contrasenia) VALUES (:nombre, :contrasenia)";
                $stmt = $pdo->prepare($insercion);

                $stmt->bindParam(':nombre', $this->nombre);
                $stmt->bindParam(':contrasenia', $this->contrasenia);
                $stmt->execute();

                $pdo->commit();

                echo "Usuario añadido correctamente";

            } catch (PDOException $e) {
                $pdo->rollback();
                echo "Error en la inserción de datos: " . $e->getMessage();
            } 
            finally {
                $stmt = null;
                $pdo = null;
            }
        }
    }