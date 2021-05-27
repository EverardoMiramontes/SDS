<?php
include '../library/configServer.php';
include '../library/consulSQL.php';

sleep(5);

$codeOldCatUp = $_POST['categ-code-old'];
$codeCatUp = $_POST['categ-code'];
$nameCatUp = $_POST['categ-name'];
$descCatUp = $_POST['categ-descrip'];

function actualizar($codeCatUp, $nameCatUp, $descCatUp, $codeOldCatUp)
{
    if (consultasSQL::UpdateSQL("categoria", "CodigoCat='$codeCatUp',Nombre='$nameCatUp',Descripcion='$descCatUp'", "CodigoCat='$codeOldCatUp'")) {
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

function SameCategory()
{
    echo '
    <br>
    <img class="center-all-contens" src="assets/img/cancel.png">
    <p><strong>Error</strong></p>
    <p class="text-center">
        Ya existe<br>
        una Categoría con ese Código    </p>
    <script>
        setTimeout(function(){
        url ="configAdmin.php";
        $(location).attr("href",url);
        },3000);
    </script>
    ';
}

$categorias = mysqli_num_rows(ejecutarSQL::consultar("select CodigoCat from categoria where CodigoCat=" . "'" . $codeCatUp . "'"));

if ($categorias > 0) {
    if ($codeOldCatUp == $codeCatUp) {
        actualizar($codeCatUp, $nameCatUp, $descCatUp, $codeOldCatUp);
    } else {
        SameCategory();
    }
} else {
    actualizar($codeCatUp, $nameCatUp, $descCatUp, $codeOldCatUp);
}
