<div class="w8 STBAgroup">
 <h1 class="titulo STBTitle margin5">BIENVENIDO A LA APLICACI&Oacute;N</h1>
 <?php
 //Mensaje de texto enviado desde metodo check_login() del Controlador
 if (isset($error)) {
     echo "<h2>$error</h2>";
 }
 // Carga la "funcion global" del formulario : no necesita objeto
 $this->load->helper("form");

 echo form_open("controlador_usuarios/check_login", "class='STBTab w5'");

 $data = array(
     'class' => 'STBInput STBTab allline margin5 txs6',
     'type' => 'text',
//     'id' => '',
     'placeholder' => "USUARIO",
     'name' => 'usr',
     'value' => '');

 echo form_input($data); // crea etiqueta elemento relacionado 
 echo form_error("usr"); // recoge mensaje requerido


 $data1 = array(
     'class' => 'STBInput STBTab allline margin5 txs6',
     'id' => 'exampleInputPassword1',
     'placeholder' => "CONTRASE&Ntilde;A",
     'name' => 'pass',
     'value' => '');

 echo form_password($data1); // crea etiqueta elemento relacionado
 echo form_error("pass"); // recoge mensaje requerido  


 $data2 = array(
     'class' => 'STBInput STBSombra STBSombraOut STBTab allline margin5 txs6',
     'id' => '',
     'name' => 'enviar',
     'value' => 'ENTRAR');

 echo form_submit($data2); // crea elemento enviar
 echo form_close(); // cierra el formulario
 ?>
</div>
