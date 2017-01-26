<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php 
$stok=$_POST['stok'];
$stoknuevo=$_POST['stoknuevo'];
$tot=$stok+$stoknuevo;

$updateSQL = sprintf("UPDATE producto SET Stok=%s,$tot");
 mysql_select_db($database_master, $master);
  $Result1 = mysql_query($updateSQL, $master) or die(mysql_error());
					   
					   
					   ?>
<script type="text/jscript">
alert('El stok se Actualizo Exitosamente');

	window.location.href='producto.php';
	
</script>

</body>
</html>