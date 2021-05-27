<?php
include '../library/configServer.php';
include '../library/consulSQL.php';

sleep(5);

$nitOldProveUp = $_POST['nit-prove-old'];
$nitProveUp = $_POST['nit-prove'];
$nameProveUp = $_POST['prove-name'];
$dirProveUp = $_POST['prove-dir'];
$telProveUp = $_POST['prove-tel'];
$webProveUp = $_POST['prove-web'];


function actualizar($nitProveUp, $nameProveUp, $dirProveUp, $telProveUp, $webProveUp, $nitOldProveUp)
{
    if (consultasSQL::UpdateSQL("proveedor", "NITProveedor='$nitProveUp',NombreProveedor='$nameProveUp',Direccion='$dirProveUp',Telefono='$telProveUp',PaginaWeb='$webProveUp'", "NITProveedor='$nitOldProveUp'")) {
        echo '
    <br>
    <img class="center-all-contens" src="assets/img/Check.png">
    <p><strong>Hecho</strong></p>
    <p class="text-center">
        Recargando<br>
        en 3 segundos
    </p>
    <script>
        setTimeout(function(){
        url ="configAdmin.php";
        $(location).attr("href",url);
        },3000);
    </script>
 ';
    } else {
        echo '
    <br>
    <img class="center-all-contens" src="assets/img/cancel.png">
    <p><strong>Error</strong></p>
    <p class="text-center">
        Recargando<br>
        en 3 segundos
    </p>
    <script>
        setTimeout(function(){
        url ="configAdmin.php";
        $(location).attr("href",url);
        },3000);
    </script>
 ';
    }
}

function SameRFC()
{
    echo '
    <br>
    <img class="center-all-contens" src="assets/img/cancel.png">
    <p><strong>Error</strong></p>
    <p class="text-center">
        Ya existe<br>
        Un Proveedor con ese RFC
    </p>
    <script>
        setTimeout(function(){
        url ="configAdmin.php";
        $(location).attr("href",url);
        },3000);
    </script>
    ';
}

$proveedores = mysqli_num_rows(ejecutarSQL::consultar("select NITProveedor from proveedor where NITProveedor=" . "'" . $nitProveUp . "'"));

if ($proveedores > 0) {
    if ($nitOldProveUp == $nitProveUp) {
        actualizar($nitProveUp, $nameProveUp, $dirProveUp, $telProveUp, $webProveUp, $nitOldProveUp);
    } else {
        SameRFC();
    }
} else {
    actualizar($nitProveUp, $nameProveUp, $dirProveUp, $telProveUp, $webProveUp, $nitOldProveUp);
}
