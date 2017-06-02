
		
		<div id="subcabecera" class="w8 txs11 STBTitle titulo2 margin2">
			<?php
				$session=$this->session->get_userdata();
				echo "BIENVENIDO " .$session['nombreusr'];
			?>	
		</div>
		<div id="botones" class="w8 txs7 STBBody margin5">
			<a class="STBControl izq margin3 STBSombra STBSombraOut" href="<?php echo site_url('controlador_documentos/subir_documentos')?>">SUBIR DOCUMENTOS</a>
	
			<a class="STBControl der margin4 STBSombra STBSombraOut" href="<?php echo site_url('controlador_documentos/ver_documentos')?>">VER DOCUMENTOS</a>	
		<div class="clear"></div>
		</div>

