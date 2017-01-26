<?php require_once('Connections/master.php'); ?>
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE usuario SET nombre=%s, apellido=%s, cedula=%s, email=%s, clave=%s, nivel=%s WHERE id=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['cedula'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['clave'], "text"),
                       GetSQLValueString($_POST['nivel'], "int"),
                       GetSQLValueString($_POST['id'], "int"),
					    GetSQLValueString($_POST['empresa'], "text"),
						 GetSQLValueString($_POST['direccion'], "text"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($updateSQL, $master) or die(mysql_error());

  $updateGoTo = "usuario.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$var_usered = "0";
if (isset($_GET["idreg"])) {
  $var_usered = $_GET["idreg"];
}
mysql_select_db($database_master, $master);
$query_usered = sprintf("SELECT * FROM usuario WHERE usuario.id=%s", GetSQLValueString($var_usered, "int"));
$usered = mysql_query($query_usered, $master) or die(mysql_error());
$row_usered = mysql_fetch_assoc($usered);
$totalRows_usered = mysql_num_rows($usered);
?>
<?php require_once('Connections/master.php'); ?>
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
                    <li><a href="histo_pedidos.php" data-hover="Cotización">Historico Pedidos</a></li>
                    <?php }?>
                    
                     <?php if(isset($_SESSION['MM_Username'])&& $_SESSION['MM_nivel']==1)  {   ?> 
                     
                    <li class="active"><a href="admin.php" data-hover="Cotización">Administracion</a></li>
                    <?php }?>
                    
                    
				 </ul>
				 <script type="text/javascript" src="js/nav.js"></script>
	      </div><!-- end h_menu4 -->
     </div>
</div>
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
		  	  <h4 class="title">Editar Usuario</h4>
		  	  <p class="cart"><a href="usuario.php">Volver Usuarios</a></p>
	  	   <p class="cart">&nbsp;</p>
           
           <form method="post" name="form2" action="<?php echo $editFormAction; ?>">
             <table width="398" align="center">
               <tr valign="baseline">
                 <td width="129" align="left" nowrap>Nombre:</td>
                 <td width="257"><input type="text" name="nombre" value="<?php echo htmlentities($row_usered['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
               </tr>
               <tr valign="baseline">
                 <td nowrap align="left">Apellido:</td>
                 <td><input type="text" name="apellido" value="<?php echo htmlentities($row_usered['apellido'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
               </tr>
               <tr valign="baseline">
                 <td nowrap align="left">Cedula/RIF:</td>
                 <td><input type="text" name="cedula" value="<?php echo htmlentities($row_usered['cedula'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
               </tr>
               <tr valign="baseline">
                 <td nowrap align="left">Email:</td>
                 <td><input type="text" name="email" value="<?php echo htmlentities($row_usered['email'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
               </tr>
               <tr valign="baseline">
                 <td nowrap align="left">Password:</td>
                 <td><input type="text" name="clave" value="<?php echo htmlentities($row_usered['clave'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
               </tr>
               <tr valign="baseline">
                 <td nowrap align="left">Nivel:</td>
                 <td><input type="text" name="nivel" value="<?php echo htmlentities($row_usered['nivel'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
               </tr>
                </tr>
            <tr valign="baseline">
              <td nowrap align="right">Empresa:</td>
              <td><input type="text" name="empresa" value="<?php echo htmlentities($row_usered['empresa'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td nowrap align="right">Direccion:</td>
              <td><input type="text" name="direccion" value="<?php echo htmlentities($row_usered['direccion'], ENT_COMPAT, 'utf-8'); ?>" size="32"></td>
            </tr>
               <tr valign="baseline">
                 <td nowrap align="right">&nbsp;</td>
                 <td><input type="submit" value="Actualizar registro"></td>
               </tr>
             </table>
             <input type="hidden" name="MM_update" value="form2">
             <input type="hidden" name="id" value="<?php echo $row_usered['id']; ?>">
           </form>
           <p>&nbsp;</p>
<p>&nbsp;</p>
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
mysql_free_result($usered);
?>
