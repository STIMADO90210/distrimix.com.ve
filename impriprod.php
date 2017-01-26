<?php 
require_once('Connections/master.php');
include("funcion.php");
require("/fpdf/fpdf.php"); 
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
?>

<?php 

$pdf= new FPDF();
$pdf-> addpage();
$pdf-> setfont('arial','',10);
$pdf->cell(150,10,'Dismitrix',0);
$pdf->cell(90,10, 'Fecha : '.date('d-m-Y').'',0);



$pdf->Ln(20);
$pdf-> setfont('arial','B',10);
$pdf->cell(80,10, '',0);
$pdf->cell(90,10, 'Listado De Productos',0);


$pdf->Ln(20);
$pdf-> setfont('arial','',10);
$pdf->cell(30,10, 'Item',0);
$pdf->cell(60,10, 'Productos',0);
$pdf->cell(60,10, 'Categoria',0);
$pdf->cell(30,10, 'Precio',0);
$pdf->cell(30,10, 'Stok',0);

do{
$pdf->Ln(8);

$pdf-> setfont('arial','',10);
$pdf->cell(30,10,$row_prod['id'],0);
$pdf->cell(60,10, $row_prod['producto'],0);

$cat=$row_prod['categoria'];
mysql_select_db($database_master, $master);
$query_cat = sprintf("SELECT * FROM categoria where categoria.id=%s",$cat);
$cate = mysql_query($query_cat, $master) or die(mysql_error());
$row_cat = mysql_fetch_assoc($cate);
$totalRows_cat = mysql_num_rows($cate);


$pdf->cell(60,10, $row_cat['categoria'],0);
setlocale(LC_MONETARY, "es_ES.UTF-8");

$precio = number_format($row_prod['precio'], 2, ',', '.');
$pdf->cell(30,10,$precio,0);
$pdf->cell(30,10, $row_prod['stok'],0);
}while($row_prod = mysql_fetch_assoc($prod));



$pdf->Output();
?>

<?php
mysql_free_result($prod);
?>
