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
<title>Distrimix | Entrar al Sistema</title>
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
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
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
				      <a><li>Usuario : <?php echo strtoupper($_SESSION['MM_nombre']) ?></li></a>
                      <a href="logout.php"><li>Cerrar Session</li></a>
                      <?php }else{?>
				  				    
                  
		      <a href="login.php"><li>Iniciar Sesi&oacute;n</li></a>
              <?php }?>
			      <a href="#"><li><span class="m_1">Pedido</span>&nbsp;&nbsp;(0) &nbsp;<img src="images/bag.png" alt=""/></li></a>
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
					<li><a href="nosotros.html" data-hover="Nosotros">Nosotros</a></li>
					<li><a href="contactanos.html" data-hover="Contactanos">Contactanos</a></li>
					<li><a href="catalogo.php" data-hover="Catalogo de Producto">Catalogo de Producto</a></li>
					<li><a href="cotizacion.php" data-hover="Cotización">Cotizaci&oacute;n</a></li>
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
       <div class="col-md-6 login-right">
      
        <form method="post" name="form1" action="usuario.php">
          <h3 class="title">3 DATOS EMPRESARIALES</h3>
          <p>Registro Datos Empresariales</p>
          
		  <div>
		    <span>Empresa<label>*</label></span>
            <span id="sprytextfield1">
					   <input type="text" name="empresa" id="empresa"> </span>
		 </div>
		  <div>
		    <span>Telefono<label>*</label></span>
            <span id="sprytextfield2">
					   <input type="text" name="telefono" id="telefono"> </span>
			</div>
            
            
         
          
                   
          

				<div class="register-but">
				  
					   <input type="submit" value="Registrar" name="enviar" id="enviar">
					   <div class="clearfix"> </div>
				   
		  </div>
          			<input type="hidden" name="nivel" value="2">
					<input type="hidden" name="MM_insert" value="form1">
        </form>
        <p>&nbsp;</p>


		</div>		
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