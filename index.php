<!DOCTYPE html>
<html lang="es">

<head>
    <title>Inicio</title>
    <?php include './inc/link.php'; ?>
</head>

<body id="container-page-index">
    <?php include './inc/navbar.php'; ?>
    <div class="jumbotron" id="jumbotron-index">
        <h1><span class="tittles-pages-logo">CATZILLA STORE </span> <small style="color: #fff;">Mty</small></h1>
        <p>
            Bienvenidos a nuestra tienda en linea, aquí encontraran una gran variedad de ropa, accesorios y más.
        </p>
    </div>
    <section id="new-prod-index">
        <div class="container">
            <div class="page-header">
                <h1> Nuevos <small> productos</small></h1>
            </div>
            <div class="row">
                <?php
                include 'library/configServer.php';
                include 'library/consulSQL.php';
                $consulta = ejecutarSQL::consultar("select * from producto where Stock > 0 limit 6");
                $totalproductos = mysqli_num_rows($consulta);
                if ($totalproductos > 0) {
                    while ($fila = mysqli_fetch_array($consulta)) {
                        echo '
                        <div class="col-xs-12 col-sm-6 col-md-4">
                             <div class="thumbnail">
                               <img src="assets/img-products/' . $fila['Imagen'] . '">
                               <div class="caption">
                                 <h3>' . $fila['Marca'] . '</h3>
                                 <p>' . $fila['NombreProd'] . '</p>
                                 <p>$' . $fila['Precio'] . '</p>
                                 <p class="text-center">
                                     <a href="infoProd.php?CodigoProd=' . $fila['CodigoProd'] . '" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i>&nbsp; Detalles</a>&nbsp;&nbsp;
                                     <button value="' . $fila['CodigoProd'] . '" class="btn btn-success btn-sm botonCarrito"><i class="fa fa-shopping-cart"></i>&nbsp; Añadir</button>
                                 </p>

                               </div>
                             </div>
                         </div>     
                         ';
                    }
                } else {
                    echo '<h2>No hay productos registrados en la tienda</h2>';
                }
                ?>
            </div>
        </div>
    </section>
    <section id="reg-info-index">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 text-center">
                    <?php
                    if ($_SESSION['nombreAdmin'] != "") {
                    } elseif ($_SESSION['nombreUser'] == "") {
                        echo    '<article style="margin-top:20%;">
                                    <p><i class="fa fa-users fa-4x"></i></p>
                                    <h3>Registrate</h3>
                                    <p>Registrese y hagase cliente de <span class="tittles-pages-logo">CATZILLA STORE</span> para recibir las mejores ofertas y descuentos especiales de nuestros productos.</p>
                                    <p><a href="registration.php" class="btn btn-info btn-block">Registrarse</a></p>   
                                </article>';
                    } else {
                        echo    '<article style="margin-top:20%;">
                                    <p><i class="fa fa-users fa-4x"></i></p>
                                    <h3>Bienvenido!</h3>
                                    <p>' . $_SESSION['nombreUser'] . '</p>                                       
                                </article>';
                    }
                    ?>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <img src="assets/img/Smart-TV-RegInfo.png" alt="Smart-TV" class="img-responsive">
                </div>
            </div>
        </div>
    </section>
    <?php include './inc/footer.php'; ?>
</body>

</html>