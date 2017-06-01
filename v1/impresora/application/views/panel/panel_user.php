<html>
	<head>
	<title>Programa de Impresión</title>
		<meta name="generator" content="Eclipse" />	
		<meta http-equiv="content-language" content="es_es" />	
		<link rel="stylesheet" type="text/css" href="../assets/css/Fw_CSSBase.css" />
		<link rel="stylesheet" type="text/css" href="../assets/css/Especifico.css" />
		<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
		<link rel="icon" type="images/png" href="img/logo.png"/>
	</head>
	<body>
		<div id="cabecera" class="STBHead fondoCeleste titulo cblanco">
			<div class="w6 STBAgroup">
				<img class="izq logo" alt="logo" src="../img/logo.png">
				<h1 class="izq txs10">IES CELIA VIÑAS<br> <span class="txs1 margin1">Scientia Omnibus Portus</span></h1><br><br><br>
			</div>
		<div class="clear"></div>
		</div>
		
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

		<div id="pie" class="w10 fondoCeleste">
		</div>
	</body>
</head>
	