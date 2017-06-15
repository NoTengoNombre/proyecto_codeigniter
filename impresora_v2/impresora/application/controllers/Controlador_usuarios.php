<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controlador_usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_usuarios');
    }

    /**
     * 1º Vista : Carga la vista 'login/view_login'
     */
    public function index() {
//Carga en 'Array' la 'Vista' - 'login/view_login' 
        $data['pagina'] = 'login/view_login';
        $this->load->view('conjunto_vistas', $data); // carga la vista login_seguro
    }

    /**
     * ♦ Crea objeto 'form_validation'
     * Añade las reglas al formulario usuario
     * Envia el mensaje al formulario usuario
     * Invoca el metodo 'check_login_modelo'
     */
    public function check_login() {
        //Cargo la libreria del 'Modelo'
        //Importo la libreria del 'modelo_usuarios' y la libreria 'model_adm' para invocar sus metodos
        $this->load->model('modelo_usuarios'); // sacar todos los usuarios
        $this->load->model('modelo_documentos');
        //Cargo la libreria 'form_validation' y creo el OBJETO - form_validation
        $this->load->library('form_validation');

        //Personaliza los mensaje de errores  
        $this->form_validation->set_error_delimiters('<div class="error"> Atención : ', '</div>');
        // !!! Agregar mas reglas
        $this->form_validation->set_rules('usr', 'Usuario', 'required|min_length[1]');
        $this->form_validation->set_rules('pass', 'Password', 'required|min_length[1]');
        //mensaje para las reglas    
        $this->form_validation->set_message("required", "El campo %s es obligatorio");

        //Si VALIDACION "NO CORRECTA"
        if ($this->form_validation->run() == FALSE) {

            $this->index(); // regresa index /  !probar con redirigir
        } else { // VALIDACION "CORRECTA"
            //Invoca la clase 'modelo_usuario' 
            //Crea el objeto 'modelo_usuarios' para invocar metodo "check_login_modelo"
            //Recojo del 'Array' con los datos del modelo del formulario de 'LOGIN'
            $datos_usuario = $this->modelo_usuarios->check_login_modelo(
                    $this->input->post("usr"), $this->input->post("pass"));

            // "$datos_usuario" devuelve 'Array' de 'String' y entra en el If
            if ($datos_usuario != null) {
// Invocamos libreria 'session' 
// Guarda los datos para que esten presente en todo el programa
                $this->load->library('session');
// Recojo los datos del metodo 'check_login_modelo' del 'Modelo' 
// Los almaceno en una variable tipo String               
                $idusr = $datos_usuario["idusr"]; // de Array a String con los valores recuperados del formulario 
                $tipousr = $datos_usuario["tipousr"]; // de Array a String con los valores recuperados del formulario 
// Creo 'ARRAY asociativo' llamado $session 
// Dentro asocio la variable tipo 'String' -> 'iduser' , 'tipouser', 'nombreusr' 
                $session = array(
                    'numero_aleatorio' => rand(1, 100),
                    'logeado' => TRUE,
                    'idusr' => $idusr,
                    'tipousr' => $tipousr,
                    //funcion global: Coge 'usr' viene del formulario - 'nombre' y lo asocia a 'nombreusr' -> 'nombreusr' = 'nombre'
                    'nombreusr' => $this->input->post("usr"));

//'Array Asociativo' -> 'session' tiene los datos de 'idusr' , 'tipousr' , 'nombreusr'
//Establezco y Almaceno en todo el programa los valores que tiene la 'session' dentro del objeto 'session'
                $this->session->set_userdata($session);
                //Comparo el $tipousr          
                $this->panel(); //Usuario
            } else { // Usuario 'NULL' - Datos "No correctos" (login fallido) - Reenvia login
                $data['error'] = "<p style='color: red;'>Nombre de usuario y/o contraseña incorrectos</p>";
                $data['pagina'] = 'login/view_login';

                $this->load->view('conjunto_vistas', $data); // "V" carga todos los usuarios y texto en la vista
            }
        }
    }

    /**
     * Función intermedia para mostrar
     * mensajes
     * 
     * Redigir al usuario 'Adm' o 'User'
     * a la vista correspodiente y
     * con el mensaje que se haya definido
     * mediante los metodos insertar , actualizar , borrar
     * 
     * Evita la pantalla en blanco o de login
     * 
     * Reutiliza el parametro $msj en todas las salidas
     * de datos de los paneles
     * 
     * Se utiliza las sesiones para redigir la salida
     * del mensaje
     * 
     * Si panel tiene la sesion 0 
     * redirige la salida hacia el panel_admin
     * 
     * Si panel tiene la sesion 1
     * redirige la salida hacia el panel_usuario

     * Para ello usa la variable de session
     * que esta cargada en todo el programa
     * 
     * @param type $msj Mensaje sera fijado por 
     * los metodos udpate , insert , delete
     */
    public function panel($msj = null) {
//Si la session es = 0 
        if ($this->session->tipousr == 0) {
            // Administrador
            $this->panel_admin($msj);
//Si la session es = 1
        } else if ($this->session->tipousr == 1) {
            // Usuario
//            $this->panel_menu($msj);
            $this->panel_usuario($msj);
        } else {
//           Me redirige al indice
            $this->index();
        }
    }

    /**
     * Redirige el perfil 'Usuario' a la vista
     * que le pertenece utilizando las variables del
     * objeto 'session'
     * 
     * @param type $msj
     */
    public function panel_usuario($msj = null) {
//      Invoca las clases del modelo
        $this->load->model('modelo_usuarios'); // sacar todos los usuarios
        $this->load->model('modelo_documentos');

//      Obtiene las variables de sesion y lo devuelve como Array
//      Array
        $session = $this->session->get_userdata();

//        var_dump($session);
//        var_dump($msj);
//      Del 'Array session' obtenemos el 'idusr' 
        $idusr = $session['idusr'];

//      Obtenemos todos los datos del usuario y la relación que tiene con los documentos 
//        mediante su id
        $info = $this->modelo_documentos->getDocumentInfoUser($idusr);

// Le pasamos a la 'vista' - "conjunto_vistas" 
// todos los datos relacionados con usuario y documentos de BD        
        $data = array("info" => $info);
// Cargamos la vista        
        $data['pagina'] = 'panel/panel_user';
// Almacenamos el valor del mensaje para mostrarlo en el panel     
        $data['mensaje'] = $msj;
// Cargamos la vista        
        $this->load->view('conjunto_vistas', $data);
    }

    /**
     * $msj : Es el que se muestra cuando se realiza una 
     * insercción , actualizacion 
     * 
     * @param type $msj 
     */
    public function panel_admin($msj = null) {
        // 'Array asociativo' con distintos valores
        $this->load->model('modelo_documentos'); // sacar todos los usuarios
        $this->load->model('modelo_usuarios');

        $data["texto"] = "Todos los usuarios";
        $data['pagina'] = 'panel/panel_admin'; // Vista Cargada tiene el Array
        $data['mensaje'] = $msj;

//        var_dump($data['mensaje']); // mensaje

        $data["resultados"] = $this->modelo_usuarios->get_all_users();
        $data["info"] = $this->modelo_documentos->getDocumentInfo();

        $this->load->view('conjunto_vistas', $data); // "V" carga todos los usuarios y texto en la vista
    }

    public function add_user_ajax() {

        $data = array(
            'nombre' => $this->input->post('nombre'),
            'apellidos' => $this->input->post('apellidos'),
            'email' => $this->input->post('email'),
            'activo' => $this->input->post('activo'),
            'password' => $this->input->post('password'),
        );

        var_dump($data);

        $resultado = $this->book_model->book_add($data);
        
        var_dump($resultado);

        echo json_encode(array("status" => TRUE));
    }

    public function add_user() {

        $datos = $this->input->post();

        if (isset($datos)) {
            $nombre = $datos['nombre'];
            $apellidos = $datos['apellidos'];
            $password = $datos['password'];
            $activo = $datos['activo'];
            $email = $datos['email'];
            $tipo = $datos['tipo'];
        }

        $this->modelo_usuarios->user_add($nombre, $apellidos, $password, $activo, $email, $tipo); // el insert no hace falta

        echo json_encode(array("status" => TRUE));
    }

    /**
     * 
     * @param type $id
     */
    public function ajax_edit_user($id) {
        // DEVUELVE UN OBJETO
        $data = $this->modelo_usuarios->get_id_users($id);
        // CODIFICA EL OBJETO Y LO ENVIA A LA VISTA como JSON-ARRAY-String
        echo json_encode($data);
    }

    /**
     * 
     */
    public function actualizar_usuario() {

        echo '<h1>Actualizar usuario</h1>';

        $datos = $this->input->post();

        if (isset($datos)) {

            $usuario_id = $datos['usuario_id'];
            $nombre = $datos['nombre'];
            $apellidos = $datos['apellidos'];
            $password = $datos['password'];
            $activo = $datos['activo'];
            $email = $datos['email'];
            $tipo = $datos['tipo'];

            $re = $this->modelo_usuarios->update_usuario($usuario_id, $nombre, $apellidos, $password, $activo, $email, $tipo);

// Mensaje que se envia directamente a la vista del 'panel admin' con el resultado
// de la ejecucion de la acción             
            $this->panel("Usuario modificado con éxito");
        } else {

            $re = false;
// Mensaje que se envia directamente a la vista del 'panel admin' con el resultado
// de la ejecucion de la acción     
            $this->panel("Error al actualizar");
        }
    }

    /**
     * 
     * @param type $id
     */
    public function user_delete($id = NULL) {

        if ($id != NULL) {

            $this->modelo_usuarios->deleteUsuario($id);
// Mensaje que se envia directamente a la vista del 'panel admin' con el resultado
// de la ejecucion de la acción   
            $this->panel('Borrado con exito');
        } else {

            $this->panel('Borrado sin exito');
        }
    }

//    public function cerrar_sesion($ci = null, $nombre = null) {
    /**
     * 
     */
    public function cerrar_sesion() {

        $valor = $this->session->unset_userdata($this->session->all_userdata());

        if ($valor == null) {
            $this->session->sess_destroy();
            $this->index();
        }
    }

}
