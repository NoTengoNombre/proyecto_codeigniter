<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_usuarios extends CI_Model {

    /**
     * No necesita '$this->load->database()'
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
     * Mostrar todos los usuarios
     * Obtiene de forma correcta todos los datos
     * 
     * @return type Array "Objetos"
     */
    public function get_all_users() {
        $query = $this->db->get("usuarios"); // SELECT (*) FROM usuarios
// Si hay valores
        if ($query->num_rows() > 0) {

            foreach ($query->result() as $fila) { // Saco los objetos
                $data[] = $fila; // Almaceno todos datos de USUARIOS dentro ARRAY
            }
            echo '<hr>';
            //Con todos los datos de los USUARIOS
            return $data; // Devuelve ARRAY de Objetos - 
        }
    }

    /**
     * 
     * @param type $tipo
     * @param type $nombre
     * @param type $apellidos
     * @param type $password
     * @param type $email
     * @param type $fotografia
     * @param type $telefono
     * @return type boolean TRUE
     */
    public function user_add($tipo, $nombre, $apellidos, $password, $email, $fotografia, $telefono) {

        $arrayDatos = array(
            'tipo' => $tipo,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'password' => $password,
            'email' => $email,
            'fotografia' => $fotografia,
            'telefono' => $telefono,
        );

//        $this->db->set('usuarios');
        $respuesta2 = $this->db->insert('usuarios', $arrayDatos);
        return $respuesta2;
    }

    /**
     * Active Record
     * 
     * Filtro datos 'usuarios' mediante 'id' 
     * Devolver 'Array Objetos' con datos
     * 
     * @param type $id
     * @return type "Array OBJETOS"
     */
    public function editar_usuario($id) {
        $this->db->where('usuario_id', $id);
        $consulta = $this->db->get('usuarios');
//        $consulta = $this->db->query("SELECT * FROM usuarios WHERE usuario_id = '$id'");
        return $consulta->result(); // regresa 'array de objetos'
    }

    /**
     * Metodo obtiene datos formulario
     * 
     * @param type $usuario_id
     * @param type $nombre
     * @param type $apellidos
     * @param type $email
     * @param type $telefono
     * @param type $tipo
     */
    public function update_usuario($tipo, $usuario_id, $nombre, $apellidos, $password, $email, $fotografia, $telefono) {

        $array = array(
            'usuario_id' => $usuario_id,
            'tipo' => $tipo,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'password' => $password,
            'email' => $email,
            'fotografia' => $fotografia,
            'telefono' => $telefono,
        );

        $this->db->where('usuario_id', $usuario_id);
//        $this->db->update('usuarios', $array);
        $respuesta = $this->db->update('usuarios', $array);
        return $respuesta;
    }

    /**
     * ♥ Correcto 
     * 
     * @param type $id
     */
    public function deleteUsuario($id) {
        $this->db->where('usuario_id', $id);
        $re = $this->db->delete('usuarios');
        return $re;
    }

}
