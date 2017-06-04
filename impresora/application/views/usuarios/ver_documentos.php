<?php
#Decodifica el valor en JSON-String que viene a 'array['asociativo']'
$info = json_decode($info, true);

/**
  'id_archivo' => string '0' (length=1)
  'nombre_archivo' => string 'archivo nuevo' (length=13)
  'id_documento' => string '28' (length=2)
  'documento_id' => string '28' (length=2)
  'titulo' => string 'Druida4.pdf' (length=11)
  'fecha_impresion' => string '0000-00-00 00:00:00' (length=19)
  'notas' => string 'notas del documento' (length=19)
  'estado' => string '1' (length=1)
  'usuario_id' => string '1' (length=1)
  'fecha_creacion' => string '0000-00-00 00:00:00' (length=19)
 */

?>
<script src="../assets/js/jquery.min.js"></script>
<script>

    /**
     * @param {type} index
     * @param {type} value
     * @returns {undefined}
     */
    $(document).ready(function () {
        
        $(".status").each(function (index, value) {
            if ($(this).attr("value") == "1") {
                $(this).text("Terminado");
            } else {
                $(this).text("En espera");
            }
        });
    });
</script>

<div class="w6 STBBody Arial">
 <div class="STBAgroup w10 ">
  <h1 class="STBTitle">ESTOS SON TUS ARCHIVOS</h1>

  <table class="STBTabla w10">
   <tr>
    <th class="cortar">TITULO</th>
    <th class="cortar">NOMBRE</th>
    <th class="cortar">ESTADO</th>
    <th class="cortar">FECHA DE SUBIDA</th>
    <th class="cortar">FECHA DE IMPRESION</th>
    <th class="cortar">NOTAS</th>
   </tr>

   <!-- Array['asociativo'] con todos los valores convertidos en array['indice'] -->
   <?php foreach ($info as $info) { ?>
       <tr>
        <td>
         <!--Le pasamos el array['asociativo'] para que cuando lo recorra aparezca el nombre -->
         <a class="enlace" href=<?php echo site_url('controlador_documentos/downloadDocument/'. $info["titulo"]) ?> > 
             <?php echo $info["titulo"] ?> 
         </a>
        </td>
        <td> <?php echo $info["nombre_archivo"] ?> </td>
        <td class="status" value='<?php echo $info["estado"] ?>'> </td>
        <td> <?php echo $info["fecha_creacion"] ?> </td>
        <td> <?php echo $info["fecha_impresion"] ?> </td>
        <td> <?php echo $info["notas"] ?> </td>
        <td hidden> <?php echo $info["id_documento"] ?> </td>
        <td hidden> <?php echo $info["id_archivo"] ?> </td>
       </tr>
   <?php } ?>
  </table>
  
 </div>
</div>