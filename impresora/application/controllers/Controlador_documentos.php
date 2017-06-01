<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controlador_documentos extends CI_Controller {

    /**
     * Constructor basico 
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('modelo_documentos');

    }

    /**
     * Subir archivo pdf
     */
    public function uploadDocument() {
//        Configuracion del archivo a subir
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 5000;
        
// Viene del formulario         
        $numeroDocumentos = $this->input->get_post('numeroDocumentos');
// Crea session         
        $session = $this->session->get_userdata();
// Obtenemos el valor 'idusr' de la session       
        $idusr = $session['idusr'];
// Carga el upload para subir archivo y la configuración        
        $this->load->library('upload', $config);
//         
        $archivoId = $this->modelo_documentos->getLastArchivoId() + 1;
        
        for ($i = 1; $i < $numeroDocumentos + 1; $i++) {
            echo $i;
            if (!$this->upload->do_upload('documento' . $i)) {
                echo '<h1>no entra</h1>';
                $error = array('error' => $this->upload->display_errors());

                //$this->load->view('upload_form', $error);
                
            } else {

                echo '<h1>entra</h1>';
                /* $documentoId = $this->getNewDocumentoId(); //hacerla, saca documento id no usada */
                $upload = array('upload_data' => $this->upload->data());
        
                $name = $upload['upload_data']['file_name'];
                
                $data = array(
                    'nombreConjunto' => $this->input->post('nombre'),
                    'notas' => $this->input->post('notas'),
                    'numeroDocumentos' => $numeroDocumentos,
                    'url' => $name,
                    'documentoId' => 1,
                );
                $this->Modelo_documentos->uploadDocument($data, $archivoId, $idusr);
                //$this->load->view('upload_success', $data);
            }
        }
    }


    
    public function downloadDocument($name) {
        $this->Modelo_documentos->downloadDocument($name);
    }
    
    public function getDocumentInfoAdmin() {
    	$info = $this->Modelo_documentos->getDocumentInfo();
    	return $info;  	
    }
    
    public function ver_documentos() {

    	$session=$this->session->get_userdata();
    	$idusr = $session['idusr'];
    	$info = $this->modelo_documentos->getDocumentInfoUser($idusr);
    	$data = array("info"=>$info);
    	$this->load->view('usuarios/ver_documentos', $data);
    }
    
    public function subir_documentos(){
    	$this->load->view('usuarios/subir_documentos');
    }

}
