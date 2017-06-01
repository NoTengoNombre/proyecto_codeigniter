<!-- ---------------------------------------------------------------------- -->
<!-- AQUI SE MUESTRA 'usuario/edit' y ------------------------------------- -->
<!-- --------------- 'usuario/registro' ----------------------------------- -->
<!-- ---------------------------------------------------------------------- -->
<div>
 <div>
  <h1>CRUD CON CODEIGNITER 3 + BOOTSTRAP + MYSQL</h1>
  <?php
  // Carga 'VISTA' que dependiendo de la funcion , puede ser : 
  // $contenido = 'usuario/regitro'
  // $contenido = 'usuario/edit'
  $this->load->view($contenido);
  ?>                
 </div>
</div> 
<!-- ----------------------------------------------------------------------- -->
