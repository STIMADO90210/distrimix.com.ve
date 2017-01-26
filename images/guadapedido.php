<?php require_once('Connections/master.php'); 
include("funcion.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
</head>

<body>


<?php 
mysql_select_db($hostname_master, $master);
for($i=0;$i<Count($_SESSION['carro']);$i++){

$idcli=$_SESSION['MM_id'];	
$idpro=$_SESSION['carro'][$i]['prodid'];
$prod=$_SESSION['carro'][$i]['prod'];
$precio=$_SESSION['carro'][$i]['precio'];
$cant=$_SESSION['carro'][$i]['cant'];


	
$linea1= "INSERT INTO pedido (idcli, idpro, produ, precio, cant)";
$linea2= " VALUES('$idcli','$idpro','$prod','$precio','$can')";
	
	
$consul=$linea1.$linea2;


 
mysql_query($consul, $master) or die(mysql_error());
}
?>


</body>
</html>