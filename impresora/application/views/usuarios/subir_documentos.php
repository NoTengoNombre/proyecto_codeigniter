<!--<? php $this->load->helper("form"); ?>-->
<div id='documentos' class="w6 STBBody Arial">
 <?php
#Formulario
 echo form_open_multipart("controlador_documentos/uploadDocument", "class='STBTab w5'");
#3º Ejecutar : Cuando pulse el input subir archivo se lanzará el evento asignado dentro de JQUERY
 echo "<input type='text' name='nombre' class='STBInput STBTab allline margin5 txs6' value='" . set_value('titulo') . "' placeholder='Titulo del Archivo'>";
#2º Ejecutar : Cuando pulse el input subir archivo se lanzará el evento asignado dentro de JQUERY
 echo "<div id=subir_documentos>"
#4º Cuando se pulsa el boton 'addDocument' se cambia el 'name=documento1' -> 'name=documento2' por el uso del JQUERY      
 . "<input type='file' name='documento1' class='STBInput STBTab allline margin5 txs6 cortar'/>"
 . "</div>";
#1º Ejecutar : Cuando pulse el boton se lanzará 
 echo "<button type='button' name='addDocument' class='STBInput STBSombra STBSombraOut STBTab allline margin5 txs6' id='addDocument'>A&ntilde;adir otro Archivo</button>";

 $data = array(
     'name' => 'notas',
     'id' => 'notas_id',
     'class' => 'STBInput STBTab allline margin5 txs6 txtizq',
     'value' => 'Escribe alguna nota...',
     'rows' => '8',
     'cols' => '38',
 );

//El formulario lleva agregado el 'name = notas'     
 echo form_textarea($data);
//Input oculto - name='numeroDocumentos'       
 echo "<input type='hidden' name='numeroDocumentos' id='numeroDocumentos' value='1'/>";
 echo form_submit('submit', 'Aceptar', "class='STBInput STBSombra STBSombraOut STBTab allline margin5 txs6'");
 echo form_button('regresar', 'Volver', "class='STBInput STBSombra STBSombraOut STBTab allline margin5 txs6'");
 echo form_close();
 ?>

 <script src="../assets/js/jquery.min.js"></script>
 <script>
     /**
      * Al lanzar evento
      * @type type
      */
     $(document).ready(function () {
         var num = 2;
         $("#addDocument").click(
                 function () {
                     $("#subir_documentos").append("<input type='file' class='STBInput STBTab allline margin5 txs6 cortar' name='documento" + num + "'/>");
                     $("#numeroDocumentos").attr('value', num); // incrementa el valor de 'value' lo cual es diferente cada vez que se pulsa el botón
                     num++;
                 });
     });
 </script>
</div>