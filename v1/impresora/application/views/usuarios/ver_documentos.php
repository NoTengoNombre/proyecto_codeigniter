<?php
$info=json_decode($info,true);
?>
<script src="../assets/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
		$(".status").each(function(index,value){	

			if($(this).attr("value") == "1"){
				$(this).text("Terminado");
			}
			else{
				$(this).text("En espera");
			}
		});	
});
</script>

<table>
<tr><th>Titulo</th><th>Nombre Archivo</th><th>Estado</th><th>Fecha subida</th><th>Fecha Impresion</th><th>Notas</th></tr>
<?php
foreach ($info as $info){

	?>
	<tr>
	<td><a href=<?php echo site_url('controlador_documentos/downloadDocument/' .$info["titulo"])  ?> > <?php echo $info["titulo"] ?> </a></td>
	<td> <?php echo $info["nombre_archivo"] ?> </td>
	<td class="status" value='<?php echo $info["estado"] ?>'> </td>
	<td> <?php echo $info["fecha_creacion"] ?> </td>
	<td> <?php echo $info["fecha_impresion"] ?> </td>
	<td> <?php echo $info["notas"] ?> </td>
	<td hidden> <?php echo $info["id_documento"] ?> </td>
	<td hidden> <?php echo $info["id_archivo"] ?> </td>
	</tr>
	<?php
}
?>
</table>