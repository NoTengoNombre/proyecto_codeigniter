<?php

class Controlador_documentos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form', 'url');
        $this->load->model('Modelo_documentos');
    }

    public function uploadDocument() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = 5000;
        $numeroDocumentos = $this->input->post('numeroDocumentos');
        $session=$this->session->get_userdata();
        $idusr = $session['idusr'];
        $this->load->library('upload', $config);
        $archivoId = $this->Modelo_documentos->getLastArchivoId() + 1;
        for ($i = 1; $i < $numeroDocumentos + 1; $i++) {
            echo $i;
            if (!$this->upload->do_upload('documento' . $i)) {
                echo '<h1>no entra</h1>';
                $error = array('error' => $this->upload->display_errors());
            } else {

                echo '<h1>entra</h1>';
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
    	$info = $this->Modelo_documentos->getDocumentInfoUser($idusr);
    	$data = array("info"=>$info);
    	$data['pagina'] = 'usuarios/ver_documentos';
    	$this->load->view('conjunto_vistas', $data);
    }
    
    public function subir_documentos(){
    	$data['pagina'] = 'usuarios/subir_documentos';
    	$this->load->view('conjunto_vistas', $data);
    }
    
    public function cambiar_estado($id){
    	$data = array('estado' => 1);
    	echo $id;
    	$this->db->where('documento_id', $id);
    	$this->db->update('documentos',$data);
    }

}
