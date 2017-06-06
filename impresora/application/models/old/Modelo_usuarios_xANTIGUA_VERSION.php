<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_usuarios extends CI_Model {

    /**
     * No necesita
     * $this->load->database()
     * Porque esta en el autoload
     */
    public function __construct() {
        parent::__construct();
    }

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
        // selecciono columna "password" , password del form
        $this->db->where("password", $pass); // dato enviado al metodo check_login - Controlador
        // selecciona tabla usuarios para hacer la consulta
        //OBJETO
        $resultado = $this->db->get("usuarios"); // SELECT (*) FROM 'usuarios' where nombre like 'usr' and password like 'pass'
        //Objeto 'db' contiene total de filas
        if ($this->db->affected_rows() > 0) { // hay +1 filas
            // $resultado - Objeto con todos los campos en forma de String
            // $fila - Columnas BD se sacan como objetos
            foreach ($resultado->result() as $fila) {//devuelve todos "elementos" en un array de objetos
        //      "De todos los elementos del ARRAY selecciono las columnas idusr , tipousr"
        //      $datos_usuario -> ARRAY Instanciado en este momento
                $resultado = array();
// Los datos los almaceno en un array de 'STRING'
// En el indice ['idusr'] almaceno el usuario_id de la BD               
                $resultado['idusr'] = $fila->usuario_id; // almaceno en el array $datos_usuario el objeto 'usuario_id' que es un String
// En el indice ['tipousr'] almaceno el usuario_id de la BD               
                $resultado['tipousr'] = $fila->tipo; // almaceno en el array $datos_usuario el objeto 'tipo' que es un String
            }
        } else {
// si no hay registro devuelve : NULL
            $resultado = null;
        }
        return $resultado; //devuelve array de String o devuelve 'null'
    }

    /**
     * Ok!
     * Mostrar todos los usuarios
     * 
     * @return type Array "Objetos"
     */
    public function get_all_users() {

        $query = $this->db->get("usuarios"); // SELECT (*) FROM usuarios

        if ($query->num_rows() > 0) { // Si hay valores
            
            foreach ($query->result() as $fila) { // Saco los objetos
            
                $data[] = $fila; // Almaceno los OBJETOS dentro de un ARRAY
                
            }
            return $data; // Devuelve ARRAY de OBJETOS
        }
    }

    /**
     * 
     * Añade datos a la tabla usuarios
     * 
     * Se invoca en el controlador
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
    public function add_user($tipo, $nombre, $apellidos, $password, $telefono, $email, $fotografia) {

//        $filas = $this->db->get('usuarios'); // Produce: SELECT * FROM usuarios
//        $usuario_id = $filas->num_rows();
//      var_dump($usuario_id);

        echo $tipo;
        echo $nombre;
        echo $apellidos;
        echo $password;
        echo $telefono;
        echo $email;
        echo $fotografia;

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

//      Ejecuta la accion de insertar
        echo $this->db->insert('usuarios', $datos);
//      El objeto 'db' dice si tiene fila o no
        if ($this->db->affected_rows() == 1) {
            $r = "ok";
        } else {
            $r = "error";
        }
        return $r; // devuelve string
    }

    /**
     * 
     * @param type $usuario_id
     * @return string
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

    function show_usuarios() {
        $query = $this->db->get('usuarios');
        $query_result = $query->result();
        return $query_result;
    }

    /**
     * 
     * @param type $data
     * @return type objetos
     */
    function show_usuarios_id($data) {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('usuario_id', $data);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    /**
     * 
     * @param type $id
     * @param type $data
     */
    function update_usuarios_id($id, $data) {
        $this->db->where('usuario_id', $id);
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
    public function delete_user($usuario_id) {
        $this->db->where("usuario_id", $usuario_id);
        $this->db->delete("usuario");
        if ($this->db->affected_rows() > 0) {
            $r = "ok";
        } else {
            $r = "error";
        }
        return $r;
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

}
