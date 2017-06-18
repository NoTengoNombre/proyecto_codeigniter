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
     * @param type $email String
     * @param type $pass String
     * @return type ARRAY
     */
    public function check_login_modelo($email, $pass) {
        // selecciono columna "nombre" y el "nombre usuario" del formulario
        $this->db->where("email", $email); // dato enviado al metodo check_login - Controlador
        // selecciono columna "password" , password del formulario
        $this->db->where("password", $pass); // dato enviado al metodo check_login - Controlador
        // selecciona tabla usuarios para hacer la consulta
        //'resultado' es un OBJETO 
        $resultado = $this->db->get("usuarios"); // SELECT (*) FROM 'usuarios' where nombre like 'usr' and password like 'pass'
        //Objeto 'db' contiene total de filas
        // Si hay +1 de 1 filas
        if ($this->db->affected_rows() > 0) {
            //$resultado - Objeto con todos los campos en forma de String
//                              result() - Devuelve 'Array' de Objetos
            // $fila - 'Objeto' que almacena todos los valores de las columnas BD.
            foreach ($resultado->result() as $fila) { // Devuelve todos "elementos" en un 'array' de objetos
                //"De todos los elementos del ARRAY selecciono las columnas "idusr" , "tipousr"
                $resultado = array();
// Los datos los almaceno en un array de 'STRING'
// En el indice ['idusr'] almaceno el 'usuario_id' de la BD               
                $resultado['idusr'] = $fila->usuario_id; // almaceno en el array "$resultado" el valor del objeto 'usuario_id' que es un String
                $resultado['tipousr'] = $fila->tipo; // almaceno en el array "$resultado"  el valor 'tipo' que es un tipo numerico
                $resultado['nombre'] = $fila->nombre;
                $resultado['activo'] = $fila->activo;
            }
        } else {
// si no hay registro devuelve : NULL
            $resultado = null;
        }
        return $resultado; //devuelve array con los valores o devuelve 'null'
    }

    /**
     * Devuelve un Array de Objetos
     * con todos los valores de la fila de usuarios
     * 
     * @return type Array "Objetos" 
     */
    public function get_all_users() {

        $query = $this->db->get("usuarios"); // SELECT (*) FROM usuarios
// Si hay valores
        if ($query->num_rows() > 0) {

            foreach ($query->result() as $fila) { // Saco los objetos
                $data[] = $fila; // Almaceno todos los 'OBJETOS' del USUARIOS dentro del ARRAY
//                                  cada posicion del ARRAY tendra 1 OBJETO 
//                                  con todos los datos de la fila de la BD
            }
//tipo Array - en cada posicion hay un 'OBJETO' con todos los datos de los 'USUARIOS'
            return $data; // Devuelve ARRAY de Objetos - Cada Objeto tiene una fila llena de datos
        }
    }

    /**
     * 
     * Obtengo todos los datos de "un usuarios"
     * mediante su $id y los almaceno en un
     * Array de "Objetos"
     * 
     * @param type $id
     * 
     * @return type Array "Objetos" con su $id
     */
    public function get_id_users($id = null) {
// Filtro la busqueda por el 'id'
        $this->db->from('usuarios');
        $this->db->where('usuario_id', $id);
// De la tabla 'usuarios' - SELECT (*) FROM usuarios
        $query = $this->db->get();
// ? Si hay mas de +1 una fila
// ?       if ($query->num_rows() > 0) {
// ? Recorre todas las filas - cada una , 1 - 'Objetos' 
// ?           foreach ($query->result() as $fila) { // Saco los objetos
// ?              $data[] = $fila; // Almaceno todos los datos del USUARIOS dentro ARRAY
// ?           }
// ? Obtengo 1 fila con todos los datos de los USUARIOS
        return $query->row(); // Devuelve ARRAY con 1 OBJETO
// ?          En la posicion 0 del array : tiene un objeto con los valores almacenados de la bd
// ?          El ARRAY 'data' tiene en la posicion '0' un 'OBJETO' con todos los "datos" de la fila de la base de datos
// ?       }
    }

    /**
     * Active Record
     * 
     * @param type $tipo
     * @param type $nombre
     * @param type $apellidos
     * @param type $password
     * @param type $activo
     * @param type $email
     * 
     * @return type boolean TRUE
     */
    public function user_add($nombre, $apellidos, $password, $activo, $email, $tipo) {

//        Se crea un array asociativo
        $arrayDatos = array(
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'password' => $password,
            'activo' => $activo,
            'email' => $email,
            'tipo' => $tipo,
        );

// La inserccion devuelve un valor 'true' "si es correcta" o 'false' si es incorrecta.        
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

//Devuelve un array de datos
        $consulta = $this->db->get('usuarios');

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
    public function update_usuario($usuario_id, $nombre, $apellidos, $password, $activo, $email, $tipo) {

        $array = array(
            'usuario_id' => $usuario_id,
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'password' => $password,
            'activo' => $activo,
            'email' => $email,
            'tipo' => $tipo
        );

        $this->db->where('usuario_id', $usuario_id);

//      Devuelve 'true' si hizo la actualizacion correcta
//              'false' si hizo la actualizacion incorrecta
        $respuesta = $this->db->update('usuarios', $array);

        return $respuesta;
    }

    /**
     * 
     * @param type $id
     */
    public function deleteUsuario($id) {

        $this->db->where('usuario_id', $id);
// Devuelve true si realiza el borrado
        $re = $this->db->delete('usuarios');

        return $re;
    }

}
