<?php
var_dump($respuesta);

if ($respuesta == "ok") {
    ?>
    <h1>BIEN</h1>
    <?php
} else {
    ?>
    <h1>MAL</h1>
    <?php
}
?>

<?php
include('header.php');
include($pagina . ".php");
include('footer.php');
?>