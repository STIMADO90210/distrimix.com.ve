<?php require_once('Connections/master.php'); 
include("funcion.php");
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
$query_nroPed = "SELECT * FROM clientepedido";
$nroPed = mysql_query($query_nroPed, $master) or die(mysql_error());
$row_nroPed = mysql_fetch_assoc($nroPed);
$totalRows_nroPed = mysql_num_rows($nroPed);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>

<body>
<?php 




	$idcli=$_SESSION['MM_id']."<br>";	
	$nroP=$totalRows_nroPed+1 ."<br>";
	$status=1 ."<br>";
   $fec=date('Y-m-d');
   
   

   
$cad1= "INSERT INTO clientepedido (idcliente, nroPedido, status)";
$cad2 = " VALUES('$idcli','$nroP','$status')";
$cadena=$cad1.$cad2;
 
mysql_select_db($hostname_master, $master);
	mysql_query($cadena, $master) or die(mysql_error()); 



  for($i=0;$i<Count($_SESSION['carro']);$i++){
		mysql_select_db($hostname_master, $master); 
		$query_stok = @sprintf("SELECT * FROM producto WHERE producto.id=%s",$_SESSION['carro'][$i]['id']);
		$mstok = mysql_query($query_stok, $master) or die(mysql_error());
		$row_mstok = mysql_fetch_assoc($mstok);
		$totalRows_mstok = mysql_num_rows($mstok);
				
				$tot=$row_mstok['stok']-$_SESSION['carro'][$i]['cant'];
		
		$updateSQL = sprintf("UPDATE producto SET stok=%s WHERE id=%s",
                       GetSQLValueString($tot, "int"),
                       GetSQLValueString($_SESSION['carro'][$i]['id'], "int"));

		mysql_query($updateSQL, $master) or die(mysql_error());
		
  }




	
 
  for($i=0;$i<Count($_SESSION['carro']);$i++){
	
	
		$idpro=$_SESSION['carro'][$i]['id'];
		$prod=$_SESSION['carro'][$i]['prod'];
		$precio=$_SESSION['carro'][$i]['precio'];
		$cant=$_SESSION['carro'][$i]['cant'];
		$subtotal=$cant*$precio;
		
		
	
				
			$linea1= "INSERT INTO pedido (nroPedido, idpro, produ, precio, cant,subtotal)";
			$linea2= " VALUES('$nroP','$idpro','$prod','$precio','$cant','$subtotal')";
		
		
	$consul=$linea1.$linea2;
	
	
	 
	mysql_query($consul, $master) or die(mysql_error());


}

array_splice($_SESSION['carro'],0,count($_SESSION['carro']));	 						

$nro = $_SESSION['MM_id']; 
   
   GLOBAL $database_master, $master;
	mysql_select_db($database_master, $master);
	$query_marcafuncion = sprintf("SELECT * FROM usuario WHERE usuario.id=%s", $nro);
	$marcafuncion = mysql_query($query_marcafuncion, $master) or die(mysql_error());
	$row_f = mysql_fetch_assoc($marcafuncion);
	$totalRows_marcafuncion = mysql_num_rows($marcafuncion);
	
$destinatario = $row_f['email'];
/* echo $destinatario."<br>"; */
$asunto = "Notificacion De Pedido Recibido";

/* echo $asunto."<br>"; */
$mensaje = ":  Estimado Sr ".$row_f['representante']." Le Hacemos Saber Que Hemos Recibido Su Pedido Identificado Con El Nro: ".$nroP." El cual Procesaremos a la brebeda posible y le haremos saber Cuando Sera entregado.";
 /* echo $mensaje."<br>"; */

@mail($destinatario, $asunto, $mensaje);  
 ?>

<script type="text/jscript">
alert('Pedido Guardado Exitosamente');

	window.location.href='catalogo.php'; 
	
</script>
 
</body>
</html>
<?php
mysql_free_result($nroPed);
?>
