<!--Aquí estará el Crud de Usuario-->
<!-- APARECE LA TABLA CON TODOS LOS DATOS DEL USUARIO -->
<script src="<?php echo base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.js') ?>"></script>
<link href="<?php echo base_url('assets/css/bootstrap.css') ?>" rel="stylesheet">

<div>
 <!-- Nav tabs -->
 <ul class="nav nav-tabs" role="tablist">

  <li role="presentation" class="active">
   <a href="#home" aria-controls="home" role="tab" data-toggle="tab">CONSULTA</a>
  </li>
 </ul>

 <!-- Tab panes -->
 <div class="tab-content">

  <div role="tabpanel" class="tab-pane" id="documentos">

   <div class="row">
    <div class="col-md-7">
    </div>
    <div class="col-md-5">
     <span>Espacio en blanco</span>
    </div>
   </div>
   <div class="row">
    <div class="col-md-12">
     <h1>FORMULARIO PARA EDITAR AL USUARIO</h1>
     <?php
     // Conjunto de datos "array" y "VISTA"
     $this->load->view($contenido);
     ?>                
    </div>
   </div> 

  </div>
 </div>
</div>
