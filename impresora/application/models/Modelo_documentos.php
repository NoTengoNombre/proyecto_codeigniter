<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_documentos extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Subir archivos
     * 
     * @param type $data ARRAY
     * @param type $archivoId
     * @param type $idusr
     */
    public function uploadDocument($data, $archivoId, $idusr) {

        $date = date('d/m/Y', time()); // devuelve 'String'
//'Array Asociativo'   
        $documentos = array(
            'titulo' => $data['url'], // contiene la url
            'notas' => $data['notas'], // cotiene las notas
            'estado' => 0,
            'usuario_id' => $idusr,
            'fecha_creacion' => $date, // objeto fecha
            'fecha_impresion' => "Sin Imprimir", // objeto fecha
        );

        $this->db->set($documentos); // permite establecer valores para insercciones/actualizaciones
        $this->db->insert('documentos');

//'Array Asociativo'   
        $archivos = array(
            'id_archivo' => $archivoId,
            'id_documento' => $this->db->insert_id(),
            'nombre_archivo' => $data['nombreConjunto'], // contiene 
        );

        $this->db->set($archivos);
        $this->db->insert('archivo'); // BD donde insertar los datos
    }

    /**
     * Devuelve el numero que tiene el id_archivo
     * 
     * @return int
     */
    public function getLastArchivoId() {

        $this->db->select('id_archivo');
        $this->db->order_by('id_archivo', 'DESC');
        $this->db->limit(1);

//Obtiene todos los datos de la tabla 'archivo'        
        $query = $this->db->get('archivo');

//Convierte los datos de la tabla 'archivo' en 'Array'
        $lastId = $query->result_array(); //result_array - SI NO TIENE VALORES DEVUELVE FALSE        
//Si devuelve falso entra en la condicion y regresa 1
        if (!$lastId) {
            return 1; // El último archivo será el 1º 
        } else {
//Si devuelve 'array' el valor sera el que tenga la fila '0'            
//                        Fila   Columna
            return $lastId[0]['id_archivo']; // devuelve una fila distinta de 1  
        }
    }

    /**
     * Usa la funcion helper('download')
     * 
     * Para descargar archivo desde 'uploads'
     * 
     * @param type $name
     */
    public function downloadDocument($name) {
        $this->load->helper('download');
//Genera encabezados que fuerzan a realizar la descarga        
        force_download('uploads/' . $name, NULL);
    }

    /**
     * Info del documentos para el panel de admin
     * 
     * @return type Regresa Array con valores BD
     */
    public function getDocumentInfo() {
// todos los campos
        $this->db->select('*');

        $this->db->join('documentos', 'documentos.documento_id = archivo.id_documento');
        $this->db->join('usuarios', 'documentos.usuario_id = usuarios.usuario_id');

        $query = $this->db->get('archivo'); // select * from archivo - Filtrando por documento y usuarios
//Devuelve el registro de la BD como 'array['indices']'        
        $docInfo = $query->result_array();

//Codifica el ARRAY a JSON-Sring        
        $docInfoJson = json_encode($docInfo);
//Regresa Array con valores BD
        return $docInfoJson;
    }

    /**
     * Info documentos del usuario mediante el $idusr
     * 
     * @param type $idusr
     * @return type
     */
    public function getDocumentInfoUser($idusr) {
// todos los campos
        $this->db->select('*');
// Le pasamos el $idusr para hacer la seleccion      
        $this->db->join('documentos', 'documentos.documento_id = archivo.id_documento and usuario_id = ' . $idusr);
// selecciono la tabla 'archivo'
        $query = $this->db->get('archivo');
// Devuelve un array['indice'] 
        $docInfo = $query->result_array();
// codifica a Array-String - JSON-String
        $docInfoJson = json_encode($docInfo);
// devuelve 'Array Asociativo' 
        return $docInfoJson;
    }

}
