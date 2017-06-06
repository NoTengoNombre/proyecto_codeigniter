<!-- Esta vista va dentro 'conjunto_vistas'  como $pagina -->
<!--VISTA PARA ACTUALIZAR LOS DATOS MEDIANTE UN FORMULARIO -->
<div class="">
 <div class="">
  <!--ACTUALIZAR DATOS-->
  <!-- CREO UN FORMULARIO y LE DIGO DONDE LO ENVIO -->
  <form method="post" action="<?php echo base_url('controlador_usuarios/actualizar_usuario') ?>">

   <!-- OBTENGO TODOS LOS DATOS del 'MODELO' -->
   <?php
   echo 'Tipo de valor';

   $lista = array();

   foreach ($todos_usuarios as $value) {
// Usa el usuario_id como 'Indice' del array para almacenar el 'tipo'
       $lista[$value->usuario_id] = $value->tipo;

       var_dump($lista);

       echo form_dropdown('tipo', $lista, $value->usuario_id, "class=''");
       ?>

       <!-- Oculto el 'ID'
       SELECCIONO PARA ENVIARLO al metodo del "CONTROLADOR"
       y asi referenciar "usuario" que estoy actualizando -->

       <input type="hidden" name="usuario_id" value="<?php echo $value->usuario_id; ?>">

       <div class="">
        <label for="">Cambiar Tipo de Usuario</label>
       </div>


       <!--       <div class="">
               <label for="">Tipo</label>
               <input type="text" name="tipo" class="" id="" value="< ? php echo $value->tipo; ?>">
              </div>-->

       <div class="">
        <label for="">Nombre</label>
        <input type="text" name="nombre" class="" id="" value="<?php echo $value->nombre; ?>">
       </div>

       <div class="">
        <label for="">Apellidos</label>
        <input type="text" name="apellidos" class="" id="" value="<?php echo $value->apellidos; ?>">
       </div>

       <div class="">
        <label for="">Email</label>
        <input type="text" name="email" class="" id="" value="<?php echo $value->email; ?>">
       </div>

       <div class="">
        <label for="">Telefono</label>
        <input type="text" name="telefono" class="" id="" value="<?php echo $value->telefono; ?>">
       </div>  

   <?php } ?>

   <button type="submit" class="">Actualizar Usuario</button>
  </form>
 </div>
</div>


