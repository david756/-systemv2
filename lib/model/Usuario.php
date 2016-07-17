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
    //estado usuario
    private $estado;
    //privilegios del usuario (mesero,cajero ,admin,etc)
    private $privilegios;

    /**
     * Metodo constructor de la clase Usuario
     * @param type $id
     * @param type $nombre
     * @param type $apellido
     * @param type $usuario
     * @param type $contrasena
     * @param type $genero
     * @param type $telefono
     * @param type $estado
     * @param type $privilegios
     */
    function Usuario($id = "def", $nombre = "def", $apellido = "def", $usuario = "def", $contrasena = "def", $genero = "def", $telefono = "def",$estado = "def", $privilegios = "def") {

        $this->idUsuario = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->usuario = $usuario;
        $this->clave = $contrasena;
        $this->genero = $genero;
        $this->telefono = $telefono;
        $this->estado = $estado;
        $this->privilegios = $privilegios;
    }

    /**
     * Obtener Usuario
     * @return Usuario
     */
    function getUsuario() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from usuarios where id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idUsuario);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();

        $userPriv = new Usuario($result['id']);
        $privilegios = $userPriv->searchPrivilegios();
        $resultado = New Usuario($result['id'], $result['nombre'], $result['apellido'], $result['telefono'],$result['fk_estado'], $result['genero'], $result['usuario'], $result['clave'], $privilegios);
        return $resultado;
    }
    
    /**
     * Obtener Usuario con user y clave para luego validar
     * @return Usuario
     */
    function getUsuarioClave() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from usuarios where usuario=? and clave=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->usuario);
        $stmt->bindParam(2, $this->clave);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        if (!empty($result)){
            $userPriv = new Usuario($result['id']);
            $privilegios = $userPriv->searchPrivilegios();
            $resultado = New Usuario($result['id'], $result['nombre'], $result['apellido'], 
            $result['telefono'],$result['fk_estado'], $result['genero'], 
            $result['usuario'], $result['clave'], $privilegios);
            return $resultado;
        }
        else {
            return null;
        }
        
    }

    /**
     * Metodo devuelve un array con la lista de todos los usuarios
     * @return Array <Usuario>
     */
    function getUsuarios() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from usuarios";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }

    /**
     * Busca en la base de datos los privilegios de un usuario con id $id
     * @param type $id
     * @return Array[0-Admin,1-cajero,2-mesero,3-cocinero,4inventario] Privilegios. 
     */
    function searchPrivilegios() {

        require_once "database.php";
        $pdo = Database::connect();
        //1-id del usuario,2-true si es admin o false si no lo es,3-privilegios.
        //1-cajero,2-mesero,3-cocinero,4inventario.
        $query = "SELECT e.id,e.admin,p.id FROM usuarios e "
                . "left JOIN perfil_empleados pe on e.id=pe.fk_empleado"
                . " left JOIN perfiles p on pe.fk_perfil=p.id where e.id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idUsuario);
        $stmt->execute();
        $result = $stmt->fetchAll();
        Database::disconnect();
        //array de privilegios
        //0-Admin,1-cajero,2-mesero,3-cocinero,4inventario.
        $privilegios =array(0, 0, 0, 0, 0);

        if (empty($result)) {
            return $privilegios;
        } else {
            if ($result[0][1] == 1) {
                $privilegios[0] = 1;
                return $privilegios;
            } else {
                foreach ($result as $r) {
                    $privilegios[$r[2]] = 1;
                }
                return $privilegios;
            }
        }
    }

    /**
     * @param type $privilegios : Array (5) : 
     * 0-Admin,1-cajero,2-mesero,3-cocinero,4inventario
     * posicion 0 reservado para admin 0=no , 1=si
     * posicion 1-4 para otros perfiles
     * @return True si se crean con exito, String error, si hay error
     */
    function createPrivilegios($privilegios) {
        $estado = false;
        if (is_null($privilegios) || $privilegios == "def") {
            $this->privilegios = "def";
            return 1;
        } else {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "update usuarios set admin = ? where id =" . $this->idUsuario;
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $privilegios[0]);
            if (!$stmt->execute()) {
                Database::disconnect();
                $estado = "*1* Error : actualizando privilegio";
                return $estado;
            }
            /*
             * borrando los perfiles del usuario para crear nuevos.
             */
            $query = "DELETE FROM perfil_empleados WHERE  fk_empleado=?";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->idUsuario);
            $stmt->execute();

            $i = 0;
            foreach ($privilegios as $list) {
                //solo si i != 0 , la primera posicion es de admin , no interesa aca.
                //list = 1 , si cuenta con el privilegio
                if ($i != 0 && $list==1) {                    
                        $query = "INSERT INTO perfil_empleados(fk_perfil,fk_empleado) VALUES (?, ?)";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(1, $i);
                        $stmt->bindParam(2, $this->idUsuario);
                        $resultado = $stmt->execute();

                        if (!$resultado) {
                            $estado = "*2* error Creando privilegios";
                            Database::disconnect();
                            return $estado;
                        }                   
                }
                $i++;
            }
            Database::disconnect();
            return 1;
        }
    }

    /**
     * Metodo que verifica si se han hecho atenciones en la usuario
     * True: solo si hay atenciones en la usuario
     * False: solo si no hay atenciones en la usuario
     */
    function usuarioActivo() {
        require_once "database.php";
        $estado = true;
        $pdo = Database::connect();
        $query = "SELECT * FROM usuarios e INNER JOIN empl_atencion ea on e.id=ea.fk_empleado "
                . "LEFT JOIN atenciones a on e.id=a.fk_cajero"
                . " LEFT JOIN inventarios i on e.id=i.fk_empleado WHERE e.id=" . $this->idUsuario;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        Database::disconnect();
        //si no hay atenciones en la usuario , estado =false        
        if (empty($result)) {
            $estado = false;
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
            $query = "insert into usuarios set nombre = ?,apellido = ?,usuario = ?,"
                    . "clave = ?,genero = ?,telefono = ?,fk_estado = ?";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->nombre);
            $stmt->bindParam(2, $this->apellido);
            $stmt->bindParam(3, $this->usuario);
            $stmt->bindParam(4, $this->clave);
            $stmt->bindParam(5, $this->genero);
            $stmt->bindParam(6, $this->telefono);
            $stmt->bindParam(7, $this->estado);
            $resultado = $stmt->execute();
            $this->idUsuario = $pdo->lastInsertId();

            $usuario = new Usuario($this->idUsuario, $this->nombre, $this->apellido, $this->usuario, $this->clave, $this->genero, $this->telefono,$this->estado, $this->privilegios);
            Database::disconnect();

            if ($resultado) {
                $priv = $this->createPrivilegios($this->privilegios);
                if ($priv == 1) {
                    return $usuario;
                } else {
                    $this->deleteUsuario();
                    return "*1* Error al tratar de crear Usuario: Error Privilegios ";
                }
            } else {
                return "*2* Error al tratar de crear Usuario";
            }
        } catch (Exception $e) {
            echo "*3* Error al tratar de crear Usuario:  " . $e->getMessage();
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
            $query = "update usuarios set nombre = ?,apellido = ?,clave = ?,genero = ?,telefono = ?,fk_estado = ? where id =" . $this->idUsuario;
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->nombre);
            $stmt->bindParam(2, $this->apellido);
            $stmt->bindParam(3, $this->clave);
            $stmt->bindParam(4, $this->genero);
            $stmt->bindParam(5, $this->telefono);
            $stmt->bindParam(6, $this->estado);
            Database::disconnect();
            if ($stmt->execute()) {
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
                $query = "delete from usuarios where id =?";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(1, $this->idUsuario);
                Database::disconnect();
                if ($stmt->execute()) {
                    return "exito";
                } else {
                    return "*1* Error al tratar de eliminar Usuario";
                }
            } catch (Exception $e) {
                echo "*2* Error al tratar de eliminar Usuario:  " . $e->getMessage();
            }
        } else {
            return "*3* Error al tratar de eliminar Usuario: El usuario ya esta activo";
        }
    }
    
    function crearSesion($user){
        try {
                require_once "sesion.php";
                $sesion = Sesion::crearSesion($user);
                if ($sesion=="Exito") {
                    return "Exito";
                }
        else { 
            return "*2* Error al tratar de crear sesion:  " . $sesion;
        }
        } catch (Exception $e) {
                echo "*3* Error al tratar de crear sesion:  " . $e->getMessage();
        }
    }
    
    function cerrarSesion(){
        try {
                require_once "sesion.php";
                $sesion = Sesion::cerrarSesion();
                if ($sesion=="Exito") {
                    return "Exito";
                }
        else { 
            return "*1* Error al tratar de crear sesion:  " . $sesion;
        }
        } catch (Exception $e) {
                echo "*2* Error al tratar de crear sesion:  " . $e->getMessage();
        }
    }
    
    function getSesion(){
        try {
                require_once "sesion.php";
                $usuario = Sesion::getSesion();
                if ($usuario!=null) {
                    return $usuario;
                }
                else { 
                    return "*1* Error : no existe Sesion";
                }
        } catch (Exception $e) {
                echo "*2* Error al tratar de obtener sesion:  " . $e->getMessage();
        }
    }

    /**
     * Metodo que obtiene el id de un usuario
     * @return String
     */
    function getIdUsuario() {
        return $this->idUsuario;
    }

    /**
     * Metodo que obtiene el nombre de un usuario
     * @return String
     */
    function getNombre() {
        return $this->nombre;
    }

    /**
     * Metodo que obtiene el apellido de un usuario
     * @return String
     */
    function getApellido() {
        return $this->apellido;
    }

    /**
     * Metodo que obtiene la contrasena de un usuario
     * @return String
     */
    function getContrasena() {
        return $this->clave;
    }

    /**
     * Metodo que obtiene el genero de un usuario
     * @return String
     */
    function getGenero() {
        return $this->genero;
    }

    /**
     * Metodo que obtiene el telefono de un usuario
     * @return String
     */
    function getTelefono() {
        return $this->telefono;
    }
    
    /**
     * Metodo que obtiene el estado de un usuario
     * @return String
     */
    function getEstado() {
        return $this->estado;
    }

    /**
     * Metodo que obtiene los privilegios de un usuario
     * @return String
     */
    function getPrivilegios() {
        return $this->privilegios;
    }

    /**
     * Metodo que obtiene el nombre de usuario de un usuario
     * @return String
     */
    function getUserName() {
        return $this->usuario;
    }

    /**
     * Metdo set nombre de usuario de la clase usuario
     * @param type $userNam
     */
    function setUserName($userName) {
        $this->usuario = $userName;
    }

    /**
     * Metdo set id de usuario de la clase usuario
     * @param type $idUsuario
     */
    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    /**
     * Metdo set nombre  de la clase usuario
     * @param type $nombre
     */
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /**
     * Metdo set apellido de la clase usuario
     * @param type $apellido
     */
    function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    /**
     * Metdo set contrasena de la clase usuario
     * @param type $contrasena
     */
    function setContrasena($contrasena) {
        $this->clave = $contrasena;
    }

    /**
     * Metdo set genero de la clase usuario
     * @param type $genero
     */
    function setGenero($genero) {
        $this->genero = $genero;
    }

    /**
     * Metdo set telefono de la clase usuario
     * @param type $telefono
     */
    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    
    /**
     * Metdo set estado de la clase usuario
     * @param type $estado
     */
    function setEstado($estado) {
        $this->telefono = $estado;
    }

    /**
     * Metdo set privilegios de la clase usuario
     * @param type $privilegios
     */
    function setPrivilegios($privilegios) {
        $this->privilegios = $privilegios;
    }

}
