<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

sleep(5);
$codeCateg = $_POST['categ-code'];
$cons =  ejecutarSQL::consultar("select * from categoria where CodigoCat='$codeCateg'");
$totalcateg = mysqli_num_rows($cons);

$productosCategoria = mysqli_num_rows(ejecutarSQL::consultar("SELECT P.CodigoCat from producto P left join categoria C on P.CodigoCat = C.CodigoCat where P.CodigoCat='$codeCateg'"));

if (!($productosCategoria > 0)) {
    if ($totalcateg > 0) {
        if (consultasSQL::DeleteSQL('categoria', "CodigoCat='" . $codeCateg . "'")) {
            echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Categoría eliminada éxitosamente</p>
        <meta http-equiv="refresh" content="1">';
        } else {
            echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>';
        }
    } else {
        echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El código de la categoria no existe</p>';
    }
} else {
    echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Existen productos relacionados con esta categoría.<br>Por favor cambie de categoría en los productos <br> que tengan esta categoría.</p>';
}
