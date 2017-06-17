 <?php
 foreach ($resultados as $value) {
          ?>
         
            <tr>
              <td data-label="TIPO"><?php echo $value->tipo; ?><br></td>
              <td data-label="ID"><?php echo $value->usuario_id; ?><br></td>
              <td data-label="NOMBRE"><?php echo $value->nombre; ?><br></td>
              <td data-label="APELLIDOS"><?php echo $value->apellidos; ?><br></td>
              <td data-label="ACTIVO"><?php echo $value->activo; ?><br></td>
              <td data-label="EMAIL"><?php echo $value->email; ?><br></td>
              <td data-label="ACCIONES"> 

                <!--Cuando pulso en el enlace se ejecuta la llamada a AJAX 
                    Trae los datos del servidor--> 
                <a class="enlace" id="editar" onclick="editar_usuario(<?php echo $value->usuario_id; ?>)" title="Editar">
                  <i class="fa fa-pencil"></i>
                </a>

                <a class="enlace" href="<?php echo base_url('controlador_usuarios/user_delete') . "/" . $value->usuario_id; ?>" title="Eliminar">
                  <i class="fa fa-trash-o"></i>
                </a>

              </td>
            </tr>
          <?php } ?>