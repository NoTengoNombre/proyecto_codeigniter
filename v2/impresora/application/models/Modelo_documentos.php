<?php

class Modelo_documentos extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function uploadDocument($data, $archivoId, $idusr) {

        $date = date('d/m/Y', time());

        $documentos = array(
            'titulo' => $data['url'],
            'notas' => $data['notas'],
            'estado' => 0,
            'usuario_id' => $idusr,
            'fecha_creacion' => $date,
        );

        $this->db->set($documentos);
        $query = $this->db->insert('documentos');


        $archivos = array(
            'id_archivo' => $archivoId,
            'id_documento' => $this->db->insert_id(),
            'nombre_archivo' => $data['nombreConjunto'],
        );
        $this->db->set($archivos);
        $this->db->insert('archivo');
    }

    public function getLastArchivoId() {
        $this->db->select('id_archivo');
        $this->db->order_by('id_archivo', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('archivo');
        $lastId = $query->result_array();
        if (!$lastId) {
            return 1;
        } else {
            
            return $lastId[0]['id_archivo'];
        }
    }

    public function downloadDocument($name) {
        $this->load->helper('download');
        force_download('uploads/' . $name, NULL);
    }

    //Info documentos para el panel de admin
    public function getDocumentInfo() {
        $this->db->select('*');
        $this->db->join('documentos', 'documentos.documento_id = archivo.id_documento');
        $this->db->join('usuarios', 'documentos.usuario_id = usuarios.usuario_id');
        $query = $this->db->get('archivo');
        $docInfo = $query->result_array();
        $docInfoJson = json_encode($docInfo);
        return $docInfoJson;
    }
    
    //Info documentos del propio usuario
        public function getDocumentInfoUser($idusr) {
        $this->db->select('*');
        $this->db->join('documentos', 'documentos.documento_id = archivo.id_documento and usuario_id = '.$idusr);
        $query = $this->db->get('archivo');
         
        $docInfo = $query->result_array();
        $docInfoJson = json_encode($docInfo);
        return $docInfoJson;
    }
    

}
