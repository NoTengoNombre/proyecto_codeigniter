<div class="w6 STBBody Arial">
	<div id="menu" class="tag-agroup">
		<nav>
			<ul class="tabs">
				<li  class="controlBase Inline tag-btn fondoCeleste bordesArriba">
					<a class="padding3" href="#tab1">USUARIOS</a></li>
				<li class="controlBase Inline tag-btn fondoCeleste bordesArriba">
					<a class="padding3" href="#tab2">REGISTROS</a></li>
				<li class="controlBase Inline tag-btn fondoCeleste bordesArriba">
					<a class="padding3" href="#tab3">DOCUMENTOS</a></li>
				<br clear="all" />
			</ul>
	   		<a id="pull" class="labelBase txtcentro" href="#">MENU</a>
		</nav>
		<div class="clear"></div>
	
	</div>
		<!-- ESTA ES LA PRIMERA PESTAÑA -->
		<div id="tab1" class="contenido_tab w10 bordesGris" >
			<div class="STBAgroup w10">
				<table class="STBTabla w10">
				    <tr>
					    <th>TIPO</th>
					    <th>ID</th>
					    <th>NOMBRE</th>
					    <th>APELLIDOS</th>
					    <th>EMAIL</th>
					    <th>ACCIONES</th>
					</tr>
				    <?php foreach ($resultados as $value) { ?>
				    <tr>
						<td><?php echo $value->tipo; ?></td>
				        <td><?php echo $value->usuario_id; ?></td>
				        <td><?php echo $value->nombre; ?></td>
				        <td><?php echo $value->apellidos; ?></td>
				        <td><?php echo $value->email; ?></td>
						<td> 
			         		<a href="<?php echo base_url('controlador_usuarios/editar_usuario') . "/" . $value->usuario_id; ?>" title="Editar">
					        	<i class="fa fa-pencil"></i>
							</a>
					        <a href="<?php echo base_url('controlador_usuarios/user_delete') . "/" . $value->usuario_id; ?>" title="Eliminar">
					        	<i class="fa fa-trash-o"></i>
							</a>
				        </td>
			        </tr>
				    <?php } ?>
			   </table>
			</div>
		</div>
		<!-- ESTA ES LA SEGUNDA PESTAÑA -->
		<div id="tab2" class="contenido_tab w10 bordesGris" >
			<div class="STBAgroup w10">
				<form method="get" class="STBTab w5" action="<?php echo base_url('controlador_usuarios/add_user') ?>">
					<select name="tipo" class="STBInput STBTab allline margin5 txs6 margin7">
						<option value="0">Administrador</option>    
				        <option value="1">Usuario</option>    
					</select>
					<input type="text" name="nombre" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Nombre">
					<input type="text" name="apellidos" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Apellidos">
					<input type="text" name="email" class="STBInput STBTab allline margin5 txs6" id="" placeholder="Email">
					<input type="text" name="pass" class="STBInput STBTab allline margin5 txs6" id="" placeholder="contrase&ntilde;a">
					<button type="submit" class="STBInput STBSombra STBSombraOut STBTab allline margin5 txs6 margin2">Registrar Usuario</button>
			    </form>
			</div>
		</div>
		<!-- ESTA ES LA TERCERA PESTAÑA -->
		<div id="tab3" class="contenido_tab w10" >
			<div  class="STBAgroup w10">
				<?php $info=json_decode($info,true); ?>
				<p id="report"></p>
				<table id="tabla_documentos" class="STBTabla w10 table_id">
					<tr>
						<th>ID</th>
						<th>TITULO</th>
						<th>NOMBRE DEL ARCHIVO</th>
						<th>ESTADO</th>
						<th>FECHA DE SUBIDA</th>
						<th>FECHA DE IMPRESION</th>
						<th>NOTAS</th>		
						<th>ID DOCUMENTOS</th>
						<th>ID ARCHIVO</th>
						<th></th>
					</tr>
					<?php foreach ($info as $info){	?>
					<tr class="row">
						<td> <?php echo $info["usuario_id"] ?> </td>
						<td><a class="enlace" href=<?php echo site_url('controlador_documentos/downloadDocument/' .$info["titulo"])  ?> > <?php echo $info["titulo"] ?> </a></td>
						<td> <?php echo $info["nombre_archivo"] ?> </td>
						<td class="status" value="<?php echo $info["estado"] ?>"></td>
						<td> <?php echo $info["fecha_creacion"] ?> </td>
						<td class="fechaImpresion"> <?php echo $info["fecha_impresion"] ?> </td>
						<td><?php echo $info["notas"] ?> </td>
						<td class="id_documento"><?php echo $info["id_documento"] ?></td>
						<td><?php echo $info["id_archivo"] ?></td>
						<td class="boton" value="1"> <button class="cambiar_estado">Marcar Impreso</button></a></td>
					</tr>
					<?php }	?>
				</table>
			</div>
		</div>
		<div id="clear" class="clear"></div>
</div>
<script>
$(document).ready(function(){
	$(".status").each(function(index,value){	
		if($(this).attr("value") == "1"){
			$(this).text("Terminado");
			$(this).parent().find(".boton").html("Ya esta impreso");
		}else{
			$(this).text("En espera");
			}
	});
	$(".cambiar_estado").click(function(){
		var d = new Date();
		var di = d.getDate();
		var me = d.getMonth();
		var an = d.getFullYear();
		
		var id = $(this).parent().parent().find(".id_documento").text();
		$(this).parent().parent().find(".status").text("Terminado");
		$(this).parent().parent().find(".fechaImpresion").text(di+"/"+me+"/"+an);
		$(this).parent().html("Ya esta impreso");
		 
	
		$.ajax({
			url: "<?php echo site_url('controlador_documentos/cambiar_estado/')?>"+id,
			success: function(){
				 $("#report").html("Estado modificado correctamente");

				 
				 },
			});			
		})

		
	
});
</script>

<script>
$(document).ready( function () {
    $('.table_id').DataTable();
} );


</script>

    


 
      
     
