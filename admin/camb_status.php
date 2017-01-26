<?php require_once('../Connections/master.php'); 
include("funcion.php");
$st=$_GET['reg'];


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php 

$updateSQL = sprintf("UPDATE clientepedido SET status=%s WHERE id=%s",2,$st);
 mysql_select_db($database_master, $master);
  $Result1 = mysql_query($updateSQL, $master) or die(mysql_error());
	   
  ?>

  <script type="text/jscript">

	window.location.href='index.php';
	
</script>

</body>
</html>