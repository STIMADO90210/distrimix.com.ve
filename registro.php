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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="repetio.php";
  $loginUsername = $_POST['email'];
  $LoginRS__query = sprintf("SELECT email FROM usuario WHERE email=%s", GetSQLValueString($loginUsername, "text"));
  mysql_select_db($database_master, $master);
  $LoginRS=mysql_query($LoginRS__query, $master) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}
$_SESSION['MM_correo']=isset($_POST['email']);
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO usuario (razon_social, representante, cedula, email, clave, nivel, direccion, dir_despacho, telefono, telf_movil, fax) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['razon_social'], "text"),
                       GetSQLValueString($_POST['representante'], "text"),
                       GetSQLValueString($_POST['cedula'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['clave'], "text"),
                       GetSQLValueString($_POST['nivel'], "int"),
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['dir_despacho'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['telf_movil'], "text"),
                       GetSQLValueString($_POST['fax'], "text"),date('Y-m-d'));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($insertSQL, $master) or die(mysql_error());

  $insertGoTo = "enviacorreo.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Distrimix | Entrar al Sistema</title>
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
				      <a><li><i class="fa fa-user"></i> Usuario : <?php echo strtoupper($_SESSION['MM_nombre']) ?></li></a>
                      <a href="logout.php"><li>Cerrar Session</li></a>
                      
                      <?php }else{?>
				  				    

		      <a href="login.php"><li><i class="fa fa-user"></i> Iniciar Sesi&oacute;n</li></a>
              <a href="registro.php"><li class="active">Registrar</li></a>
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
	
    <div class="clearfix"> </div>
  </div>
</div>
<div class="about">
  <div class="container">
      <div class="register">
      
      
      
      <div class="contact-form">
        <form method="POST" name="form1" action="<?php echo $editFormAction; ?>">
        
        
        
          <table align="center">
            <tr valign="baseline">
              <td width="201" height="60" align="left" valign="middle" nowrap>Nombre / Razon Social:</td>
              <td width="443" height="60"><span id="sprytextfield1"><input type="text" name="razon_social" required value="" size="32" ><span class="textfieldRequiredMsg">Introduzca su Nombre o Razon Social</span></span></td>
            </tr>
            <tr valign="baseline">
              <td height="60" align="left" valign="middle" nowrap>Cedula / RIF:</td>
              <td height="60"><span id="sprytextfield2"><input type="text" name="cedula" required value=" " size="32"><span class="textfieldRequiredMsg">Introduzca su Cedula o RIF</span></span></td>
            </tr>
            <tr valign="baseline">
              <td height="60" align="left" valign="middle" nowrap>Representante Encargado:</td>
              <td height="60"><input type="text" name="representante" required value="" size="32"></td> 
            </tr>
            <tr valign="baseline">
              <td height="60" align="left" valign="middle" nowrap>Dirección Fiscal:</td>
              <td height="60"><span id="sprytextfield3"><input type="text" name="direccion" required value="" size="32"><span class="textfieldRequiredMsg">Introduzca Dirección Fiscal</span></span></td>
            </tr>
            <tr valign="baseline">
              <td height="60" align="left" valign="middle" nowrap>Dirección de Despacho:</td>
              <td height="60"><span id="sprytextfield6"><input type="text" name="dir_despacho" required value="" size="32"><span class="textfieldRequiredMsg">Instroduzca su Dirección de Despacho </span></span></td>
            </tr>
            <tr valign="baseline">
              <td height="60" align="left" valign="middle" nowrap>Teléfono Fijo:</td>
              <td height="60"><span id="sprytextfield7"><input type="text" name="telefono" required value="" size="32"><span class="textfieldRequiredMsg">Instroduzca un Telefono Fijo </span></span></td>
            </tr>
            <tr valign="baseline">
              <td height="60" align="left" valign="middle" nowrap>Teléfono Movil:</td>
              <td height="60"><input type="text" name="telf_movil" required value="" size="32"></td>
            </tr>
            <tr valign="baseline">
              <td height="60" align="left" valign="middle" nowrap>Fax:</td>
              <td height="60"><input type="text" name="fax" required value=" " size="32"></td>
            </tr>
            <tr valign="baseline">
              <td height="60" align="left" valign="middle" nowrap>Email:</td>
              <td height="60"><span id="sprytextfield4"><input type="text" name="email" required value="" size="32"><span class="textfieldRequiredMsg">Introduzca su Correo </span></span></td>
            </tr>
            <tr valign="baseline">
              <td height="60" align="left" valign="middle" nowrap>Clave:</td>
              <td height="60">
              <span id="sprytextfield5"></span>
              <input type="text" name="clave" required type="password" value="" size="32">
              <span class="textfieldRequiredMsg">Introduzca una clave </span>
              
              </td>
            </tr>
            <tr valign="baseline">
              <td height="60" align="left" valign="middle" nowrap>&nbsp;</td>
              <td height="60"><input type="submit" value="Registrarse" ></td>
            </tr>
          </table>
         
          <input type="hidden" name="nivel" value="0">
          <input type="hidden" name="fecha" value="date('Y-m-d')">
<input type="hidden" name="MM_insert" value="form1">
        </form>
        <p>&nbsp;</p>
        </div>


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
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "email");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
</script>
</body>
</html>

