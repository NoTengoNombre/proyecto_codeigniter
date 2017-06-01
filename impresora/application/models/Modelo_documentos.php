<?php

class Modelo_documentos extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 
     * @param type $data
     * @param type $archivoId
     * @param type $idusr
     */
    public function uploadDocument($data, $archivoId, $idusr) {

//Devuelve un string
        $date = date('d/m/Y', time());

//Datos 'documentos' que se quieren fijar en la bd        
        $documentos = array(
            'titulo' => $data['url'],
            'notas' => $data['notas'],
            'estado' => 0,
            'usuario_id' => $idusr,
            'fecha_creacion' => $date,
        );  
        
        //set - Permite establecer valores para insert o update
        $this->db->set($documentos);
        $this->db->insert('documentos');

//Datos 'archivo' que se quieren fijar en la bd        
        $archivos = array(
            'id_archivo' => $archivoId,
//El número ID de la inserción al ejecutar inserciones en la base de datos.
            'id_documento' => $this->db->insert_id(),
            'nombre_archivo' => $data['nombreConjunto'],
        );
        
        $this->db->set($archivos);
        $this->db->insert('archivo');
    }

    /**
     * 
     * @return int
     */
    public function getLastArchivoId() {
        
        $this->db->select('id_archivo'); // selecciona el elemento
        $this->db->order_by('id_archivo', 'DESC'); //ordena el elemento
        $this->db->limit(1); // saca solo 1 valor

        $query = $this->db->get('archivo');
//         Obtiene una fila de resultados como un array asociativo, numérico, o ambos
        $lastId = $query->result_array();

        if (!$lastId) {
            return 1;
        } else {
//          regresa la posicion del archivo
            return $lastId[0]['id_archivo'];
        }
    }

    /**
     * Descarga documento de la ruta indicada
     * mediante argumento 'string'
     * 
     * @param type $name
     */
    public function downloadDocument($name) {
        $this->load->helper('download');
// descarga archivo del servidor al escritorio
        force_download('uploads/' . $name, NULL);
    }

    /**
     * Obtiene todos los campos de los documentos relacionado con el usuario 
     * de la BD y lo devuelve como un 'String' de JSON
     * 
     * @return type String
     */
    public function getDocumentInfo() {
        
        $this->db->select('*'); // selecciona todos los campos
        $this->db->join('documentos', 'documentos.documento_id = archivo.id_documento');
        $this->db->join('usuarios', 'documentos.usuario_id = usuarios.usuario_id');

// obtiene un objeto        
        $query = $this->db->get('archivo');

        $docInfo = $query->result_array(); // devuelve un array con todos los elementos
        $docInfoJson = json_encode($docInfo); // codifica el array a String
        return $docInfoJson; // devuelve String en formato JSON
    }

    /**
     * Devuelve todos los documentos asociados a 'idusr' del archivo
     * 
     * @param type $idusr
     * @return type array de string
     */
    public function getDocumentInfoUser($idusr) {
        
        $this->db->select('*'); // selecciona todos los campos
        $this->db->join('documentos', 'documentos.documento_id = archivo.id_documento and usuario_id = ' . $idusr);
        $query = $this->db->get('archivo');

        $docInfo = $query->result_array(); // devuelve un array con todos los elementos
        $docInfoJson = json_encode($docInfo);
        return $docInfoJson;
    }

}

// Sintaxis del metodo
//string json_encode ( mixed $value [, int $options = 0 [, int $depth = 512 ]] )

