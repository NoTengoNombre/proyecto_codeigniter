<!--Aquí estará el Crud de Usuario-->
<!-- APARECE :
    PESTAÑA : 'CONSULTA' TABLA CON TODOS LOS DATOS DEL USUARIO 
    PESTAÑA : 'REGISTRO' FORMULARIO PARA AÑADIR USUARIOS
    PESTAÑA : 'DOCUMENTOS' TABLA CON TODOS LOS DOCUMENTOS
-->

<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>
<link href="<?php echo base_url('assets/css/bootstrap.css') ?>" rel="stylesheet">

<div>
 <!-- 3 PESTAÑAS : Nav tabs -->
 <ul class="nav nav-tabs" role="tablist">

  <li role="presentation" class="active">
   <a href="#home" aria-controls="home" role="tab" data-toggle="tab">CONSULTA</a>
  </li>

  <li role="presentation">
   <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">REGISTRO</a>
  </li>    

  <li role="presentation">
   <a href="#documentos" aria-controls="documentos" role="tab" data-toggle="tab">DOCUMENTOS</a>
  </li>  
 </ul>

 <!-- Tab panes -->
 <div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="home">

   <table class="table table-hover">
    <!-- TABLA PARA LISTAR USUARIOS -->
    <h3>Tabla para listar usuarios</h3>

    <thead>

    <th>Tipo</th>
    <th>Usuario_id</th>
    <th>Nombre</th>
    <th>Apellidos</th>
    <th>Fotografia</th>
    <th>Telefono</th>
    <th>Email</th>
    <th>
    <center>Acciones</center>
    </th>

    </thead>

    <tbody>
     <!-- Saca todos los DATOS del 'Modelo_usuarios' enviado desde el Controlador::check_login -->
     <?php foreach ($resultados as $value) { ?>
         <tr>
          <td><?php echo $value->tipo; ?></td>
          <td><?php echo $value->usuario_id; ?></td>
          <td><?php echo $value->nombre; ?></td>
          <td><?php echo $value->apellidos; ?></td>
          <td><?php echo $value->fotografia; ?></td>
          <td><?php echo $value->telefono; ?></td>
          <td><?php echo $value->email; ?></td>

          <!---------------------------------------------------------------------------->
          <td> 
        <center>
         <!--Al pulsar Envia al Controlador el ID al metodo edit-->
         <a href="<?php echo base_url('controlador_usuarios/editar_usuario') . "/" . $value->usuario_id; ?>" title="Editar">
          <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
         </a>

         <a href="<?php echo base_url('controlador_usuarios/delete_usuario') . "/" . $value->usuario_id; ?>" title="Eliminar">
          <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
         </a>
        </center>
        </td>
        </tr>
    <?php } ?>

    </tbody>
   </table>
  </div>
  <!--- -------------------------------------------------------------------- -->
  <!--- -------------------------------------------------------------------- -->
  <!--- -------------------------------------------------------------------- -->
  <!-- FORMULARIO DE REGISTRO -->
  
  <div role="tabpanel" class="tab-pane" id="profile">
   <div class="row">
    <div class="col-md-7">

     <h3>Formulario de registro</h3>

     <!-- Manda la orden al CONTROLADOR -->
     <form method="get" action="<?php echo base_url('controlador_usuarios/aniadir_usuario') ?>">

      <div class="form-group">
       <label for="exampleInputEmail1">Tipo de usuario</label>
       <select name="tipo" class="form-control">
        <option value="0">Administrador</option>    
        <option value="1">Usuario</option>    
       </select>
      </div>

      <div class="form-group">
       <label for="exampleInputEmail1">Nombre</label>

       <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" placeholder="Nombre">
      </div>

      <div class="form-group">
       <label for="exampleInputEmail1">Apellidos</label>
       <input type="text" name="apellidos" class="form-control" id="exampleInputEmail1" placeholder="Apellidos">
      </div>

      <div class="form-group">
       <label for="exampleInputEmail1">Password</label>
       <input type="text" name="password" class="form-control" id="exampleInputEmail1" placeholder="Password">
      </div>

      <div class="form-group">
       <label for="exampleInputEmail1">Correo Electrónico</label>
       <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email">
      </div>

      <div class="form-group">
       <label for="exampleInputEmail1">Fotografia</label>
       <input type="text" name="fotografia" class="form-control" id="exampleInputEmail1" placeholder="Fotografia">
      </div>

      <div class="form-group">
       <label for="exampleInputPassword1">Telefono</label>
       <input type="text" name="telefono" class="form-control" id="exampleInputPassword1" placeholder="Telefono">
      </div>

      <br>
      <button type="submit" class="btn btn-default">Registrar Usuario</button>
     </form>
    </div>
    <!--- -------------------------------------------------------------------- -->
    <!--- -------------------------------------------------------------------- -->
    <!--- -------------------------------------------------------------------- -->
    <!--- -------------------------------------------------------------------- -->
    <div class="col-md-5">
     <span>Espacio en blanco</span>
    </div>
   </div>
  </div>


  <div role="tabpanel" class="tab-pane" id="documentos">
   <div class="row">
    <div class="col-md-7">
     <div role="tabpanel" class="tab-pane active" id="home">

      <table class="table table-hover">
       <tr>
        <th>Id Usuario</th>
        <th>Titulo</th>
        <th>Nombre Archivo</th>
        <th>Estado</th>
        <th>Fecha subida</th>
        <th>Fecha Impresion</th>
        <th>Notas</th>
        <th>Id Documento</th>
        <th>Id Archivo</th>
       </tr>

       <?php
//      ($info, true) --> 'true' - Devuelve un array asociativo
       $info = json_decode($info, true);

       foreach ($info as $info) {
           ?>
           <tr>
            <td> <?php echo $info["usuario_id"] ?> </td>

            <td>
             <a href=<?php echo site_url('controlador_documentos/downloadDocument/' . $info["titulo"]) ?> >
                 <?php echo $info["titulo"] ?> 
             </a>
            </td>

            <td> <?php echo $info["nombre_archivo"] ?> </td>
            <td> <?php echo $info["estado"] ?> </td>
            <td> <?php echo $info["fecha_creacion"] ?> </td>
            <td> <?php echo $info["fecha_impresion"] ?> </td>
            <td> <?php echo $info["notas"] ?> </td>
            <td> <?php echo $info["id_documento"] ?> </td>
            <td> <?php echo $info["id_archivo"] ?> </td>
           </tr>

           <?php
       }
       ?>
      </table>
     </div>
    </div>
    <div class="col-md-5">
     <span>Espacio en blanco</span>
    </div>
   </div>
  </div>
 </div>
</div>
