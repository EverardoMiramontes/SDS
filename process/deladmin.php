<?php
session_start();
include '../library/configServer.php';
include '../library/consulSQL.php';

sleep(5);
$nameAd = $_POST['name-admin'];

if ($nameAd != $_SESSION['nombreAdmin']) {

    $consA =  ejecutarSQL::consultar("select * from administrador where Nombre='$nameAd'");
    $totalA = mysqli_num_rows($consA);

    if ($totalA > 0) {
        if (consultasSQL::DeleteSQL('administrador', "Nombre='" . $nameAd . "'")) {
            echo '<img src="assets/img/correcto.png" class="center-all-contens"><br><p class="lead text-center">Administrador eliminado éxitosamente</p>
            <meta http-equiv="refresh" content="1">';
        } else {
            echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">Ha ocurrido un error</p>';
        }
    } else {
        echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">El usuario ya no existe</p>';
    }
} else {
    echo '<img src="assets/img/incorrecto.png" class="center-all-contens"><br><p class="lead text-center">No puede eliminar su propio usuario</p>';
}
