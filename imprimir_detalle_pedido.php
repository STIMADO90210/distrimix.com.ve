
<?php 
require("fpdf/fpdf.php"); 
require_once('Connections/master.php');
?>

<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

mysql_select_db($database_master, $master);
$query_prod = "SELECT * FROM producto";
$prod = mysql_query($query_prod, $master) or die(mysql_error());
$row_prod = mysql_fetch_assoc($prod);
$totalRows_prod = mysql_num_rows($prod);

$varp_detPed = "0";

if (isset($_POST['nropedido'])) {
  $varp_detPed = $_POST['nropedido'];
}
mysql_select_db($database_master, $master);
$query_detPed = sprintf("SELECT  *  FROM pedido WHERE pedido.nroPedido=%s", GetSQLValueString($varp_detPed, "int"));
$detPed = mysql_query($query_detPed, $master) or die(mysql_error());
$row_detPed = mysql_fetch_assoc($detPed);
$totalRows_detPed = mysql_num_rows($detPed);

 

$pdf= new FPDF();
$pdf-> addpage();
$pdf-> setfont('arial','',10);
$pdf->cell(150,10,'Dismitrix',0);
$pdf->cell(90,10, 'Fecha : '.date('d-m-Y').'',0);


$pdf->Ln(10);
$pdf-> setfont('arial','B',10);
$nro=$_POST['idcli'];
mysql_select_db($database_master, $master);
$query_marcafuncion = sprintf("SELECT * FROM usuario WHERE usuario.id=%s", $nro);
$marcafuncion = mysql_query($query_marcafuncion, $master) or die(mysql_error());
$row_empresa = mysql_fetch_assoc($marcafuncion);
$totalRows_marcafuncion = mysql_num_rows($marcafuncion);

 $pdf->cell(94,10, 'Empresa : '.$row_empresa['empresa'],0);
 $pdf->Ln(5);
 $pdf->cell(94,10, 'Contacto : '.$row_empresa['nombre'].' '.$row_empresa['apellido'],0);
 $pdf->Ln(5);
 $ceros=strlen($row_detPed['nroPedido']);
				  switch ($ceros)
				   {
						case 1:
							$cadena= "00000";
							break;
						case 2:
							$cadena= "0000";
							break;    
						case 3:
							$cadena= "000";
							break;    
						case 4:
							$cadena= "00";
							break; 
						case 5:
							$cadena= "0";
							break;    	   		
					}
 $pdf->cell(94,10, 'Pedido # : '.$cadena.$row_detPed['nroPedido'],0);
  

$pdf->Ln(2);
$pdf->cell(210,10, '_____________________________________________________________________________________________',0);
$pdf->Ln(8);
$pdf-> setfont('arial','B',10);
$pdf->cell(80,10, '',0);
$pdf->cell(90,10, 'Detalle Pedido',0);
$pdf->Ln(5);
$pdf->cell(210,10, '_____________________________________________________________________________________________',0);

$pdf->Ln(8);
$pdf-> setfont('arial','B',10);
$pdf->cell(30,10, 'Item',0);
$pdf->cell(60,10, 'Productos',0);
$pdf->cell(40,10, 'Precio',0);
$pdf->cell(30,10, 'Cantidad',0);
$pdf->cell(30,10, 'Susbtotal',0);
$pdf->Ln(2);
$pdf->cell(210,10, '_____________________________________________________________________________________________',0);


$total=0;
do{
$pdf->Ln(8);

$pdf-> setfont('arial','',10);
$pdf->cell(30,10,$row_detPed['idpro'],0);
$pdf->cell(60,10, $row_detPed['produ'],0);


$precio = number_format($row_detPed['precio'], 2, ',', '.');

$pdf->cell(40,10, $precio,0);
setlocale(LC_MONETARY, "es_ES.UTF-8");


$pdf->cell(30,10,$row_detPed['cant'],0);
$Subtot = number_format($row_detPed['subtotal'], 2, ',', '.');
$pdf->cell(30,10, $Subtot,0);
$total=$total+$row_detPed['subtotal'];
}while($row_detPed = mysql_fetch_assoc($detPed));

$pdf->Ln(2);
$pdf->cell(210,10, '_____________________________________________________________________________________________',0);
$pdf->Ln(6);
$pdf-> setfont('arial','B',10);
$pdf->cell(30,10, '',0);
$pdf->cell(60,10, '',0);
$pdf->cell(40,10, '',0);
$pdf->cell(30,10, 'Total ==>',0);
$total=number_format($total, 2, ',', '.');
$pdf->cell(30,10, $total,0);


$pdf->Output();
?>

<?php
mysql_free_result($prod);

mysql_free_result($detPed);
?>
