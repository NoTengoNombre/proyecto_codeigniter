<?php

class Modelo_usuarios extends CI_Model {

    /**
     * No necesita
     * $this->load->database
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

/////////////////////////////////////////////////////////////////////////////
///////////////////////// LOGIN /////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////

    /**
     * Consulta BD con AR
     * Obtiene los datos especificos de la BD
     * Para usarlos en el Controlador
     *
     * @param type $usr String
     * @param type $pass String
     * @return type ARRAY
     */
    public function check_login_modelo($usr, $pass) {
        // selecciono columna "nombre" , nombre usuario del form
        $this->db->where("nombre", $usr); // dato enviado al metodo check_login - Controlador
        // selecciono columna "password" , password del for  
        $this->db->where("password", $pass); // dato enviado al metodo check_login - Controlador
        // selecciona tabla usuarios para hacer la consulta
        //OBJETO
        $resultado = $this->db->get("usuarios"); // SELECT (*) FROM 'usuarios' where nombre like 'usr' and password like 'pass'
        //Objeto 'db' contiene total de filas
        if ($this->db->affected_rows() > 0) { // si hay +1 fila
            // $resultado - Objeto con todos los campos en forma de String
            // $fila - Columnas BD se sacan como objetos
            foreach ($resultado->result() as $fila) {//devuelve todos "elementos" en un array de objetos
                //$datos_usuario -> ARRAY Instanciado en este momento
                //"De todos los elementos del ARRAY selecciono las columnas idusr , tipousr"
// almaceno en el array $datos_usuario el objeto 'usuario_id' que es un String
                $datos_usuario['idusr'] = $fila->usuario_id;
// almaceno en el array $datos_usuario el objeto 'tipo' que es un String
                $datos_usuario['tipousr'] = $fila->tipo;
            }
        } else {

            $datos_usuario = null; // si no hay registro devuelve false
        }

        return $datos_usuario; //devuelve array de String o devuelve null
    }

/////////////////////////////////////////////////////////////////////////////
///////////////////////// USUARIOS //////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////

    /**
     * Obtener todos los usuarios de la BD
     * 
     * @return type Array "Objetos"
     */
    public function get_all_users() {

        $query = $this->db->get("usuarios"); // SELECT (*) FROM usuarios

        if ($query->num_rows() > 0) { // Si hay valores
            foreach ($query->result() as $fila) { // Obtengo ARRAY de OBJETOS
                $data[] = $fila; // Almaceno los 'OBJETOS' dentro de un ARRAY
            }
            return $data; // Devuelve 'ARRAY' de 'OBJETOS'
        }
    }

    /**
     * Obtener todos los usuarios de la BD
     * 
     * @return type Array "Objetos"
     */
    public function get_all_users_by_id($id) {

        $query = $this->db->get("usuarios"); // SELECT (*) FROM usuarios

        if ($query->num_rows() > 0) { // Si hay valores
            foreach ($query->result() as $fila) { // Obtengo ARRAY de OBJETOS
                $data[] = $fila; // Almaceno los 'OBJETOS' dentro de un ARRAY
            }
            return $data; // Devuelve 'ARRAY' de 'OBJETOS'
        }
    }

    /**
     * 
     * @param type $id
     * 
     * @return type
     */
    public function edit_usuario($id) {
//      $consulta = $this->db->query("SELECT * FROM usuario u inner join perfil p on u.per_id = p.per_id WHERE u.usu_id = $id");
//      $consulta = $this->db->query("SELECT * FROM usuarios u inner join documentos d on u.usuario_id = d.usuario_id WHERE u.usuario_id = '$id'");
        $consulta = $this->db->query("SELECT * FROM usuarios WHERE usuario_id = '$id'");
        return $consulta->result();
    }

    /**
     * Devuelve un array de objetos de la tabla
     * usuarios
     * 
     * @return type
     */
    public function show_usuarios() {
        $query = $this->db->get('usuarios'); // equivale a "SELECT * FROM usuario
        $query_result = $query->result(); // devuelve un array de objetos
        return $query_result;
    }

