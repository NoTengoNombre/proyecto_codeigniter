<!------------------------------>
<!-- LOGIN BASICO DE ENTRADA -->
<!------------------------------>

<!--<link href="<? php echo base_url('public/css/bootstrap.css') ?>" rel="stylesheet">
<script src="<? php echo base_url('public/js/jquery.min.js') ?>"></script>
<script src="<? php echo base_url('public/js/bootstrap.js') ?>"></script>   

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" media="screen" title="no title">

<div role="tabpanel" class="tab-pane" id="profile">
 <div class="row"> 
  <div class="col-md-2">
   <div class="container">
    <div class="row">
     <div class="col-md-4 col-md-offset-4">-->

      <?php
//Mensaje de texto enviado desde metodo index() del Controlador
      if (isset($texto)) {
          echo "<h2>$texto</h2>"; // Muestra el mensaje "Bienvenido a nuestra web app 1"
      }

//Mensaje de texto enviado desde metodo check_login() del Controlador
      if (isset($error)) {
          echo "<h2>$error</h2>";
      }

// Carga la "funcion global" del formulario : no necesita objeto
      $this->load->helper("form");
      ?>

      <!-------------------------------->
      <!--Enviar datos al formulario---->
      <!-------------------------------->

      <?php echo form_open("controlador_usuarios/check_login"); ?>   
      <?php
      $attributes = array(
          'class' => 'form-control',
          'id' => 'exampleInputEmail1',
          'placeholder' => 'Usuario');

      echo form_label("Nombre de Usuario", "usr", $attributes); //crea etiqueta Formulario
      ?>   

      <?php
      $data = array(
          'class' => 'form-control',
          'type' => 'text',
          'id' => 'exampleInputEmail1',
          'placeholder' => "Usuario",
          'name' => 'usr',
          'value' => '');

      echo form_input($data); // crea etiqueta elemento relacionado 
      echo form_error("usr"); // recoge mensaje requerido
      echo '<br>';
      ?>   

      <?php
      $attributes1 = array(
          'class' => 'form-control',
          'id' => 'exampleInputEmail1',
          'placeholder' => "Password");

      echo form_label("Password", "pass", $attributes1); // crea etiqueta elemento relacionado 'pass'
      ?>   

      <?php
      $data1 = array(
          'class' => 'form-control',
          'id' => 'exampleInputPassword1',
          'placeholder' => "Password",
          'name' => 'pass',
          'value' => '');

      echo form_password($data1); // crea etiqueta elemento relacionado
      echo form_error("pass"); // recoge mensaje requerido  
      ?>   

      <?php
      echo '<br>';
      $data2 = array(
          'class' => 'btn btn-success',
          'id' => 'form-control',
          'name' => 'enviar',
          'value' => 'Entrar');

      echo form_submit($data2); // crea elemento enviar
      echo form_close(); // cierra el formulario
      ?>
      
<!-- </div>
    </div>
   </div>
  </div>
 </div>
</div>-->
