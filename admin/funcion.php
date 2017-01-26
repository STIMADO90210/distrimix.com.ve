<?php require_once('../Connections/master.php'); ?>

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

function Buscarnombre($nomb)
{
GLOBAL $database_master, $master;
mysql_select_db($database_master, $master);
echo $nomb;
echo "<br>";
$query_nomb = sprintf("SELECT * FROM usuario WHERE usuario.nombre=%s", $nomb);
/* $nombfuncion = mysql_query($query_nomb, $master) or die(mysql_error());
$row_nomb = mysql_fetch_assoc($nombfuncion);
$totalRows_nomb = mysql_num_rows($nombfuncion); */



 /* echo $row_nomb['apellido']; */
return;
 free_result($marcafuncion); 
}



function clie($n)
{
GLOBAL $database_master, $master;
mysql_select_db($database_master, $master);
$query_nomb = sprintf("SELECT * FROM usuario WHERE usuario.id=%s", $n);
 $nombfuncion = mysql_query($query_nomb, $master) or die(mysql_error());
$row_nomb = mysql_fetch_assoc($nombfuncion);
$totalRows_nomb = mysql_num_rows($nombfuncion); 


 echo $row_nomb['representante'];
  

 
}

function clie2($n)
{
GLOBAL $database_master, $master;
mysql_select_db($database_master, $master);
$query_nomb = sprintf("SELECT * FROM usuario WHERE usuario.id=%s", $n);
 $nombfuncion = mysql_query($query_nomb, $master) or die(mysql_error());
$row_nomb = mysql_fetch_assoc($nombfuncion);
$totalRows_nomb = mysql_num_rows($nombfuncion); 


 echo $row_nomb['representante'];
  

 
}


function st($nro)
{


switch ($nro) {
    case 1:
        echo "Sin Despachar";
        break;
    case 2:
        echo "Despachado";
        break;    
}

 

/* free_result($marcafuncion); */
}





function cat($nro)
{
GLOBAL $database_master, $master;
mysql_select_db($database_master, $master);
$query_marcafuncion = sprintf("SELECT * FROM categoria WHERE categoria.id=%s", $nro);
$marcafuncion = mysql_query($query_marcafuncion, $master) or die(mysql_error());
$row_marcafuncion = mysql_fetch_assoc($marcafuncion);
$totalRows_marcafuncion = mysql_num_rows($marcafuncion);



 echo $row_marcafuncion['categoria'];

/* free_result($marcafuncion); */
}



function cat2($nro)
{
GLOBAL $database_master, $master;
mysql_select_db($database_master, $master);
$query_marcafuncion = sprintf("SELECT * FROM categoria WHERE categoria.id=%s", $nro);
$marcafuncion = mysql_query($query_marcafuncion, $master) or die(mysql_error());
$row_marcafuncion = mysql_fetch_assoc($marcafuncion);
$totalRows_marcafuncion = mysql_num_rows($marcafuncion);



 $row_marcafuncion['categoria'];
return;
/* free_result($marcafuncion); */
}




function cambiaf_a_normal($fecha){ 
   	ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha); 
   	$lafecha=$mifecha[3]."/".$mifecha[2]."/".$mifecha[1]; 
   	return $lafecha; 
} 






 function BuscaEmpresa($nro)
{
GLOBAL $database_master, $master;
mysql_select_db($database_master, $master);
$query_marcafuncion = sprintf("SELECT * FROM usuario WHERE usuario.id=%s", $nro);
$marcafuncion = mysql_query($query_marcafuncion, $master) or die(mysql_error());
$row_marcafuncion = mysql_fetch_assoc($marcafuncion);
$totalRows_marcafuncion = mysql_num_rows($marcafuncion);



 echo $row_marcafuncion['razon_social'];


}




/* -------------------------------------------------------------------------------- */






 function buscarcorreo($nro)
{
	GLOBAL $database_master, $master;
	mysql_select_db($database_master, $master);
	$query_marcafuncion = sprintf("SELECT * FROM usuario WHERE usuario.id=%s", $nro);
	$marcafuncion = mysql_query($query_marcafuncion, $master) or die(mysql_error());
	$row_f = mysql_fetch_assoc($marcafuncion);
	$totalRows_marcafuncion = mysql_num_rows($marcafuncion);
	
			echo $row_marcafuncion['email'];
			return;


}







function buscaTotal($nro)
{
GLOBAL $database_master, $master;
mysql_select_db($database_master, $master);
$query_marcafuncion = sprintf("SELECT SUM(subtotal) as total FROM pedido WHERE pedido.nroPedido=%s", $nro);
$marcafuncion = mysql_query($query_marcafuncion, $master) or die(mysql_error());
$row_marcafuncion = mysql_fetch_assoc($marcafuncion);
$totalRows_marcafuncion = mysql_num_rows($marcafuncion);



echo number_format($row_marcafuncion['total'], 2, ',', '.');


}


?>

