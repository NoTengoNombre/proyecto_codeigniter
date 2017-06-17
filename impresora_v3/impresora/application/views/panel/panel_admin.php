
<div class="w6 STBBody Arial">
 <div>
  <!-- Boton cerrar sesion -->
  <a class="STBInput STBTab STBSombra STBSombraOut margin5 txs6 enlace enlaceRegistro der" 
     href="<?php echo base_url('controlador_usuarios/cerrar_sesion') ?>" 
     title="Salir de la sesion">
   Cerrar Sesión  <i class="fa fa-sign-out"></i>
  </a> 
 </div>

 <div class="clear"></div>

 <div id="menu" class="tag-agroup">

  <nav>
   <ul class="tabs">
    <li class="controlBase Inline tag-btn fondoCeleste bordesArriba">
     <a class="padding3" href="#tab1">USUARIOS</a></li>

    <li class="controlBase Inline tag-btn fondoCeleste bordesArriba">
     <a class="padding3" id="pestania2" href="#tab2">REGISTROS</a></li>

    <li class="controlBase Inline tag-btn fondoCeleste bordesArriba">
     <a class="padding3" href="#tab3">DOCUMENTOS</a></li>

    <br clear="both" />
   </ul>

   <a id="pull" class="labelBase txtcentro" href="#">MENU</a>
  </nav>

  <div class="clear"></div>
 </div>

 <!-- ESTA ES LA PRIMERA PESTAÑA -->
 <div id='tab1' class="contenido_tab w10 bordesGris" >
  <div class="STBAgroup w10">
   <table id='table_id' class="STBTabla w10">
    <thead>
     <tr>
      <th>TIPO</th>
      <th>ID</th>
      <th>NOMBRE</th>
      <th>APELLIDOS</th>
      <th>ACTIVO</th>
      <th>EMAIL</th>
      <th>ACCIONES</th>
     </tr>
    </thead>
    <tbody id="tabla_usuarios">
        <?php
