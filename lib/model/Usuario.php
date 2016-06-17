<?php
/**
 * Clase Usuario
 * @author David
 */
class Usuario {
    
    //Id de usuario
    private $idUsuario;
    //nombre de usuario
    private $nombre;
    //apellido de usuario
    private $apellido;
    //usuario de acceso del usuario
    private $usuario;
    //contrasena del usuario
    private $clave;
    //genero del usuario
    private $genero;
    //telefono usuario
    private $telefono;
    //privilegios del usuario (mesero,cajero ,admin,etc)
    private $privilegios;
    
    
    
    
   /**
    * Metodo constructor de la clase Usuario
    * @param type $idUsuario
    * @param type $descripcion
    */
    function Usuario($id="def",$nombre="def",$apellido="def",$usuario="def",
              $contrasena="def",$genero="def",$telefono="def",$privilegios="def") {
        
              $this->idUsuario =$id;
              $this->nombre =$nombre;
              $this->apellido = $apellido;
              $this->usuario =$usuario;
              $this->clave =$contrasena;
              $this->genero =$genero;
              $this->telefono =$telefono;
              $this->privilegios =$privilegios;
    }
    /**
     * 
     * @param type $id
     * @return Usuario
     */    
    function getUsuario(){
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from empleados where id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idUsuario);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect(); 
        $resultado= New Usuario($result['id'], $result['nombre'],$result['apellido'],
                $result['telefono'],$result['genero'],$result['usuario'],$result['clave']);
        return $resultado;
    }
    /**
     * Metodo devuelve un array con la lista de todos los usuarios
     * @return Array <Usuario>
     */
    function getUsuarios() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from empleados";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }
      /**
      * Metodo que verifica si se han hecho atenciones en la usuario
       * True: solo si hay atenciones en la usuario
       * False: solo si no hay atenciones en la usuario
      */
     function usuarioActivo(){         
        require_once "database.php";
        $estado=true;
        $pdo = Database::connect();
        $query = "SELECT * FROM empleados e INNER JOIN empl_atencion ea on e.id=ea.fk_empleado "
                . "LEFT JOIN atenciones a on e.id=a.fk_cajero"
                . " LEFT JOIN inventarios i on e.id=i.fk_empleado WHERE e.id=".$this->idUsuario;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        Database::disconnect();
        //si no hay atenciones en la usuario , estado =false        
        if (empty($result)) {
            $estado=false;
        }
        return $estado;         
     }
    
    /**
     * Metodo que almacena el usuario en la base de datos
     * @return id del usuario creado
     */
    function createUsuario() {
        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "insert into empleados set nombre = ?,apellido = ?,usuario = ?,clave = ?,genero = ?,telefono = ?";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->nombre);
            $stmt->bindParam(2, $this->apellido);
            $stmt->bindParam(3, $this->usuario);
            $stmt->bindParam(4, $this->clave);
            $stmt->bindParam(5, $this->genero);
            $stmt->bindParam(6, $this->telefono);
            
            
            $resultado=$stmt->execute();
            $id = $pdo->lastInsertId();
            Database::disconnect();
            if ($resultado) {
                return $id;
            } else {
                return "*1* Error al tratar de crear Usuario:  ".$resultado;
            }           
            
        } catch (Exception $e) {
            echo "*2* Error al tratar de crear Usuario:  " . $e->getMessage();
        }
    }
    
    /**
     * Metodo que actualiza la usuario en la base de datos
     * @return string Resultado
     */
    function updateUsuario() {
      
            try {
                 require_once "database.php";
                 $pdo = Database::connect();
                 $query = "update empleados set nombre = ?,apellido = ?,clave = ?,genero = ?,telefono = ? where id =".$this->idUsuario;
                 $stmt = $pdo->prepare($query);
                 $stmt->bindParam(1, $this->nombre);
                 $stmt->bindParam(2, $this->apellido);
                 $stmt->bindParam(3, $this->clave);
                 $stmt->bindParam(4, $this->genero);
                 $stmt->bindParam(5, $this->telefono);
                 Database::disconnect();
                         if ($stmt->execute()){                        
                             return "exito";
                         } else {
                             return "*1* Error al tratar de actualizar Usuario";
                         }            
             } catch (Exception $e) {
                 echo "*2* Error al tratar de actualizar Usuario: " . $e->getMessage();
             }
       }

    /**
     * Metodo que Elimina usuario de la base de datos
     * @return string Resultado
     */
    function deleteUsuario() {  
        if (!$this->usuarioActivo()) {
            try {
            require_once "database.php";          
                    $pdo = Database::connect();            
                    $query = "delete from empleados where id =?";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(1, $this->idUsuario);
                    Database::disconnect();
                    if ($stmt->execute()){                        
                        return "exito";
                    } else {
                        return "*1* Error al tratar de eliminar Usuario";
                    } 
            } catch (Exception $e) {
                echo "*2* Error al tratar de eliminar Usuario:  " . $e->getMessage();
            }
        }
        else {
            return "*3* Error al tratar de eliminar Usuario: El usuario ya esta activo";
        }
    }
        
    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellido() {
        return $this->apellido;
    }

    function getContrasena() {
        return $this->clave;
    }

    function getGenero() {
        return $this->genero;
    }

    function getTelefono() {
        return $this->telefono;
    }

    function getPrivilegios() {
        return $this->privilegios;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    function setContrasena($contrasena) {
        $this->clave = $contrasena;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setPrivilegios($privilegios) {
        $this->privilegios = $privilegios;
    }


}
