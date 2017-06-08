<!-- Formulario alternativo para registrar usuarios desde el enlace del login -->
<!-- Todo Correcto -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">
<br>
<div class="container">
 <div class="row">
  <div class="col-md-4 col-md-offset-4">
   <div class="login-panel panel panel-success">
    <div class="panel-heading">
     <h3 class="panel-title"><center>Panel de Registro</center></h3>
    </div>
    <div id="tab2" class="contenido_tab w10 bordesGris" >
     <div class="STBAgroup w10">
      <form method="post" class="STBTab w5" action="<?php echo base_url('controlador_usuarios/add_user') ?>">
       <center>
        <input type="hidden" name="tipo" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Tipo" value="0">
        <br>
        <input type="text" name="nombre" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Nombre">
        <br>
        <input type="text" name="apellidos" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Apellidos">
        <br>
        <input type="text" name="password" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Contrase&ntilde;a">
        <br>
        <input type="text" name="email" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Email">
        <br>
        <input type="hidden" name="fotografia" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Fotografia" value="no">
        <input type="number" name="telefono" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Telefono">
        <br>
        <br>
        <button type="submit" class="STBInput STBSombra STBSombraOut STBTab allline margin5 txs6 margin2">Registrar Usuario</button>
      </form>
     </div>
    </div>
    <center><b>¿ Ya te has registrado ?</b> <br> </b>
     <a href="<?php echo base_url('Controlador_usuarios'); ?>">Logueate </a></center><!--for centered text-->
    </center>

   </div>
  </div>
 </div>
</div>

<!-- Fin de la Pestaña -->