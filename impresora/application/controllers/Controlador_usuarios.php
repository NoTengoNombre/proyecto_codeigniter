<!--Añadirle seguridad a los formularios -->
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controlador_usuarios extends CI_Controller {

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
        $this->form_validation->set_error_delimiters('<div class="error"> Atención : ' , '</div>');
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
$datos_usuario =$this->modelo_usuarios->check_login_modelo(
                $this->input->post("usr") , 
                $this->input->post("pass"));
            // "$datos_usuario" devuelve 'Array' de 'String' y entra en el If
            if ($datos_usuario != null) {   
// Invocamos libreria 'session' 
// Guarda los datos para que esten presente en todo el programa
                $this->load->library('session');
// Recojo datos del metodo 'check_login_modelo' del 'Modelo' 
// Los almaceno en una variable tipo String               
                $idusr = $datos_usuario["idusr"]; // de Array a String con los valores recuperados del formulario 
                $tipousr = $datos_usuario["tipousr"]; // de Array a String con los valores recuperados del formulario 
// Creo 'ARRAY asociativo' llamado $session 
// Dentro asocio la variable tipo 'String' -> 'iduser' , 'tipouser', 'nombreusr' 
                $session = array(
                    'idusr' => $idusr,
                    'tipousr' => $tipousr,
                               //funcion global: Coge 'usr' viene del formulario - 'nombre'
                    'nombreusr' => $this->input->post("usr"));

//'Array Asociativo' -> 'session' tiene los datos de 'idusr' , 'tipousr' , 'nombreusr'
//Establezco en todo el programa los valores que tiene la 'session'
                $this->session->set_userdata($session); 
                //Comparo el $tipousr          
                //Usuario
                if ($tipousr == 1) {
                    // Cargo 'VISTA' de Usuario 
                    $data['pagina'] = 'panel/panel_user';
                    $this->load->view('conjunto_vistas', $data);

                //Administrador
                } else if ($tipousr == 0) {
                    // 'Array asociativo' con distintos valores                    
                    $data["texto"] = "Todos los usuarios";
                    $data['pagina'] = 'panel/panel_admin';
                    
                    $data["resultados"] = $this->modelo_usuarios->get_all_users();
                    $data["info"] = $this->modelo_documentos->getDocumentInfo();
                    
                    $this->load->view('conjunto_vistas', $data); // "V" carga todos los usuarios y texto en la vista
                    
                }
            } else { // Usuario 'NULL' - Datos No correctos (login fallido) - Reenvia login
                $data['error'] = "<p style='color: red;'>Nombre de usuario y/o contraseña incorrectos</p>";
                $data['pagina'] = 'login/view_login';
                $this->load->view('conjunto_vistas', $data); // "V" carga todos los usuarios y texto en la vista
            }
        }
    }
    
}
