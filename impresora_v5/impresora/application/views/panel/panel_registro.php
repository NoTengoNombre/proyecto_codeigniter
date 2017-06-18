<!-- Formulario alternativo para registrar usuarios desde el enlace del login -->
<!-- Todo Correcto -->
<div class="STBAgroup w10 FontSegoe">
 <h2 class="titulo STBTitle margin5">PANEL DE REGISTRO</h2>

 <form method="post" class="STBTab w5" action="<?php echo base_url('controlador_usuarios/add_user') ?>">
  <input type="hidden" name="tipo" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Tipo" value="1">
  <input required type="text" name="nombre" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Nombre">
  <input required type="text" name="apellidos" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Apellidos">
  <input required type="password" name="password" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Contrase&ntilde;a">
  <input required type="email" name="email" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Email">
  <input type="hidden" name="activo" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Activo" value="0">
  <button type="submit" class="STBInput STBSombra STBSombraOut STBTab allline margin5 txs6 margin2">Confirmar</button>
 </form>
 <a class="STBInput STBTab STBSombra STBSombraOut margin5 txs6 enlace enlaceRegistro" 
    href="<?php echo base_url('controlador_usuarios/index'); ?>">Volver
 </a>
</div>
   