// Contiene todos los datos de la BD    
        foreach ($resultados as $value) {
            ?>

         <tr>
          <!--data-label : se usa para las imagenes responsivas -->
          <td data-label="TIPO"><?php echo $value->tipo; ?><br></td>
          <td data-label="ID"><?php echo $value->usuario_id; ?><br></td>
          <td data-label="NOMBRE"><?php echo $value->nombre; ?><br></td>
          <td data-label="APELLIDOS"><?php echo $value->apellidos; ?><br></td>
          <td data-label="ACTIVO"><?php echo $value->activo; ?><br></td>
          <td data-label="EMAIL"><?php echo $value->email; ?><br></td>
          <td data-label="ACCIONES"> 

           <!--Cuando pulso en el enlace se ejecuta la llamada a AJAX 
               Trae los datos del servidor
           --> 
           <a class="enlace" id="editar" onclick="editar_usuario(<?php echo $value->usuario_id; ?>)" title="Editar">
            <i class="fa fa-pencil"></i>
           </a>

           <a class="enlace" href="<?php echo base_url('controlador_usuarios/user_delete') . "/" . $value->usuario_id; ?>" title="Eliminar">
            <i class="fa fa-trash-o"></i>
           </a>

          </td>
         </tr>
     <?php } ?>
    </tbody>
   </table>

  </div>
 </div>

 <!--  AQUI ESTA EL JQUERY Y EL AJAX QUE TRAE LOS DATOS DEL SERVIDOR PARA METERLOS DENTRO DE LOS CAMPOS  -->
 <script type="text/javascript">

     // Variable para guardar el tipo de metodo que se ejecutara
     var save_method;

     $(document).ready(
             // Funciona : Quita los datos y vuelve a la tabla     
    $(document).on("click", "#borrar", function () {
         $('#form')[0].reset(); // Borra desde el formulario de la 2º pestaña
         $('#report').html('<p id="campos_borrados">Campos borrados</p>');
         $('#campos_borrados').fadeOut(1500);
     }),
         
         $(document).on("click", "#boton_editar", function () {
         $('#report').html('');
         var url; // la variable 'url' almacena el tipo de metodo a lanzar
         url = "<?php echo site_url('index.php/controlador_usuarios/actualizar_usuario') ?>";
         data = {
             'usuario_id': $('#usuario_id').val(),
             'nombre': $('#nombre').val(),
             'apellidos': $('#apellidos').val(),
             'email': $('#email').val(),
             'activo': $('#activo').val(),
             'tipo': $('#tipo').val(),
             'password': $('#password').val()
         };
         // ajax adding data to database
         $.ajax({
             url: url,
             type: "POST",
             data: data
         }).done(function (data) {
             $("#report").html("<h2 class=''>" + data + "</h2>");
             actualizar_tabla_user();
         });
     }),
             $(document).on("click", "#boton_registrar", function () {
         $('#report').html('');
         var url; // la variable 'url' almacena el tipo de metodo a lanzar

         // usa la variable global para ejecutar un metodo u otro
         url = "<?php echo site_url('index.php/controlador_usuarios/add_user_ajax') ?>";

         data = {
             'nombre': $('#nombre').val(),
             'apellidos': $('#apellidos').val(),
             'email': $('#email').val(),
             'activo': $('#activo').val(),
             'tipo': $('#tipo').val(),
             'password': $('#password').val(),
         };
         // ajax adding data to database
         $.ajax({
             url: url,
             type: "POST",
             data: data,
         }).done(function (data) {
             $("#report").html("<h2 class=''>" + data + "</h2>");
             actualizar_tabla_user();
         });
     }),
             );


     function actualizar_tabla_user() {
         url = "<?php echo site_url('index.php/controlador_usuarios/actualizar_tabla') ?>";
         $.ajax({
             url: url,
             type: "POST",
             data: data,
         }).done(function (data) {
             $("#tabla_usuarios").html(data);
         });
     }



     function editar_usuario(id)
     {
         $('#report').html('');
         save_method = 'update';

         $('#form')[0].reset(); // reset form on modals
         $('#pestania2').click().select();


         //Ajax Load data from ajax 
         //TRAE LOS DATOS DEL SERVIDOR
         $.ajax({
             url: "<?php echo site_url('index.php/controlador_usuarios/ajax_edit_user') ?>/" + id, // recibe los datos del controlador
             type: "POST", // metodo get
             dataType: "JSON", // por JSON
             success: function (data) // Aquí estan los datos del SERVIDOR que luego iran añadiendose en el formulario
                     // si funciona el envio desde el controlador "metodo json_encode" ejecuta lo de abajo
                     {
                         $('#usuario_id').val(data["usuario_id"]);
                         $('[name="tipo"]').val(data.tipo);
                         $('[name="nombre"]').val(data.nombre);
                         $('[name="apellidos"]').val(data.apellidos);
                         $('[name="password"]').val(data.password);
                         $('[name="activo"]').val(data.activo);
                         $('[name="email"]').val(data.email);
                     }
         });
     }


 </script> 

 <!-- ESTA ES LA SEGUNDA PESTAÑA
      FORMULARIO PARA AÑADIR UN NUEVO USUARIO -->
 <div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-header">

     <div id="tab2" id="capa2" class="contenido_tab w10 bordesGris">
      <div class="STBAgroup w10">

       <div class="modal-body form">
        <div id="report"></div>
        <!-- Formulario de envio -->
        <!-- -- --><!-- -- --><!-- -- -->
        <form id="form" id="modal_form" class="STBTab w5" action="#">
         <select id="activo" name="activo" class="STBInput STBTab allline margin5 txs6">
          <option value="0" selected>Inactivo</option>       
          <option value="1">Activo</option>    
         </select>
         <select name="tipo" id="tipo" class="STBInput STBTab allline margin5 txs6 margin7">
          <option value="0">Administrador</option>       
          <option value="1">Usuario</option>    
         </select>

         <input type="hidden" id="usuario_id" value="0">
         <input required type="text" id="nombre" name="nombre" class="STBInput STBTab allline margin5 txs6" placeholder="Nombre">
         <input required type="text" id="apellidos" name="apellidos" class="STBInput STBTab allline margin5 txs6" placeholder="Apellidos">
         <input required type="text" id="email" name="email" class="STBInput STBTab allline margin5 txs6" placeholder="Email">

         <input required type="text" id="password" name="password" class="STBInput STBTab allline margin5 txs6" placeholder="contrase&ntilde;a">

         <div class="w5 STBTab">
          <span style="display: inline" id="boton_registrar" type="submit" class="STBInput STBSombra STBSombraOut STBTab allline margin5 txs6 margin2 izq">Registrar Usuario</span>         
          <span style="display: none" id="boton_editar" type="submit" class="STBInput STBSombra STBSombraOut STBTab allline margin5 txs6 margin2 izq">Editar Usuario</span>
          <!--Al pulsar este boton lanza la funcion Jquery para borrar los datos-->
          <span id="borrar" class="STBInput STBSombra STBSombraOut STBTab allline margin5 txs6 margin2 der"  title="borrar">
           <i class="fa fa-trash-o"></i>
          </span>
          <div>
           <div class="clear"></div>
           </form>
          </div>





         </div>
       </div>
      </div>
     </div>
    </div>
   </div>
  </div>

 </div>


 <!-- ESTA ES LA TERCERA PESTAÑA -->
 <div id="tab3" class="contenido_tab w10" >
  <div  class="STBAgroup w10">
      <?php $info = json_decode($info, true); ?>
   <p id="report"></p>
   <table id="tabla_documentos" class="STBTabla STBTabla1 w10">
    <thead>
     <tr>
      <th>ID</th>
      <th>TITULO</th>
      <th>NOMBRE DEL ARCHIVO</th>
      <th>ESTADO</th>
      <th>FECHA DE SUBIDA</th>
      <th>FECHA DE IMPRESION</th>
      <th>NOTAS</th>		
      <th>ID DOCUMENTOS</th>
      <th>ID ARCHIVO</th>
      <th></th>
      <th></th>
     </tr>
    </thead>

    <!--Para el envio usa JSON --> 
    <?php foreach ($info as $info) { ?>
        <tbody>
         <tr class="row" id="row<?php echo $info["id_documento"] ?>">
          <td data-label="ID"> <?php echo $info["usuario_id"] ?><br></td>
          <td data-label="TITULO" id="nombre<?php echo $info["id_documento"] ?>">
           <a class="enlace" href=<?php echo site_url('controlador_documentos/downloadDocument/' . $info["titulo"]) ?> > 
               <?php echo $info["titulo"] ?> 
           </a>
           <br>
          </td>
          <td data-label="NOMBRE DEL ARCHIVO"> <?php echo $info["nombre_archivo"] ?><br></td>
          <td data-label="ESTADO" class="status" value="<?php echo $info["estado"] ?>"><br></td>
          <td data-label="FECHA DE SUBIDA"> <?php echo $info["fecha_creacion"] ?><br></td>
          <td data-label="FECHA DE IMPRESION" class="fechaImpresion"> <?php echo $info["fecha_impresion"] ?><br></td>
          <td data-label="NOTAS"><?php echo $info["notas"] ?><br></td>
          <td data-label="ID DOCUMENTOS" class="id_documento"><?php echo $info["id_documento"] ?><br></td>
          <td data-label="ID ARCHIVOS"><?php echo $info["id_archivo"] ?><br></td>
          <td class="boton" value="<?php echo $info["id_documento"] ?>"> <button class="cambiar_estado">Marcar Impreso</button><br></td>
          <td> <button class="borrar_doc"  value="<?php echo $info["id_documento"] ?>"><i class="fa fa-trash-o"></i></button><br></td>
         </tr>
     <?php } ?>
    </tbody>
   </table>
  </div>
 </div>
 <div id="clear" class="clear"></div>
