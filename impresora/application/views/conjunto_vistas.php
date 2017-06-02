
<?php

if (isset($respuesta)) {
    $this->load->view('mensaje/correcto');
}

include('header.php');
include($pagina . ".php");
include('footer.php');
?>