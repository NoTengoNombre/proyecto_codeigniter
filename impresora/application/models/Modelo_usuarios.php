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
        //// SELECT (*) FROM 'usuarios' where nombre like 'usr' and password like 'pass'
        $resultado = $this->db->get("usuarios");
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
     * Añadir datos del Usuario
     * 
     * @param type $tipo
     * @param type $nombre
     * @param type $apellidos
     * @param type $password
     * @param type $fotografia
     * @param type $telefono
     * @param type $email
     * 
     * @return string
     */
    public function insertar_usuarios($tipo, $nombre, $apellidos, $password, $fotografia, $telefono, $email) {

        $datos = array(
            'tipo' => $tipo,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'password' => $password,
            'fotografia' => $fotografia,
            'telefono' => $telefono,
            'email' => $email);

        $query = $this->db->insert('usuarios', $datos);

        var_dump($query);

        if ($this->db->affected_rows() == 1) {
            $respuesta = "correcto";
        } else {
            $respuesta = "error";
        }   
        return $respuesta; // Respuesta como string
    }

    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function edit_usuario($id) {
//      $consulta = $this->db->query("SELECT * FROM usuario u inner join perfil p on u.per_id = p.per_id WHERE u.usu_id = $id");
//      $consulta = $this->db->query("SELECT * FROM usuarios u inner join documentos d on u.usuario_id = d.usuario_id WHERE u.usuario_id = '$id'");
//        $consulta = $this->db->query("SELECT * FROM usuarios WHERE usuario_id = '$id'");
        $consulta = $this->db->query("select * from usuarios u inner join archivo a on u.usuario_id = a.id_archivo where u.usuario_id = $id");
        return $consulta->result();
    }

    /**
     * la función de Select * en sql
     * 
     * @return type
     */
    public function sel_usuarios() {

        $query = $this->db->get("usuarios");

        //retornamos todo los registros de la tabla perfil
        return $query->result();
    }

    /**
     * funcion para listar usuarios
     * 
     * @return type
     */
    public function listUsuario() {
        $query = $this->db->query("SELECT * FROM usuarios u inner join documentos d on u.usuario_id=d.documento_id");
        return $query->result();
    }

}