    /**
     * 
     * 
     * @param type $data
     * @return type array objetos
     */
    public function show_usuarios_id($data) {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('usuario_id', $data);

        $query = $this->db->get();
        $result = $query->result(); // devuelve un array de objetos

        return $result;
    }

    /**
     * 
     * Añade datos a la tabla usuarios
     * Incluye fotografia
     * 
     * @param type $usuario_id
     * @param type $nombre
     * @param type $apellidos
     * @param type $password
     * @param type $fotografia
     * @param type $telefono
     * @param type $email
     * @param type $tipo
     * 
     * @return string "error" o "ok"
     */
    public function add_user($tipo, $nombre, $apellidos, $password, $telefono, $email, $fotografia) {

//        $filas = $this->db->get('usuarios'); // Produce: SELECT * FROM usuarios
//        $usuario_id = $filas->num_rows();
//      var_dump($usuario_id);

        echo '<hr>';
        echo 'Final';
        echo '<hr>';

        $datos = array(
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'password' => $password,
            'email' => $email,
            'tipo' => $tipo,
            'fotografia' => $fotografia,
            'telefono' => $telefono);

        var_dump($datos);

//      Ejecuta la accion de insertar

        echo $this->db->insert('usuarios', $datos);
//      El objeto 'db' dice si tiene fila o no
        if ($this->db->affected_rows() == 1) {
            $r = "ok";
        } else {
            $r = "error";
        }
        return $r; // 
    }

    /**
     * Formulario Ajax y JQUERY
     * @param type $data
     * @return type
     */
    public function add_user_($data) {

        $filas = $this->db->get('usuarios'); // Produce: SELECT * FROM usuarios
        $usuario_id = $filas->num_rows();

        $data = array(
//            'usuario_id' => ++$usuario_id,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'password' => $password,
            'email' => $email,
            'tipo' => $tipo,
            'fotografia' => $fotografia,
            'telefono' => $telefono,
        );

        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function editUsuario($id) {
        $consulta = $this->db->query("SELECT * FROM usuarios u inner join documentos d on u.usuario_id = d.usuario_id WHERE u.usuario_id = $id");
        return $consulta->result();
    }

    /**
     * Utiliza el usuario_id para actualizar
     * los campos del usuario
     * 
     * @param type $usuario_id
     *      
     * @return string "error" o "ok"
     */
    public function update_user($usuario_id) {
        $datos = array(
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'password' => $password,
            'email' => $email,
            'tipo' => $tipo,
            'fotografia' => $fotografia,
            'telefono' => $telefono,
        );

        $this->db->where('usuario_id', $usuario_id);
        $this->update('usuarios', $datos);

        if ($this->db->affected_rows() == 1) {
            $r = "ok";
        } else {
            $r = "error";
        }
        return $r;
    }

    /**
     * 
     * @param type $id
     * @param type $data
     */
    public function update_usuarios_id($usuario_id, $data) {

        $data = array(
            'usuario_id' => $id,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'password' => $password,
            'fotografia' => $fotografia,
            'telefono' => $telefono,
            'email' => $email,
            'tipo' => $tipo);

        $this->db->where('usuario_id', $usuario_id);
        $this->db->update('usuarios', $data);
    }

    /**
     * 
     * @param type $usuario_id
     * @param type $nombre
     * @param type $apellidos
     * @param type $password
     * @param type $fotografia
     * @param type $telefono
     * @param type $email
     * @param type $tipo
     * @return string
     */
    public function update_user2($usuario_id, $nombre, $apellidos, $password, $fotografia, $telefono, $email, $tipo) {

        $datos = array(
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'password' => $password,
            'fotografia' => $fotografia,
            'telefono' => $telefono,
            'email' => $email,
            'tipo' => $tipo);

        $this->db->where('usuario_id', $usuario_id);
        $this->update('usuarios', $datos);

        if ($this->db->affected_rows() > 0) {
            $r = "ok";
        } else {
            $r = "error";
        }
        return $r;
    }

    /**
     * 
     * @param type $usuario_id
     */
    public function delete_usuario($usuario_id) {
        $this->db->where("usuario_id", $usuario_id);
        $this->db->delete("usuario");

        if ($this->db->affected_rows() > 0) {
            $r = "ok";
        } else {
            $r = "error";
        }
        return $r;
    }

}
