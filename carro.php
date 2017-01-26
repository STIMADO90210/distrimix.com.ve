<?php  
require_once('Connections/master.php'); 
 
include("funcion.php")
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



$var_vercod = "0";
if (isset($_POST['prodid'])) {
  $var_vercod = $_POST['prodid'];
}
mysql_select_db($database_master, $master);
$query_vercod = sprintf("SELECT * FROM carro WHERE carro.id=%s", GetSQLValueString($var_vercod, "int"));
$vercod = mysql_query($query_vercod, $master) or die(mysql_error());
$row_vercod = mysql_fetch_assoc($vercod);
$totalRows_vercod = mysql_num_rows($vercod);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Alerta De EStado De Operacion</title>
</head>



<body>
<?php

  
if(isset($_POST['prodid'])&&(isset($_SESSION['MM_Username']))){	  




$prodid=$_POST['prodid'];
$prod=$_POST['prod'];
$precio=$_POST['precio'];
$cant=$_POST['cant'];


				$ha=-1;
				if(isset($_SESSION['carro'])){
						for($x=0;$x<count($_SESSION['carro']);$x++){
								if($prodid==$_SESSION['carro'][$x]['id']){
									$ha=$x;
								}		
						}
				}







		if($ha<>-1){
			$_SESSION['carro'][$ha]['cant']=$_SESSION['carro'][$ha]['cant']+$cant;
		}else{
			$_SESSION['carro'][]=array('id'=>$prodid,'prod'=>$prod,'precio'=>$precio,'cant'=>$cant);
		}
}


if(isset($_SESSION['MM_Username'])){	 
?>

	<script type="text/jscript">
		alert('Articulo Agregado');
		window.location.href='cotizacion.php'; 
	</script> 
   <?php }else{?>
    
    <script type="text/jscript">
		alert('Debe Iniciar Session');
		window.location.href='catalogo.php'; 
	</script>
 <?php }?>
 	



</body>
</html>

