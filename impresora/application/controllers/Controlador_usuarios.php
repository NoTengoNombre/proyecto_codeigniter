<!--Añadirle seguridad a los formularios -->
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controlador_usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_usuarios'); // invoca la clase 'Modelo'
    }

    /**
     * 1º Vista : 
     * Carga la vista 'login/view_login'
     * y luego el mensaje
     * 
     * Dentro del archivo "VISTA MASTER" 'pagina.php' tengo 
     * la "VISTA" 'login/view_login'   
     */
//    public function index() {
//        $data['cabecera'] = $this->load->view('header'); // archivo 'VISTA' header.php
//        $data['pagina'] = $this->load->view('login/view_login');
//        $data['pie'] = $this->load->view('footer'); // archivo 'VISTA' footer.php
//        $this->load->view('plantillas', $data); // carga la vista login_seguro
//    }
//    
    public function index() {
        $data['texto'] = "Bienvenido a la aplicación !";
        $data['pagina'] = 'login/view_login';
        $this->load->view('conjunto_vistas', $data); // carga la vista login_seguro 
    }

    /**
     *  
     * Comprueba los datos enviados desde el formulario
     * y dependiendo de los 'DATOS' 
     * 
     * Muestra :
     * 
     * Panel de 'ADMINISTRADOR'
     * Panel de 'USUARIO'
     * 
     * Crea objeto 'form_validation'
     * 
     * Añade las reglas al formulario usuario
     * Envia el mensaje al formulario usuario
     * Invoca el metodo 'check_login_modelo'
     * 
     */
    public function check_login() {
        //Cargo la libreria y creo el OBJETO model_adm y model_adm para invocar sus metodos
        $this->load->model('modelo_documentos');
        $this->load->model('modelo_usuarios'); // sacar todos los usuarios
        //Cargo la libreria y creo el OBJETO - form_validation
        $this->load->library('form_validation');
        //Personaliza los mensaje de errores      
        $this->form_validation->set_error_delimiters('<div class="error"> Atención : ', '</div>');
        //Fijo las reglas
        $this->form_validation->set_rules('usr', 'Usuario', 'required|min_length[1]');
        $this->form_validation->set_rules('pass', 'Password', 'required|min_length[1]');
        //Mensaje para las reglas    
        $this->form_validation->set_message("required", "El campo %s es obligatorio");
        //Si la VALIDACION NO ES CORRECTA
        if ($this->form_validation->run() == FALSE) {

            $this->index(); // regresa index / probar con redirigir
        } else { // VALIDACION CORRECTA
//Crea objeto 'model_login' para invocar metodo "check_login_modelo"
//Recogo en Array los datos del modelo del formulario
            $datos_usuario = $this->modelo_usuarios->check_login_modelo(
                    $this->input->get_post("usr"), $this->input->get_post("pass"));

// "$datos_usuario" devuelve Array_String y entra en el If
            if ($datos_usuario != null) {

// Carga libreria Sessiones y crea objeto 
                $this->load->library('session');

//Recojo los datos del metodo check_login_modelo del Modelo
                $idusr = $datos_usuario["idusr"]; // array con los valores recuperados del formulario 
                $tipousr = $datos_usuario["tipousr"]; // array con los valores recuperados del formulario 
//Creo objeto $session , meto los 'String' -> iduser , tipouser, nombreusr como 'Array Asociativo"
                $session = array(
                    'idusr' => $idusr,
                    'tipousr' => $tipousr,
                    'nombreusr' => $this->input->get_post("usr"));
//♦funcion global-coge usr viene del formulario - 'nombre'
//Agregamos los datos y guardamos la session del usuario
                $this->session->set_userdata($session); // se almacenan como array el seguimiento del usuario
//El objeto session tiene los datos de idusr , tipousr , nombreusr
//Comparo el $tipousr          
//                PERFIL DE USUARIO 
                if ($tipousr == 1) {

                    // Cargo la vista de Usuario convencional
                    $this->load->view("panel/panel_user");

//                PERFIL DE ADMINISTRADOR
                } else if ($tipousr == 0) {
// Todos los usuarios de la BD
                    $data["resultados"] = $this->modelo_usuarios->get_all_users();
// Nombre de la session - para mostrar por pantalla
                    $data['texto'] = $this->session->nombreusr;
// Todos los documento - info = Es un 'STRING' con la cadena 'JSON'
                    $data['info'] = $this->modelo_documentos->getDocumentInfo();
// "V" carga todos los usuarios y texto en la vista
                    $this->load->view("panel/panel_admin", $data);
                }
            } else { // Datos No correctos (login fallido) 
                $data['error'] = "<p style='color: red;'> Nombre de usuario y/o contraseña incorrectos </p>";
//                Reenvia login
                $this->load->view('login/view_login', $data);
            }
        }
    }

    /**
     * Insercciones
     * 
     * Obtengo datos 'formulario' 
     * Inserto dentro BD
     * Muestro con "ok" / "error"  
     */
    public function aniadir_usuario() {

        $tipo = $this->input->get_post('tipo');
        var_dump($tipo);
        $nombre = $this->input->get_post('nombre');
        var_dump($nombre);
        $apellidos = $this->input->get_post('apellidos');
        var_dump($apellidos);
        $password = $this->input->get_post('password');
        var_dump($password);
        $fotografia = $this->input->get_post('fotografia');
        var_dump($fotografia);
        $telefono = $this->input->get_post('telefono');
        var_dump($telefono);
        $emails = $this->input->get_post('email');
        var_dump($emails);

        $respuesta = $this->modelo_usuarios->insertar_usuarios($tipo, $nombre, $apellidos, $password, $fotografia, $telefono, $emails);

        if ($respuesta == "correcto") {
            $data['mensaje'] = $this->load->view('mensaje/correcto');
            $this->load->view('mensaje/respuesta', $data);
            
        }

        if ($respuesta == "error") {
            $data['mensaje'] = $this->load->view('mensaje/error');
            $this->load->view('mensaje/respuesta', $data);
        }
    }

    /**
     * Modificar el usuario
     * 
     * Envia resultado a la vista
     * 
     * @param type $id
     */
    public function editar_usuario($id = NULL) {

        if ($id != NULL) {

            $data['resultado'] = $this->modelo_usuarios->get_all_users();
            $data['datos_usuarios'] = $this->modelo_usuarios->edit_usuario($id);
            var_dump($data['datos_usuarios']);
            $data['contenido'] = 'usuarios/editar_usuario'; // cargo la vista 
            $this->load->view('plantilla_editar_usuarios', $data);
        } else {
            //regresar a index enviar parametro
            redirect('');
        }
    }

    /**
     * Modifica dentro de la vista
     * 
     * @param type $id
     */
    public function editar_usuario__($id = NULL) {

        if ($id != NULL) {
            //mostrar datos
            $data['resultado'] = $this->modelo_usuarios->selArchivo();
            $data['datos_usuario'] = $this->modelo_usuarios->edit_usuario($id);
            $this->load->view('usuarios/editar_usuario', $data);
        } else {
            //regresar a index enviar parametro
            redirect('');
        }
    }

    /**
     * 
     */
    public function update_usuario() {

        $datos = $this->input->get_post();

        if (isset($datos)) {
            $txtUsuid = $datos['txtUsuid'];
            $txtNombres = $datos['txtNombre'];
            $txtApellidos = $datos['txtApellidos'];
            $txtPassword = $datos['txtPassword'];
            $txtFotografia = $datos['txtFotografia'];
            $txtTipo = $datos['txtTipo'];
            $txtCorreo = $datos['txtEmail'];
            $txtTelefono = $datos['txtTelefono'];
            $this->modelo_usuarios->updateUsuario(
                    $txtUsuid, $txtTipo, $txtNombres, $txtApellidos, $txtCorreo, $txtTelefono);
            redirect('');
        }
    }

    /**
     * 
     * @param type $id
     */
    public function delete_usuario($id = null) {

        if ($id != null) {
            $resultado = $this->modelo_usuarios->delete_usuario($id);
            $this->load->view('usuarios/delete_usuario', $resultado);
        } else {
            $this->index();
        }
    }

}
