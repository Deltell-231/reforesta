<?php
    //Importo los archivos necesarios
    require_once dirname(__DIR__)."/config.php";

    /**
     * Contacto que se almacenara en la base de datos
     */
    class Contacto{
        private $id;
        private $name;
        private $email;
        private $phone;

        //Creo su constructor
        public function __construct($name, $email, $phone, $id = 0) {
            $this->id = $id;
            $this->name = $name;
            $this->email = $email;
            $this->phone = $phone;
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

        /**
         * Lista los contactos presentes en la base de datos.
         * 
         * Se listaran los contactos presentes en la base de datos y
         * una vez listados cerraremos la conexión con la base de datos.
         * 
         * @param string $pdo Conexión con la base de datos.
         * 
         * @return array $filas Array asociativo donde aparecen todos los 
         * contactos junto a sus valores.
         * 
         */
        public static function listar($pdo){
            try{
                $pdo->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $pdo->beginTransaction();

                $sql = "SELECT id, name, email, phone FROM contacto";

                $stmt = $pdo->prepare($sql);

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

        /**
         * Añado contactos nuevos a la base de datos
         * 
         * Se añadiran los contactos a la base de datos mediante
         * las inserción de los valores del contacto a través de
         * un formulario
         * 
         * @param string $pdo Conexión con la base de datos.
         */
        public function aniadir($pdo){
            try {
                $pdo->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $pdo->beginTransaction();

                $insercion = "INSERT INTO contacto (name, email, phone) VALUES (:name, :email, :phone)";
                $stmt = $pdo->prepare($insercion);

                $stmt->bindParam(':name', $this->name);
                $stmt->bindParam(':email', $this->email);
                $stmt->bindParam(':phone', $this->phone);
                $stmt->execute();

                $pdo->commit();

                echo "Contacto añadido correctamente";

            } catch (PDOException $e) {
                $pdo->rollback();
                echo "Error en la inserción de datos: " . $e->getMessage();
            } 
            finally {
                $stmt = null;
                $pdo = null;
            }
        }

        /**
         * Borro un contacto existente en la base de datos
         * 
         * Se borrará el contacto de la base de datos que corresponda
         * al id que se inserte
         * 
         * @param string $pdo Conexión con la base de datos.
         */        
        public static function eliminar($pdo){
            try {
                $pdo->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $insercion = "DELETE FROM contacto WHERE id = :id";
                $stmt = $pdo->prepare($insercion);

                $stmt->bindParam(':id', $_REQUEST['id']);

                $stmt->execute();

                $pdo->commit();

                echo "Contacto eliminado correctamente";
                
            } catch (PDOException $e) {
                $pdo->rollback();
                echo "Error en la inserción de datos: " . $e->getMessage();
            }
            finally {
                $stmt = null;
                $pdo = null;
            }
        }

        /**
         * Modifico un contacto existente en la base de datos
         * 
         * Se modificará el contacto de la base de datos que corresponda
         * al id que se inserte
         * 
         * @param string $pdo Conexión con la base de datos.
         */          
        public function modificar($pdo){
            try{
            $pdo->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $pdo->beginTransaction();

            $modificar = "UPDATE contacto SET name=:name, 'email'=:email, 'phone'=:phone WHERE 'id'=:id";

            $stmt = $pdo->prepare($modificar);

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':phone', $this->phone);

            $stmt->execute();

            $pdo->commit();

            }catch(PDOException $e){
                $pdo->rollback();
                echo "Error: " .$e->getMessage();
            }
            finally {
                $stmt = null;
                $pdo = null;
            }
        }
    }
?>