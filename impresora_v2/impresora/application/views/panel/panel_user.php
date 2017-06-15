<div class="w6 STBBody Arial">
 <div id="subcabecera" class="w8 txs11 STBTitle titulo2 margin2">
     <?php
     $session = $this->session->get_userdata();
     echo "BIENVENIDO " . $session['nombreusr'];
     ?>	
 </div>
 <div id="menu" class="tag-agroup">
  <nav>
   <ul class="tabs">
    <li  class="controlBase Inline tag-btn fondoCeleste bordesArriba">
     <a class="padding3" href="#tab4">SUBIR DOCUMENTOS</a></li>
    <li class="controlBase Inline tag-btn fondoCeleste bordesArriba">
     <a class="padding3" href="#tab5">VER DOCUMENTOS</a></li>
    <br clear="all" />
   </ul>
   <a id="pull" class="labelBase txtcentro" href="#">MENU</a>
  </nav>
  <div class="clear"></div>
 </div>
 <!-- ESTA ES LA PRIMERA PESTAÑA -->
 <div id="tab4" class="contenido_tab w10 bordesGris" >
     <?php $this->load->helper("form"); ?>
  <div id='documentos' class="w6 STBBody Arial">
      <?php
      echo form_open_multipart("controlador_documentos/uploadDocument", "class='STBTab w5'");

      echo "<input type='text' name='nombre' class='STBInput STBTab allline margin5 txs6' value='" . set_value('titulo') . "' placeholder='Titulo'>";

      echo "<div class='cortar' id=subir_documentos>"
      . "<input type='file' name='documento1' class='STBInput STBTab allline margin5 txs6 cortar'/>"
      . "</div>";
      echo "<button type='button' name='addDocument' class='STBInput STBSombra STBSombraOut STBTab allline margin5 txs6' id='addDocument'>A&ntilde;adir otro Archivo</button>";

      $data = array(
          'name' => 'notas',
          'id' => 'notas_id',
          'class' => 'STBInput STBTab allline margin5 txs6 txtizq',
          'placeholder' => 'Escribe alguna nota...',
          'rows' => '8',
          'cols' => '38',
      );

      echo form_textarea($data);
      echo "<input type='hidden' name='numeroDocumentos' id='numeroDocumentos' value='1'/>";
      echo form_submit('submit', 'Aceptar', "class='STBInput STBSombra STBSombraOut STBTab allline margin5 txs6'");

      echo form_close();

      $array = array(
          'onclick' => "location.href='index'",
          'class' => 'STBInput STBSombra STBSombraOut STBTab allline margin5 txs6',
          'value' => 'regresar',
          'type' => 'submit',
          'content' => 'Volver');

      echo form_button($array);
      ?>


   <script src="../assets/js/jquery.min.js"></script>
   <script>
       $(document).ready(function () {
           var num = 2;
           $("#addDocument").click(
                   function () {
                       $("#subir_documentos").append("<input class='STBInput STBTab allline margin5 txs6 cortar' type='file' name='documento" + num + "'/>");
                       $("#numeroDocumentos").attr('value', num);
                       num++;
                   });
       });
   </script>
  </div>
 </div>
 <!-- ESTA ES LA SEGUNDA PESTAÑA -->
 <div id="tab5" class="contenido_tab w10 bordesGris" >
     <?php
     $info = json_decode($info, true);
     ?>
  <script>
      $(document).ready(function () {
          $(".status").each(function (index, value) {
              if ($(this).attr("value") == "1") {
                  $(this).text("Terminado");
              } else {
                  $(this).text("En espera");
              }
          });
      });
  </script>
  <div class="w6 STBBody Arial">
   <div class="STBAgroup w10 ">
    <h1 class="STBTitle">ESTOS SON TUS ARCHIVOS</h1>
    <table class="STBTabla w10">
     <thead>
      <tr>
       <th class="cortar">TITULO</th>
       <th class="cortar">NOMBRE</th>
       <th class="cortar">ESTADO</th>
       <th class="cortar">FECHA DE SUBIDA</th>
       <th class="cortar">FECHA DE IMPRESION</th>
       <th class="cortar">NOTAS</th>
      </tr>
     </thead>
     <?php foreach ($info as $info) { ?>
         <tbody>
          <tr>
           <td data-label="TITULO">
            <a  class="enlace" href=<?php echo site_url('controlador_documentos/downloadDocument/' . $info["titulo"]) ?> > <?php echo $info["titulo"] ?> </a>
           </td>
           <td data-label="NOMBRE"><?php echo $info["nombre_archivo"] ?><br></td>
           <td data-label="ESTADO" class="status" value='<?php echo $info["estado"] ?>'><br></td>
           <td data-label="FECHA DE SUBIDA"> <?php echo $info["fecha_creacion"] ?><br></td>
           <td data-label="FECHA DE IMPRESION"> <?php echo $info["fecha_impresion"] ?><br></td>
           <td data-label="NOTAS"> <?php echo $info["notas"] ?><br></td>
           <!-- <td hidden>< ?php echo $info["id_documento"] ?><br></td>
           <td hidden>< ?php echo $info["id_archivo"] ?><br></td> -->
          </tr>
         </tbody>
     <?php } ?>
    </table>
   </div>
  </div>
 </div>
</div>

