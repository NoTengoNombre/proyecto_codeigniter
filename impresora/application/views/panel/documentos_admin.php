<!--
    @Created on : 25-may-2017, 20:33:30
    @Author     : RVS - N.F.N.D - Home
    @Pag        :
    @version    :
    @TODO       :
-->
<!DOCTYPE html>
<html>
 <head>
  <meta charset="UTF-8">
  <title></title>
 </head>
 <body>
     <?php
     
//     echo json_decode('info');
     echo $texto;
     
        foreach ($documentos as $valor) { ?>
            <tr>
             <td><?php echo $valor->documento_id; ?></td>
             <td><?php echo $valor->titulo; ?></td>
             <td><?php echo $valor->fecha_impresion; ?></td>
             <td><?php echo $valor->notas; ?></td>
             <td><?php echo $valor->estado; ?></td>
             <td><?php echo $valor->usuario_id; ?></td>
             <td><?php echo $valor->fecha_creacion; ?></td>
             <!---------------------------------------------------------------------------->
             <td> 
           <center>
            <!--<a href="< ?php echo base_url('usuario/delete') . "/" . $valor->documento_id; ?>" title="Eliminar">-->
             <!--<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>-->
            </a>

            <!--<a href="< ?php echo base_url('usuario/edit') . "/" . $valor->documento_id; ?>" title="Editar">-->
             <!--<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>-->
            </a>
           </center>
           </td>
           </tr>
           
       <?php } ?>

     
 </body>
</html>
