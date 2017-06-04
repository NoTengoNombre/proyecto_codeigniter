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

// Si hay valores
        if ($query->num_rows() > 0) { 
            
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

//      $filas = $this->db->get('usuarios'); // Produce: SELECT * FROM usuarios
//      $usuario_id = $filas->num_rows();
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

}
