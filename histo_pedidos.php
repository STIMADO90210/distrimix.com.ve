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
$query_clientes = "SELECT * FROM usuario";
$clientes = mysql_query($query_clientes, $master) or die(mysql_error());
$row_clientes = mysql_fetch_assoc($clientes);
$totalRows_clientes = mysql_num_rows($clientes);

$varid_historico = "0";
if (isset($_SESSION['MM_id'])) {
  $varid_historico = $_SESSION['MM_id'];
}
mysql_select_db($database_master, $master);
$query_historico = sprintf("SELECT * FROM clientepedido WHERE clientepedido.idcliente=%s", GetSQLValueString($varid_historico, "int"));
$historico = mysql_query($query_historico, $master) or die(mysql_error());
$row_historico = mysql_fetch_assoc($historico);
$totalRows_historico = mysql_num_rows($historico);


?>
<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Distrimix | Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Fashionpress Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
</head>
<body>
<?php  include('menubar.php'); ?>
<div class="column_center">
  <div class="container">
	
    <div class="clearfix"> </div>
  </div>
</div>
<div class="about">
    <div class="container">
         <div class="register">
         
		  	  <h4 class="title">Cliente: <?php echo clie($row_historico['idcliente']); ?></h4>
		  	 
		   <p class="cart">Historico de Pedidos</p>	  
              
              <table width="800" border="1" bordercolor="#FFFFFF">
                  <tr>
                    <td width="308" align="center" bgcolor="#CCCCCCC">Nro De Pedido</td>
                    <td width="213" align="center" bgcolor="#CCCCCCC">Fecha</td>
                    <td width="257" align="center" bgcolor="#CCCCCCC">Total</td>
                       <td width="257" align="center" bgcolor="#CCCCCCC">Status</td>
                  </tr>
           
                  <?php do { 
				  $f=date( "d-m-Y" , strtotime($row_historico['fecha']));
				  $ceros=strlen($row_historico['nroPedido']);
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
				  ?>
                  
                  <tr> 
                      <td align="center" bgcolor="#EEEEEEEE"><a href="detallePed.php?nroP=<?php echo $row_historico['nroPedido']?>"><?php echo $cadena.$row_historico['nroPedido']; ?></a></td>
                      <td align="center" bgcolor="#EEEEEEEE"><?php echo $f; ?></td>
                      <td align="center" bgcolor="#EEEEEEEE">BsF <?php buscaTotal($row_historico['nroPedido']);?></td>
                      <td align="center" bgcolor="#EEEEEEEE"><?php echo st($row_historico['status']); ?> </td>
                    </tr>
                    <?php } while ($row_historico = mysql_fetch_assoc($historico)); ?>
           
           </table>
               

              
		 </div>
	</div>
</div>
<div class="footer_bg">
</div>
<div class="footer">
	<div class="container">
		<div class="col-md-3 f_grid1">
			<h3>Nosotros</h3>
			<a href="#"><img src="images/logo.png" alt=""/></a>
			<p>Somos una empresa especializada en la distribuci&oacute;n y suministro de art&iacute;culos de papeler&iacute;a y de oficina, ubicada en la Ciudad de Maracaibo.</p>
		</div>
		<!--<div class="col-md-3 f_grid1 f_grid2">
			<h3>Siganos</h3>
			<ul class="social">
				<li><a href=""> <i class="fb"> </i><p class="m_3">Facebook</p><div class="clearfix"> </div></a></li>
			    <li><a href=""><i class="tw"> </i><p class="m_3">Twittter</p><div class="clearfix"> </div></a></li>
				<li><a href=""><i class="google"> </i><p class="m_3">Google</p><div class="clearfix"> </div></a></li>
				<li><a href=""><i class="instagram"> </i><p class="m_3">Instagram</p><div class="clearfix"> </div></a></li>
			</ul>
		</div>-->
		<div class="col-md-6 f_grid3">
			<h3>Informaci&oacute;n de Contactos</h3>
			<ul class="list">
				<li><p>Telefono : +58 (0261) 5114007</p></li>
				<li><p>+58 (0261) 4180985</p></li>
                <li><p>+58 (0416) 6158364 - 6158354</p></li>
				<li><p>Email : <a href="mailto:info(at)dismitrix.com"> info@dismitrix.com</a></p></li>
			</ul>
			<ul class="list1">
				<li><p>Venezuela - Estado Zulia.</p></li>
			</ul>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<div class="footer_bottom">
       	<div class="container">
       		<div class="cssmenu">
				<ul>
					<li class="active"><a href="">Politicas</a></li> .
					<li><a href="">Registrarse</a></li> .
					<li><a href="">Contactanos</a></li> .
					<li><a href="">Soporte</a></li>
				</ul>
			</div>
			<div class="copy">
			    <p>&copy;  2015 Distrimix, C.A. | Diseño <a href="http://rddsistemas.com" target="_blank">RdD Sistemas</a></p>
		    </div>
		    <div class="clearfix"> </div>
       	</div>
</div>
</body>
</html>
<?php
mysql_free_result($historico);


?>
