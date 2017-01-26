<?php require_once('../Connections/master.php');
 include("funcion.php"); ?>
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<script src="SpryAssets/SpryAccordion.js" type="text/javascript"></script>
<link href="SpryAssets/SpryAccordion.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php /*?><?php var_dump($_GET['idreg']);?><?php */?>

<script type="text/jscript">
var resp=confirm('Esta Seguro Que Desea Eliminar Esta Categoria');
if(resp=true)
{
	
	<?php 
	 
	 $deleteSQL2= sprintf("DELETE FROM producto WHERE producto.categoria=%s",
                       GetSQLValueString($_GET['idreg'], "int"));		
					   mysql_select_db($database_master, $master);
  			$Result12 = mysql_query($deleteSQL2, $master) or die(mysql_error());
	 
	 $deleteSQL = sprintf("DELETE  FROM categoria WHERE categoria.id=%s",
                       GetSQLValueString($_GET['idreg'], "int"));
 			mysql_select_db($database_master, $master);
  			$Result1 = mysql_query($deleteSQL, $master) or die(mysql_error());
			
			
	
  
  ?>
	alert('Categoria Eliminada Satisfactoriamente')
	window.location.href='categoria_list.php';
} else {
	window.location.href='categoria_list.php';
	}	
</script>

 
</body>
</html>

