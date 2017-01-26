<?php require_once('Connections/master.php'); 
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

mysql_select_db($database_master, $master);
$query_carro = "SELECT * FROM carro";
$carro = mysql_query($query_carro, $master) or die(mysql_error());
$row_carro = mysql_fetch_assoc($carro);
$totalRows_carro = mysql_num_rows($carro);

mysql_select_db($database_master, $master);
$query_nroP = "SELECT * FROM clientepedido";
$nroP = mysql_query($query_nroP, $master) or die(mysql_error());
$row_nroP = mysql_fetch_assoc($nroP);
$totalRows_nroP = mysql_num_rows($nroP);
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
<title>Distrimix | Cotizaci&oacute;n</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="Fashionpress Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
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
	<div class="search">
	  <div class="stay">Buscar Productos</div>
	  <div class="stay_right">
		  <input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
		  <input type="submit" value="">
	  </div>
	  <div class="clearfix"> </div>
	</div>
    <div class="clearfix"> </div>
  </div>
</div>
<div class="about">
    <div class="container">
         <div class="register">




<?php 



  if(!empty($_SESSION['carro']) && isset($_SESSION['carro'])){
	
$nroPed=$totalRows_nroP+1;
echo "Empresa : ";
echo  BuscaEmpresa($_SESSION['MM_id'])."<br>";
echo "________________________________________________<br> Contacto : ";
echo  clie($_SESSION['MM_id'])."<br>"; 
echo "________________________________________________<br>";
echo "Pedido : ".$nroPed."<br>";
 	
	  ?> 
  
 <table width="843" height="76" border="0" bordercolor="#FFFFFF">
  <tr>
   
    <td width="301" align="center" bgcolor="#CCCCCCC">producto</td>
    <td width="68" align="right" bgcolor="#CCCCCCC">Precio</td>
    <td width="106" align="right" bgcolor="#CCCCCCC">Cantidad</td>
    <td width="93" align="right" bgcolor="#CCCCCCC">Subtotal</td>
   
    </tr>
  
   
  
  
  <?php 

  $tot=0;
  $i=0;
  do { 
	/* if($_SESSION['carro'][$i]<>NULL){ */
  ?>
  
  <tr>
    
    <td align="center" bgcolor="#EEEEEEEE"><?php echo strtoupper($_SESSION['carro'][$i]['prod']); ?> </td>
    <td align="right" bgcolor="#EEEEEEEE"><?php echo  number_format($_SESSION['carro'][$i]['precio'], 2, ',', '.'); ?></td>
    <td align="right" bgcolor="#EEEEEEEE"><?php echo $_SESSION['carro'][$i]['cant']; ?></td>
    <td align="right" bgcolor="#EEEEEEEE"><?php echo  number_format($_SESSION['carro'][$i]['cant'] *  $_SESSION['carro'][$i]['precio'], 2, ',', '.'); ?></td>

   
    
  </tr>
  
  <?php
  
  $tot=$tot+($_SESSION['carro'][$i]['cant'] *  $_SESSION['carro'][$i]['precio']);
  $i++;
	/* } */
   } while ($i<count($_SESSION['carro'])); 
  
   ?>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td align="right" bgcolor="#CCCCCCC">Total</td>
        <td align="right" bgcolor="#CCCCCCC"><?php echo  number_format($tot, 2, ',', '.'); ?></td>
   
</tr>


<tr>
    <td align="center">
    
    </td>

</tr>



  <tr>
    <td align="center">
    
    </td>
    <td align="right">
    <form name="form1" method="post" action="guardapedido.php">
          <input type="submit" name="Comprar" id="Comprar" class="acount-btn" value=" Comprar ">
        </form>
    </td>
    <td align="right" bgcolor="#FFFFFF"></td>
        <td align="right" bgcolor="#FFFFFF"></td>
   
</tr>

</table>


 <?php }?>      
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
		<div class="col-md-3 f_grid1 f_grid2">
			<h3>Siganos</h3>
			<ul class="social">
				<li><a href=""> <i class="fb"> </i><p class="m_3">Facebook</p><div class="clearfix"> </div></a></li>
			    <li><a href=""><i class="tw"> </i><p class="m_3">Twittter</p><div class="clearfix"> </div></a></li>
				<li><a href=""><i class="google"> </i><p class="m_3">Google</p><div class="clearfix"> </div></a></li>
				<li><a href=""><i class="instagram"> </i><p class="m_3">Instagram</p><div class="clearfix"> </div></a></li>
			</ul>
		</div>
		<div class="col-md-6 f_grid3">
			<h3>Informaci&oacute;n de Contactos</h3>
			<ul class="list">
				<li><p>Telefono : +58 (0261) 9953004</p></li>
				<li><p>+58 (0261) 7439637 - 7439671</p></li>
                <li><p>+58 (0261) 4182228</p></li>
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
			    <p>&copy;  2015 Distrimix, C.A. | Dise&ntilde;o <a href="http://rddsistemas.com" target="_blank">RdD Sistemas</a></p>
		    </div>
		    <div class="clearfix"> </div>
       	</div>
</div>
</body>
</html>
<?php
mysql_free_result($carro);

mysql_free_result($nroP);
?>
