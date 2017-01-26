
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

$varp_clip = "0";
if (isset($_GET['nroP'])) {
  $varp_clip = $_GET['nroP'];
}
mysql_select_db($database_master, $master);
$query_clip = sprintf("SELECT * FROM pedido WHERE pedido.nroPedido=%s", GetSQLValueString($varp_clip, "int"));
$clip = mysql_query($query_clip, $master) or die(mysql_error());
$row_clip = mysql_fetch_assoc($clip);
$totalRows_clip = mysql_num_rows($clip);




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

<div class="header">
	<div class="header_top">
		<div class="container">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt=""/></a>
			</div>
			<ul class="shopping_grid">
			  <?php if(isset($_SESSION['MM_Username']))
			  {
				  ?> 
				      <a><li><i class="fa fa-user"></i> Usuario : <?php echo strtoupper($_SESSION['MM_nombre']) ?></li></a>
                      <a href="logout.php"><li>Cerrar Session</li></a>
                      
                      <?php }else{?>
				  				    

		      <a href="login.php"><li><i class="fa fa-user"></i> Iniciar Sesi&oacute;n</li></a>
              <a href="registro.php"><li>Registrar</li></a>
              <?php }?>
              
<?php         if (isset($_SESSION['carro'])) { ?>
               <a href="#"><li><span class="m_1">Pedido</span>&nbsp;&nbsp;(<?php echo  count($_SESSION['carro']) ;?>) &nbsp; <i class="fa fa-shopping-cart"></i></li></a>
              <?php  }else{?>
			      <a href="#"><li><span class="m_1">Pedido</span>&nbsp;&nbsp;(0) &nbsp; <i class="fa fa-shopping-cart"></i></li></a>
			  <?php }	  ?>
              
             
                  <div class="clearfix"> </div>
			</ul>
		    <div class="clearfix"> </div>
		</div>
	</div>
	<div class="h_menu4"><!-- start h_menu4 -->
		<div class="container">
				<a class="toggleMenu" href="#">Menu</a>
				<ul class="nav">
					<li><a href="index.php" data-hover="Inicio">Inicio</a></li>
					<li><a href="nosotros.php" data-hover="Nosotros">Nosotros</a></li>
					<li><a href="contactanos.php" data-hover="Contactanos">Contactanos</a></li>
					<li><a href="catalogo.php" data-hover="Catalogo de Producto">Catalogo de Producto</a></li>
                     <?php if(isset($_SESSION['MM_Username']))
			  {
				  ?> 
					
                    
                    <?php }?>
                    
                      <?php if(isset($_SESSION['MM_Username'])){ ?>
                    <li><a href="cotizacion.php" data-hover="Cotización">Cotización</a></li>
                    <li  class="active"><a href="histo_pedidos.php" data-hover="Cotización">Historico Pedidos</a></li>
                    <?php }?>
                    
                     <?php if(isset($_SESSION['MM_Username'])&& $_SESSION['MM_nivel']==1)  {   ?> 
                     
                    <li><a href="admin.php" data-hover="Cotización">Administracion</a></li>
                    <?php }?>
                    
                    
				 </ul>
				 <script type="text/javascript" src="js/nav.js"></script>
	      </div><!-- end h_menu4 -->
     </div>
</div>
<div class="column_center">
  <div class="container">
	
    <div class="clearfix"> </div>
  </div>
</div>
<div class="about">
    <div class="container">
         <div class="register">




<?php 



  if(isset($_GET['nroP'])){
	

echo "Empresa : ";
echo  BuscaEmpresa($_SESSION['MM_id'])."<br>";
echo "________________________________________________<br> Contacto : ";
echo  clie($_SESSION['MM_id'])."<br>"; 
echo "________________________________________________<br>";
$nroped=$_GET['nroP'];
$ceros=strlen($nroped);
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
echo "Pedido : ".$cadena.$nroped."<br>";
 	
	  ?> 
  
 <table width="843" height="76" border="0" bordercolor="#FFFFFF">
  <tr>
   
    <td width="301" align="center"  bgcolor="#CCCCCCC"><strong>producto</strong></td>
    <td width="68" align="right"  bgcolor="#CCCCCCC"><strong>Precio</strong></td>
    <td width="106" align="right"  bgcolor="#CCCCCCC"><strong>Cantidad</strong></td>
    <td width="93" align="right"  bgcolor="#CCCCCCC"><strong>Subtotal</strong></td>
   
    </tr>
  
   
  
  
  
  <?php 

  $tot=0;
  $i=0;
  do { 
	
  ?>
    
    <tr>
      
      <td align="center" bgcolor="#EEEEEEEE""><?php echo strtoupper($row_clip['produ']); ?> </td>
      <td align="right" bgcolor="#EEEEEEEE"><?php echo  number_format($row_clip['precio'], 2, ',', '.'); ?></td>
      <td align="right" bgcolor="#EEEEEEEE"><?php echo $row_clip['cant']; ?></td>
      <td align="right" bgcolor="#EEEEEEEE"><?php echo  $row_clip['subtotal']; ?></td>
      
      
      
    </tr>
    
    <?php
  
  $tot=$tot+$row_clip['subtotal'];
  $i++;
	
  } while ($row_clip = mysql_fetch_assoc($clip)); 
  
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
    <td align="right">
      <a href="histo_pedidos.php" class="acount-btn">Volver</a></td>
    <td align="right" bgcolor="#FFFFFF">
    <form name="form1" method="post" action="imprimir_detalleped.php">
    <!-- <input class="btn-boton btn-xs" name="nropedido" id="nropedido" type="hidden" value="" > 
          <input type="submit" name="imprimir" id="imprimir" class="acount-btn" value=" Imprimir ">
           -->
    </form>
    </td>
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
			    <p>&copy;  2015 Distrimix, C.A. | Dise&ntilde;o <a href="http://rddsistemas.com" target="_blank">RdD Sistemas</a></p>
		    </div>
		    <div class="clearfix"> </div>
       	</div>
</div>
</body>
</html>

<?php
mysql_free_result($carro);

mysql_free_result($clip);

/* mysql_free_result($nroP); */
?>
