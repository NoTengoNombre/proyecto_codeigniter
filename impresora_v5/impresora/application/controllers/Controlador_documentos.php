<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controlador_documentos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_documentos');
        $this->load->helper("file");
    }

    /**
     * Subir archivo al servidor
     * mediate un formulario
     * Agregando 3 parametros
     * 1º datos del archivo
     * 2º Identificador del archivo
     * 3º ID del usario de la session 
     */
    public function uploadDocument() {
// Configuración de los archivos que se van a subir       
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 5000;
//Recibe del formulario el "numeroDocumentos"
        $numeroDocumentos = $this->input->post('numeroDocumentos');
//Obtengo todos los valores del 'Array Asociativo' $session         
        $session = $this->session->get_userdata();
        //  '__ci_last_regenerate' => int 1496512944
        //  'idusr' => string '1' (length=1)
        //  'tipousr' => string '1' (length=1)
        //  'nombreusr' => string 'u' (length=1)
#Creo 'string' con la variable de session        
        $idusr = $session['idusr'];
//Subir archivo con la configuracion
        $this->load->library('upload', $config);
//Consulta a BD con el ultimo registro     
        $archivoId = $this->modelo_documentos->getLastArchivoId() + 1;
//Recorre el numero de documentos que se han ido añadiendo desde el formulario
//mediante JQUERY        
        for ($i = 1; $i < $numeroDocumentos + 1; $i++) {
//Incremento para saber el numero del archivo por el que va          
//Espera que los archivos de subida venga del formulario 
//Si ARCHIVO DA ERROR 'se cambia la condicion' entra en el 'IF' 

            if (!$this->upload->do_upload('documento' . $i)) {
                return $this->nueva_vista("<p class='allline txtcentro error' style='color: red;'>Error al subir uno de los ficheros</p>");
//Si ARCHIVO ES SUBIDO 'entra en esta condicion'                
            } else {
//Crea array 'asociativo'                
                $upload = array('upload_data' => $this->upload->data());
                //if ($upload['upload_data']['file_size'] < 5000){
                //Elemento a subir Fila Columna
                $name = $upload['upload_data']['file_name'];
                //Datos de configuracion del archivo               
                $data = array(
                    'nombreConjunto' => $this->input->post('nombre'),
                    'notas' => $this->input->post('notas'),
                    'numeroDocumentos' => $numeroDocumentos,
                    'url' => $name,
                    'documentoId' => 1,
                );

                //                                                     Datos del archivo a subir
                //                                                              Posicion del archivo a subir                                             
                //                                                                          Identificador del usuario para saber que usuario subio el archivo
                $this->modelo_documentos->uploadDocument($data, $archivoId, $idusr);
                return $this->nueva_vista("<p class='allline txtcentro error' style='color: green;'>Archivo subido correctamente</p>"); //}
                /* else{
                  return $this->nueva_vista("Uno de los archivos es demasiado grande");
                  } */
            }
            return $this->nueva_vista();
        }
//    
    }

    public function borrar_documento() {
        $idDoc = $this->input->post('id');
        $nombreDoc = $this->input->post('nombre');
        $this->modelo_documentos->borrar_doc($idDoc, $nombreDoc);
    }

    /**
     * 
     * @param type $name
     */
    public function downloadDocument($name) {
        $this->modelo_documentos->downloadDocument($name);
    }

    /**
     * 
     * @return type
     */
    public function getDocumentInfoAdmin() {
        $info = $this->modelo_documentos->getDocumentInfo();
        return $info;
    }

    /**
     * 
     */
    public function subir_documentos() {
        $data['pagina'] = 'usuarios/subir_documentos';
        $this->load->view('conjunto_vistas', $data);
    }

    /**
     * 
     * @param type $id
     */
    public function cambiar_estado($id) {
        $date = date('d/m/Y', time()); // devuelve 'String'
        $data = array('estado' => 1, 'fecha_impresion' => $date);
        echo $id;
        $this->db->where('documento_id', $id);
        $this->db->update('documentos', $data);
    }

    /**
     * 
     */
    public function nueva_vista($msj = null) {
//        Obtengo los datos de la sesion
        $session = $this->session->get_userdata();
//        Obtengo el id del usuario
        $idusr = $session['idusr'];

//      Obtengo los datos del usuario mediante del 'id' de la session
        $info = $this->modelo_documentos->getDocumentInfoUser($idusr);
//        creo una array asociativa con todos los objetos de la 
        $data = array("info" => $info); // envia los datos como JSON-Array-String
        $data['pagina'] = 'panel/panel_user';
        $data['mensaje'] = $msj;
        $this->load->view('conjunto_vistas', $data);
    }

}
