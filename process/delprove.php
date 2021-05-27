<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

sleep(5);
$nitProve = $_POST['nit-prove'];
$cons =  ejecutarSQL::consultar("select * from proveedor where NITProveedor='$nitProve'");
$totalprove = mysqli_num_rows($cons);

$productosProveedor = mysqli_num_rows(ejecutarSQL::consultar("SELECT P.NITProveedor from producto P left join proveedor Pr on P.NITProveedor = Pr.NITProveedor where P.NITProveedor='$nitProve'"));

if (!($productosProveedor > 0)) {
    if ($totalprove > 0) {
        if (consultasSQL::DeleteSQL('proveedor', "NITProveedor='" . $nitProve . "'")) {
            echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Proveedor eliminado éxitosamente</p>
        <meta http-equiv="refresh" content="1">';
        } else {
            echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error.<br>Por favor intente nuevamente</p>';
        }
    } else {
        echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El código de proveedor no existe</p>';
    }
} else {
    echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Existen productos relacionados con este proveedor.<br>Por favor cambie de proveedor en los productos <br> que tengan este proveedor.</p>';
}
