<!--VISTA PARA ACTUALIZAR LOS DATOS MEDIANTE UN FORMULARIO -->
<div class="row">
 <div class="col-md-7 col-md-offset-2">
  <!--ACTUALIZAR DATOS-->
  <!-- CREO UN FORMULARIO y LE DIGO DONDE LO ENVIO -->
  <form method="get" action="<?php echo base_url('controlador_usuarios/update_usuario') ?>">

   <!-- OBTENGO TODOS LOS DATOS del 'MODELO' -->
   <?php foreach ($resultado as $value) { ?>
       <!-- ESCONDO EL 'ID' y LO SELECCIONO PARA ENVIARLO -->
       <input type="hidden" name="usuario_id" value="<?php echo $value->usuario_id; ?>">
   <?php } ?>

   <div class="form-group">
    <label for="exampleInputEmail1">Perfil Para Cambiar</label>   
    <?php
    $lista = array();
// Objeto que viene del controlador
    foreach ($resultado as $registro) {
        $lista[$registro->usuario_id] = $registro->nombre;
    }
//        Crear un desplegable
    echo form_dropdown('usuario_id', $lista, $value->usuario_id, 'class="form-control"');
    ?>

   </div>

   <div class="form-group">
    <label>Usuario_id</label>
    <input type="text" name="txtUsuid" value="<?php echo $value->usuario_id; ?>">
   </div>
       
   <div class="form-group">
    <label>Nombre</label>
    <input type="text" name="txtNombre" value="<?php echo $value->nombre; ?>">
   </div>

   <div class="form-group">
    <label>Apellidos</label>
    <input type="text" name="txtApellidos" value="<?php echo $value->apellidos; ?>">
   </div>

   <div class="form-group">
    <label>Password</label>
    <input type="text" name="txtPassword" value="<?php echo $value->password; ?>">
   </div>  

   <div class="form-group">
    <label>Fotografía</label>
    <input type="text" name="txtFotografia" value="<?php echo $value->fotografia; ?>">
   </div>  

   <div class="form-group">
    <label>Telefono</label>
    <input type="text" name="txtTelefono" value="<?php echo $value->telefono; ?>">
   </div>  

   <div class="form-group">
    <label>Email</label>
    <input type="text" name="txtEmail" value="<?php echo $value->email; ?>">
   </div>  

   <div class="form-group">
    <label>Tipo</label>
    <input type="text" name="txtTipo" value="<?php echo $value->tipo; ?>">
   </div>  

   <button type="submit">Actualizar Usuario</button>
  </form>
 </div>
</div>