</div>

<script>
    $(document).ready(function () {
        $(".status").each(function (index, value) {
            if ($(this).attr("value") == "1") {
                $(this).text("Terminado");
                $(this).parent().find(".boton").html("Ya esta impreso");
            } else {
                $(this).text("En espera");
            }
        });

        $(document).on("click", ".cambiar_estado", function () {
            var d = new Date();
            var di = d.getDate();
            var me = d.getMonth();
            var an = d.getFullYear();
            var id = $(this).parent().parent().find(".id_documento").text();
            $(this).parent().parent().find(".status").text("Terminado");
            $(this).parent().parent().find(".fechaImpresion").text(di + "/" + me + "/" + an);
            $(this).parent().html("Ya esta impreso");
            $.ajax({
                url: "<?php echo site_url('controlador_documentos/cambiar_estado/') ?>" + id,
                success: function () {
                    $("#report").html("");
                }
            });
        });

        $(document).on("click", ".borrar_doc", function () {
            id = $(this).attr("value");
            nombre = $("#nombre" + id).text().trim();
            data = {
                "id": id,
                "nombre": nombre
            };
            $.ajax({
                url: "<?php echo site_url('controlador_documentos/borrar_documento') ?>",
                type: "POST",
                data: data
            });
            $("#row" + id).remove();
        });

        $(document).on("click", "#editar", function () {
            $('#report').html('');
            $('#boton_registrar').fadeOut('fast');
            $('#boton_editar').fadeIn();
        });

        $(document).on("click", '#pestania2', function () {
            $('#boton_editar').fadeOut('fast');
            $('#boton_registrar').fadeIn();

        });


    });


</script>