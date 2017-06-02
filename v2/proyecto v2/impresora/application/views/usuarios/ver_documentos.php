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
		<?php foreach ($info as $info){	?>
			<tr>
				<td>
					<a  class="enlace" href=<?php echo site_url('controlador_documentos/downloadDocument/' .$info["titulo"])  ?> > <?php echo $info["titulo"] ?> </a>
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