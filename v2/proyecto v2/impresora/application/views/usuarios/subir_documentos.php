<?php $this->load->helper("form"); ?>
<div id='documentos' class="w6 STBBody Arial">
	<?php 
	echo form_open_multipart("controlador_documentos/uploadDocument", "class='STBTab w5'");
	echo "<input type='text' name='nombre' class='STBInput STBTab allline margin5 txs6' value='" . set_value('titulo') . "' placeholder='Titulo del Archivo'>";
	
	echo "<div id=subir_documentos><input type='file' name='documento1' class='STBInput STBTab allline margin5 txs6 cortar'/></div>";
	echo "<button type='button' name='addDocument' class='STBInput STBSombra STBSombraOut STBTab allline margin5 txs6' id='addDocument'>A&ntilde;adir otro Archivo</button>";
	$data = array(
			'name' => 'notas',
			'id' => 'notas_id',
			'class' => 'STBInput STBTab allline margin5 txs6 txtizq',
			'value' => 'Escribe alguna nota...',
			'rows' => '8',
			'cols' => '38',
			
	);
	echo form_textarea($data);
	echo "<input type='hidden' name='numeroDocumentos' id='numeroDocumentos' value='1'/>";
	echo form_submit('submit', 'Aceptar', "class='STBInput STBSombra STBSombraOut STBTab allline margin5 txs6'");
	echo form_button('regresar', 'Volver', "class='STBInput STBSombra STBSombraOut STBTab allline margin5 txs6'");
	echo form_close();
	?>
<script src="../assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        var num = 2;
        $("#addDocument").click(
                function () {
                    $("#subir_documentos").append("<input class='STBInput STBTab allline margin5 txs6 cortar' type='file' name='documento" + num + "'/>");
                    $("#numeroDocumentos").attr('value', num);
                    num++;
                });
    });
</script>

</div>