<?php require_once('../Connections/master.php'); ?>
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO usuario (id, razon_social, representante, cedula, email, clave, nivel, direccion, dir_despacho, telefono, telf_movil, fax, fecha) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id'], "int"),
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
                       GetSQLValueString($_POST['fax'], "text"),
                       GetSQLValueString($_POST['fecha'], "date"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($insertSQL, $master) or die(mysql_error());

  $insertGoTo = "registro_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Panel Administración</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="css/estilos.css" rel="stylesheet" type="text/css">
    

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
  </head>
<!-- NAVBAR
================================================== -->
  <body>
  
   

<div class="container">
<img src="../images/logo.png">
</div>






  
  <!--MENU DE NAVEGACION-->


<?php include("menuadmin.php"); ?>


    
    <!--MENU DE NAVEGACION-->

<div class="container">

<h1>Registrar Usuario</h1><hr><br>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td width="174" align="right" valign="middle" nowrap><strong>Nombre o Razon Social:</strong></td>
      <td width="339" height="40" valign="middle"><input type="text" name="razon_social" value="" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>Representante:</strong></td>
      <td height="40" valign="middle"><input type="text" name="representante" value="" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>Cedula o RIF:</strong></td>
      <td height="40" valign="middle"><input type="text" name="cedula" value="" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>Email:</strong></td>
      <td height="40" valign="middle"><input type="text" name="email" value="" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>Clave:</strong></td>
      <td height="40" valign="middle"><input type="text" name="clave" value="" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>Dirección Fiscal:</strong></td>
      <td height="62" valign="middle"><textarea type="text" name="direccion" value="" size="32" class="form-control"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>Dirección de Despacho:</strong></td>
      <td height="57" valign="middle"><textarea type="text" name="dir_despacho" value="" size="32" class="form-control"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>Telefono Fijo:</strong></td>
      <td height="40" valign="middle"><input type="text" name="telefono" value="" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>Telféfono Movil:</strong></td>
      <td height="40" valign="middle"><input type="text" name="telf_movil" value="" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>Fax:</strong></td>
      <td height="40" valign="middle"><input type="text" name="fax" value="" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>Nivel de Acceso:</strong></td>
      <td height="40" valign="middle">
    
     <input type="month">
      <input type="text" name="nivel" value="2" size="32" class="form-control"></td>
    </tr>

    <tr valign="baseline">
      <td align="right" valign="middle" nowrap>&nbsp;</td>
      <td height="40" valign="middle"><input type="submit" value="Insertar registro" class="btn btn-success"></td>
    </tr>
  </table>
  <input type="hidden" name="id" value="">
  <input type="hidden" name="fecha" value="" size="32">
  <input type="hidden" name="MM_insert" value="form1">
  
</form>
<p>&nbsp;</p>

<p><strong>NOTA:</strong> Para registrar un usuario REGULAR dejar nivel de acceso # 2 / Para Registrar un ADMINISTRADOR cambiar nivel de acceso a # 1</p>

<br><br><br><br><br><br>
</div><!-- /.container -->
    
    
      <!-- FOOTER -->
      <div class=" panel-footer footer">
      <div class="container">
      <footer class="">
        <p class="pull-right"><a href="#">subir</a></p>
        <p>&copy; 2015 Distrimix | Panel Administración &middot; </p>
      </footer>
      </div>
      </div>

     <!-- Bootstrap core JavaScript-->
<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
  </body>
</html>