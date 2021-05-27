<?php
include '../library/configServer.php';
include '../library/consulSQL.php';

sleep(5);

$codeOldProdUp = $_POST['code-old-prod'];
$codeProdUp = $_POST['code-prod'];
$nameProdUp = $_POST['prod-name'];
$catProdUp = $_POST['prod-category'];
$priceProdUp = $_POST['price-prod'];
$modelProdUp = $_POST['model-prod'];
$marcaProdUp = $_POST['marc-prod'];
$stockProdUp = $_POST['stock-prod'];
$proveProdUp = $_POST['prod-Prove'];

function actualizar($codeProdUp, $nameProdUp, $catProdUp, $priceProdUp, $modelProdUp, $marcaProdUp, $stockProdUp, $proveProdUp, $codeOldProdUp)
{
    if (consultasSQL::UpdateSQL("producto", "CodigoProd='$codeProdUp',NombreProd='$nameProdUp',CodigoCat='$catProdUp',Precio='$priceProdUp',Modelo='$modelProdUp',Marca='$marcaProdUp',Stock='$stockProdUp',NITProveedor='$proveProdUp'", "CodigoProd='$codeOldProdUp'")) {
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

function SameProduct()
{
    echo '
    <br>
    <img class="center-all-contens" src="assets/img/cancel.png">
    <p><strong>Error</strong></p>
    <p class="text-center">
        Ya existe<br>
        Un Producto con ese Código
    </p>
    <script>
        setTimeout(function(){
        url ="configAdmin.php";
        $(location).attr("href",url);
        },3000);
    </script>
    ';
}

$productos = mysqli_num_rows(ejecutarSQL::consultar("select CodigoProd from producto where CodigoProd=" . "'" . $codeProdUp . "'"));

if ($productos > 0) {
    if ($codeOldProdUp == $codeProdUp) {
        actualizar($codeProdUp, $nameProdUp, $catProdUp, $priceProdUp, $modelProdUp, $marcaProdUp, $stockProdUp, $proveProdUp, $codeOldProdUp);
    } else {
        SameProduct();
    }
} else {
    actualizar($codeProdUp, $nameProdUp, $catProdUp, $priceProdUp, $modelProdUp, $marcaProdUp, $stockProdUp, $proveProdUp, $codeOldProdUp);
}
