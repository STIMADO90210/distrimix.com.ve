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
<title>Distrimix | Cotización</title>
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




<?php 

 
 if(isset($_POST['pos'])){
	$pos=$_POST['pos'];
	$cuanto=$_POST['cantida2'];
 $_SESSION['carro'][$pos]['cant']=$cuanto;
	
	} 
	


   if(isset($_POST['pos2'])){
	 $pos2=$_POST['pos2'];
		
				array_splice($_SESSION['carro'],$pos2,1);							

   }




  if(!empty($_SESSION['carro']) && isset($_SESSION['carro'])){?> 

 <table width="954" height="76" border="0" bordercolor="#FFFFFF">
  <tr>
   
    <td width="318" align="center" bgcolor="#CCCCCCC">producto</td>
    <td width="126" align="right" bgcolor="#CCCCCCC">Precio</td>
    <td width="103" align="right" bgcolor="#CCCCCCC">Cantidad</td>
    <td width="236" align="right" bgcolor="#CCCCCCC">Subtotal</td>
    <td colspan="2" align="center" bgcolor="#CCCCCCC">Acciones</td>
    </tr>
  
   
  
  
  <?php 

  $tot=0;
  $i=0;
  do { 
	
  ?>
  
  <tr>
    
    <td align="center" bgcolor="#EEEEEEEE"><?php echo strtoupper($_SESSION['carro'][$i]['prod']); ?> </td>
    <td align="right" bgcolor="#EEEEEEEE"><?php echo  number_format($_SESSION['carro'][$i]['precio'], 2, ',', '.'); ?></td>
    <td align="right" bgcolor="#EEEEEEEE">
    <form action="" method="post" name="actualiza" >
    <Select name="cantida2" id="cantida2">
    <option value="<?php echo  $_SESSION['carro'][$i]['cant']; ?>"><?php echo  $_SESSION['carro'][$i]['cant']; ?></option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    </Select>
	
	<input name="pos" type="hidden" value="<?php echo $i ?>">
    
    <input name="" type="image" src="images/actualizar.png" width="20" height="20">
    </form>
     </td>
    <td align="right" bgcolor="#EEEEEEEE"><?php echo  number_format($_SESSION['carro'][$i]['cant'] *  $_SESSION['carro'][$i]['precio'], 2, ',', '.') ?>
    </td>

     <td width="149" align="center" bgcolor="#EEEEEEEE">
     
     <form action="" method="post">
     <input name="pos2" type="hidden" value="<?php echo $i ?>">
     <input name="id" type="hidden" value="<?php echo $i ?>">
     <input name="" type="image" src="images/remove_256.png" width="25" height="25">
     </form>
     
     </td>
	
    
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
    <td align="right">&nbsp;</td>
</tr>

<tr>
 <td align="right">&nbsp;</td>
</tr>
  <tr>
    <td align="center">
    
    </td>
    <td align="right">&nbsp;</td>
    <td align="right" bgcolor="#FFFFFF"></td>
        <td align="right" bgcolor="#FFFFFF"><a href="catalogo.php" class="acount-btn">Volver a catalogo</a></td>
    <td align="right">
    <form name="form1" method="post" action="confirma.php">
      
      <input type="submit" name="conforma" id="conforma" class="acount-btn" value="confirmar pedido">
    </form>
    </td>
</tr>

</table>
<?php }else{?>
	  	  <h4 class="title"><?php echo strtoupper($_SESSION['MM_nombre']) ?> Su pedido esta vacio</h4>
		  	  <p class="cart"><a  class="acount-btn" href="catalogo.php">Hacer pedido</a> Aun no ha hecho una Cotización</p>

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
mysql_free_result($carro);
?>
