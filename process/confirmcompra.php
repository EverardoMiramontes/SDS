<?php
session_start();

include '../library/configServer.php';
include '../library/consulSQL.php';

$num = $_POST['clien-number'];
if ($num == 'notlog') {
  $nameClien = $_POST['clien-name'];
  $passClien =  md5($_POST['clien-pass']);
}
if ($num == 'log') {
  $nameClien = $_POST['clien-name'];
  $passClien = $_POST['clien-pass'];
}

$verdata =  ejecutarSQL::consultar("select * from cliente where Clave='" . $passClien . "' and Nombre='" . $nameClien . "'");
$num =  mysqli_num_rows($verdata);
if ($num > 0) {
  if (isset($_SESSION['sumaTotal'])) {


    if ($_SESSION['sumaTotal'] > 0) {


      $data = mysqli_fetch_array($verdata);
      $nitC = $data['NIT'];
      $StatusV = "Pendiente";

      /*Insertando datos en tabla venta*/
      consultasSQL::InsertSQL("venta", "Fecha, NIT, Descuento, TotalPagar, Estado", "'" . date('d-m-Y') . "','" . $nitC . "','0','" . $_SESSION['sumaTotal'] . "','" . $StatusV . "'");

      /*recuperando el número del pedido actual*/
      $ventaId = ejecutarSQL::consultar("select * from venta where NIT='$nitC' order by NumPedido desc limit 1");

      $registro = mysqli_fetch_array($ventaId);

      $Numpedido = $registro['NumPedido'];

      /*Insertando datos en detalle de la venta*/
      for ($i = 0; $i < $_SESSION['contador']; $i++) {
        consultasSQL::InsertSQL("detalle", "NumPedido, CodigoProd, CantidadProductos", "'$Numpedido', '" . $_SESSION['producto'][$i] . "', '1'");

        /*Restando un stock a cada producto seleccionado en el carrito*/
        $prodStock = ejecutarSQL::consultar("select * from producto where CodigoProd='" . $_SESSION['producto'][$i] . "'");
        while ($fila = mysqli_fetch_array($prodStock)) {
          $existencias = $fila['Stock'];
          consultasSQL::UpdateSQL("producto", "Stock=('$existencias'-1)", "CodigoProd='" . $_SESSION['producto'][$i] . "'");
        }
      }

      /*Vaciando el carrito*/
      unset($_SESSION['producto']);
      unset($_SESSION['contador']);
      unset($_SESSION['sumaTotal']);

      echo '<img src="assets/img/ok.png" class="center-all-contens"><br>El pedido se ha realizado con éxito';

      INVOICE($Numpedido, $data);
    } else {
      echo '<img src="assets/img/error.png" class="center-all-contens"><br>No has seleccionado ningún producto, revisa el carrito de compras';
    }
  } else {
    echo '<img src="assets/img/error.png" class="center-all-contens"><br>Ya haz procesado la compra';
  }
} else {
  echo '<img src="assets/img/error.png" class="center-all-contens"><br>El nombre o contraseña invalidos';
}


