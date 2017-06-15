<?php

#Crea un conjunto de vistas preparadas 
include('partes/header.php');
# '$pagina' - valor por defecto que tendran todas las vistas que se lancen
# desde el CONTROLADOR
include($pagina . '.php');
include('partes/footer.php');
?>
