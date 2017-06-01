<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style_usuario.css">
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
<?php
$this->load->helper("form");

echo "<div id='documentos'>";
echo form_open_multipart("controlador_documentos/uploadDocument");
echo form_label("Titulo conjunto", "titulo");
echo "<input type='text' name='nombre' value='" . set_value('titulo') . "'>";

$data = array(
    'name' => 'notas',
    'id' => 'notas_id',
    'value' => '',
    'rows' => '5',
    'cols' => '10',
    'style' => 'width:172px;height:79px;',
);

echo form_label("Notas de Interes", "notas");
echo form_textarea($data);


echo "<div id='subir_documentos'>";
echo "<input type='file' name='documento1'/>";
echo "</div>";

echo "<button type='button' name='addDocument' id='addDocument'>Añadir otro documento</button>";
echo "<input type='hidden' name='numeroDocumentos' id='numeroDocumentos' value='1'/>";
echo "<br>" . form_submit('submit', 'Aceptar', "class='boton'");
echo "<br>" . form_button('regresar', 'Volver');
echo '</div>';
echo form_close();
echo "</div>"
?>

<div  id="archivosSubidos">
 <?php //foreach(){ }?>



</div>



<?php
//   formulario para subir archivos
echo form_open_multipart("controlador_documentos/downloadDocument");
echo form_submit('submit', 'Descargar', "class='boton'");
echo form_close();
?>

<!-- Invocacion de una libreria  -->
<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>;
<script>
    /**
     * @type type
     */
    $(document).ready(function () {
        var num = 2;
        $("#addDocument").click(
                function () {
                    $("#subir_documentos").append("<input type='file' name='documento" + num + "'/>");
                    $("#numeroDocumentos").attr('value', num);
                    num++;
                });
    });
</script>