function INVOICE($Numpedido, $data)
{
  require('../fpdf/fpdf.php');

  class PDF extends FPDF
  {
    //Cabecera de página
    function Header()
    {

      $this->Image('../assets/img/logo.jpeg', 10, 10, 40, 45.66);

      $this->SetFont('Arial', 'B', 12);

      $this->Cell(45, 13.33, '', 0, 0, 'C');
      $this->Cell(45, 13.33, '', 0, 0, 'C');
      $this->Cell(45, 13.33, '', 0, 0, 'C');
      $this->Cell(10, 13.33, '', 0, 0, 'C');
      $this->Cell(45, 13.33, 'Empresa: Catzilla S.A. de C.V', 0, 1, 'R');

      $this->Cell(45, 13.33, '', 0, 0, 'C');
      $this->Cell(45, 13.33, '', 0, 0, 'C');
      $this->Cell(45, 13.33, '', 0, 0, 'C');
      $this->Cell(10, 13.33, '', 0, 0, 'C');
      $this->Cell(45, 13.33, 'E-mail: facturas@catzilla.com', 0, 1, 'R');

      $this->Cell(45, 13.33, '', 0, 0, 'C');
      $this->Cell(45, 13.33, '', 0, 0, 'C');
      $this->Cell(30, 13.33, '', 0, 0, 'C');
      $this->MultiCell(70, 10, utf8_decode('Dirección: Melchor Ocampo #144, Monterrey, Nuevo León, México'), 0, 'R');
    }
  }

  //fecha despues de 15 dias
  $Date = date('d-m-Y');
  $Fecha15 = date('d-m-Y', strtotime($Date . ' + 15 days'));

  $pdf = new PDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial', 'B', 16);
  //Contenido de la pagina
  //Información del Cliente (NOMBRE)
  $pdf->Cell(10, 10, '', 0, 1);
  $pdf->Cell(10, 10, utf8_decode('Información del Cliente'), 0, 1);
  $pdf->MultiCell(100, 10, utf8_decode('Cliente: ' . $data['NombreCompleto'] . ' ' . $data['Apellido']), 0, 'L');

  //Información del Cliente (DIRRECION Y EMAIL)
  $pdf->Cell(0, 0, '', 0, 1);
  $pdf->MultiCell(190, 10, utf8_decode('Dirección: ' . $data['Direccion'] . '      Email:' . $data['Email']), 0, 'L');

  //Información del Cliente (TELEFONO)
  $pdf->Cell(0, 0, '', 0, 1);
  $pdf->MultiCell(200, 10, utf8_decode('Teléfono: ' . $data['Telefono'] . '      Fecha de Entrega:' . $Fecha15), 0, 'L');

  //Lista de productos
  $pdf->Cell(10, 10, '', 0, 1);
  $pdf->Cell(70, 10, 'Nombre del Producto', 1, 0, 'C');
  $pdf->Cell(60, 10, 'Cantidad', 1, 0, 'C');
  $pdf->Cell(60, 10, 'Precio', 1, 1, 'C');

  //Devuelve los productos de la venta, uno por linea
  $DetallesDeVenta = ejecutarSQL::consultar("SELECT a.NombreProd, a.Precio, b.CantidadProductos FROM detalle b left JOIN producto a on a.CodigoProd = b.CodigoProd WHERE b.NumPedido=" . $Numpedido);

  $Total = mysqli_fetch_array(ejecutarSQL::consultar("SELECT TotalPagar from venta where NumPedido =" . $Numpedido));

  while ($lista = mysqli_fetch_array($DetallesDeVenta)) {
    $pdf->Cell(70, 10, utf8_decode($lista[0]), 1, 0, 'C');
    $pdf->Cell(60, 10, $lista[2], 1, 0, 'C');
    $pdf->Cell(60, 10, $lista[1], 1, 1, 'C');
  }

  $pdf->Cell(70, 10, '# De Pedido: ' . $Numpedido, 1, 0, 'C');
  $pdf->Cell(60, 10, '', 1, 0, 'C');
  $pdf->Cell(60, 10, 'Total: ' . $Total[0], 1, 1, 'C');


  //Guardado de pdf
  $pdfName = $Numpedido . '.pdf';
  $pdf->Output('../Tickets/' . $pdfName, 'F');
}


//Total del pedido
//$_SESSION['sumaTotal'];

//Devuelve los productos de la venta, uno por linea
//$DetallesDeVenta=ejecutarSQL::consultar("SELECT a.NombreProd, a.Precio, b.CantidadProductos FROM detalle b left JOIN producto a on a.CodigoProd = b.CodigoProd WHERE b.NumPedido=".$Numpedido);

//Cantidad de productos
//$_SESSION['contador']
