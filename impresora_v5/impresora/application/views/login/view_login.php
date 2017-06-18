<div class="w8 STBAgroup FontSegoe">
 <h1 class="titulo STBTitle margin5">BIENVENIDO A LA APLICACI&Oacute;N DE IMPRESI&Oacute;N</h1>
 <?php
 //Mensaje de texto enviado desde metodo check_login() del Controlador
 if (isset($error)) {
     echo "<h2 class='allline txtcentro'>$error</h2>";
 }
 if (isset($mensaje)) {
     echo "<h2 class='allline txtcentro'>$mensaje</h2>";
 }

 if (isset($activar_admin)) {
     echo '<h2 class="allline txtcentro">' . $activar_admin . '</h2>';
 }

 if (isset($activar_usuario)) {
     echo '<h2 class="allline txtcentro">' . $activar_usuario . '</h2>';
 }



 // Carga la "funcion global" del formulario : no necesita objeto
 $this->load->helper("form");

 echo form_open("controlador_usuarios/check_login", "class='STBTab w5 FontSegoe'");

 $data = array(
     'class' => 'STBInput STBTab allline margin5 txs6',
     'type' => 'text',
     'id' => 'exampleInputPassword1',
     'placeholder' => "EMAIL",
     'name' => 'email',
     'value' => '');

 echo form_error("email"); // recoge mensaje requerido
 echo form_input($data); // crea etiqueta elemento relacionado 



 $data1 = array(
     'class' => 'STBInput STBTab allline margin5 txs6',
     'id' => 'exampleInputPassword1',
     'placeholder' => "CONTRASE&Ntilde;A",
     'name' => 'pass',
     'value' => '');

 echo form_error("pass"); // recoge mensaje requerido
 echo form_password($data1); // crea etiqueta elemento relacionado



 $data2 = array(
     'class' => 'STBInput STBSombra STBSombraOut STBTab allline margin5 txs6 FontSegoe',
     'id' => '',
     'name' => 'enviar',
     'value' => 'ENTRAR');

 echo form_submit($data2); // crea elemento enviar
 echo form_close(); // cierra el formulario
 ?>
 <a class="STBInput STBTab STBSombra STBSombraOut margin5 txs6 enlace enlaceRegistro" href="<?php echo base_url('controlador_usuarios/add_user_invitado'); ?>">Registrarse</a>
</div>



