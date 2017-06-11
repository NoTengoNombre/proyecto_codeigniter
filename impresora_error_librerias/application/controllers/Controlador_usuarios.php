<!--Añadirle seguridad a los formularios -->
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
        //Mensaje para las reglas    
        $this->form_validation->set_message("required", "El campo %s es obligatorio");

        //Si VALIDACION "NO CORRECTA"
        if ($this->form_validation->run() == FALSE) {

            $this->index(); // regresa index /  !probar con redirigir
            
        } else { // VALIDACION "CORRECTA"
            //Invoca la clase 'modelo_usuario' 
            //Crea el objeto 'modelo_usuarios' para invocar metodo "check_login_modelo"
            //Recojo del 'Array' con los datos del modelo del formulario de 'LOGIN'
            $datos_usuario = $this->modelo_usuarios->check_login_modelo(
                    $this->input->post("usr"), 
                    $this->input->post("pass"));
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
     * Funcion para redigir el usuario 'Adm' o 'User'
     * a la vista correspodiente y evitar
     * la pantalla en blanco o de login
     * 
     * @param type $msj
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
        
//      Del 'Array session' obtenemos el 'idusr' 
        $idusr = $session['idusr'];
        
//        
        $info = $this->modelo_documentos->getDocumentInfoUser($idusr);
        
        $data = array("info" => $info);
        $data['pagina'] = 'panel/panel_user';
        $data['mensaje'] = $msj;
        
        $this->load->view('conjunto_vistas', $data);
    }

    /**
     * 
     * @param type $msj
     */
    public function panel_admin($msj = null) {
        // 'Array asociativo' con distintos valores
        $this->load->model('modelo_usuarios'); // sacar todos los usuarios
        $this->load->model('modelo_documentos');
        
        $data["texto"] = "Todos los usuarios";
        $data['pagina'] = 'panel/panel_admin'; // Vista Cargada tiene el Array
        $data['mensaje'] = $msj;

        $data["resultados"] = $this->modelo_usuarios->get_all_users();
        $data["info"] = $this->modelo_documentos->getDocumentInfo();

        $this->load->view('conjunto_vistas', $data); // "V" carga todos los usuarios y texto en la vista
    }

    /**
     * Descartar 
     */
//    public function add_user_invitado() {
//        $this->load->view('panel/panel_registro'); // "V" carga todos los usuarios y texto en la vista
//    }

    /**
     * 
     * necesita insertar foto
     */
    public function add_user() {

        $datos = $this->input->post();

        if (isset($datos)) {
            $tipo = $datos['tipo'];
            $nombre = $datos['nombre'];
            $apellidos = $datos['apellidos'];
            $password = $datos['password'];
            $email = $datos['email'];
            $fotografia = $datos['fotografia'];
            $telefono = $datos['telefono'];
        }

        $insert = $this->modelo_usuarios->user_add($tipo, $nombre, $apellidos, $password, $email, $fotografia, $telefono); // el insert no hace falta

        if ($insert == TRUE) {
            $this->index();
        }
        echo json_encode(array("status" => TRUE)); // siempre enviara el json como Array-String
    }

    /**
     * 
     * @param type $id
     */
    public function editar_usuario($id = null) {

        if ($id != null) {
            echo 'soy controlador - Editar Usuario <br>';
            //COGE EL archivo 'VISTA:usuario:edit' y la almacena en la variable
            $data['todos_usuarios'] = $this->modelo_usuarios->get_all_users();
            $data['datosUsuario'] = $this->modelo_usuarios->editar_usuario($id);
            $data['pagina'] = 'usuarios/editar_usuario';
            $this->load->view('conjunto_vistas', $data);
        } else {
            //regresar a index enviar parametro
            $this->index();
        }
    }

    /**
     * 
     */
    public function actualizar_usuario() {

        $datos = $this->input->post();

        if (isset($datos)) {

            $usuario_id = $datos['usuario_id'];
            $tipo = $datos['tipo'];
            $nombre = $datos['nombre'];
            $apellidos = $datos['apellidos'];
            $password = $datos['password'];
            $email = $datos['email'];
            $fotografia = $datos['fotografia'];
            $telefono = $datos['telefono'];
            
            $re = $this->modelo_usuarios->update_usuario($tipo, $usuario_id, $nombre, $apellidos, $password, $email, $fotografia, $telefono);
            $this->panel("Usuario modificado con éxito");
            
        } else {
            $re = false;
            $this->panel("Error al actualizad");
        }
    }

    /**
     * 
     * @param type $id
     */
    public function user_delete($id = NULL) {
        if ($id != NULL) {
            $this->modelo_usuarios->deleteUsuario($id);
        }
        $this->panel();
    }

}
