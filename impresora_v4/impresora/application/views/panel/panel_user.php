<div class="w6 STBBody Arial">
 <div id="subcabecera" class="w8 txs11 STBTitle titulo2 margin2">
     <?php
     $session = $this->session->get_userdata();
     echo "BIENVENIDO " . $session['nombreusr'];
     ?>	
 </div>
 <div>
      <a class="STBInput STBTab STBSombra STBSombraOut margin5 txs6 enlace enlaceRegistro der" href="<?php echo base_url('controlador_usuarios/cerrar_sesion') ?>" title="Salir de la sesion">
        Cerrar Sesión  <i class="fa fa-sign-out"></i>
      </a> 
    </div>
    <div class="clear"></div>
 <div id="menu" class="tag-agroup">
  <nav>
   <ul class="tabs">
    <li  class="controlBase Inline tag-btn fondoCeleste bordesArriba">
     <a class="padding3 tb" href="#tab4">SUBIR DOCUMENTOS</a></li>
    <li class="controlBase Inline tag-btn fondoCeleste bordesArriba">
     <a class="padding3 tb" href="#tab5">VER DOCUMENTOS</a></li>
    <br clear="all" />
   </ul>
   <a id="pull" class="labelBase txtcentro" href="#">MENU</a>
  </nav>
  <div class="clear"></div>
 </div>
 <!-- ESTA ES LA PRIMERA PESTAÑA -->
 <div id="tab4" class="contenido_tab w10 bordesGris" >
<div id="report">  <?php echo $mensaje ?> </div>
     <?php $this->load->helper("form"); ?>
  <div id='documentos' class="w6 STBBody Arial">
  	<h3 class='allline txtcentro'>Solo se permiten .pdf con un tamaño maximo de 5Mb</h3>
      <?php
      echo form_open_multipart("controlador_documentos/uploadDocument", "class='STBTab w5'");

      echo "<input required type='text' name='nombre' class='STBInput STBTab allline margin5 txs6' value='" . set_value('titulo') . "' placeholder='Titulo'>";

      echo "<div id=subir_documentos>"
      . "<input  required type='file' name='documento1' class='STBInput STBTab allline margin5 txs1 '/>"
      . "</div>";
      echo "<button type='button' name='addDocument' class='STBInput STBSombra STBSombraOut STBTab allline margin5 txs6' id='addDocument'>A&ntilde;adir otro Archivo</button>";

      $data = array(
          'name' => 'notas',
          'id' => 'notas_id',
          'class' => 'STBInput STBTab allline margin5 txs6 txtizq',
          'placeholder' => 'Escribe alguna nota...',
          'rows' => '8',
          'cols' => '27',
      );

      echo form_textarea($data);
      echo "<input type='hidden' name='numeroDocumentos' id='numeroDocumentos' value='1'/>";
      echo form_submit('submit', 'Aceptar', "class='STBInput STBSombra STBSombraOut STBTab allline margin5 txs6'");

      echo form_close();

      ?>


   <script src="../assets/js/jquery.min.js"></script>
   <script>
       $(document).ready(function () {
           var num = 2;
           $(document).on("click","#addDocument",function(){
						$("#report").remove();
                        $("#subir_documentos").append("<input class='STBInput STBTab allline margin5 txs1' type='file' name='documento" + num + "'/>");
                        $("#numeroDocumentos").attr('value', num);
                        num++;
                   });
           
           $(document).on("click",".tb",function () {
        	   $("#report").html("");
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
       <th >TITULO</th>
       <th >NOMBRE</th>
       <th >ESTADO</th>
       <th >FECHA DE SUBIDA</th>
       <th >FECHA DE IMPRESION</th>
       <th >NOTAS</th>
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

