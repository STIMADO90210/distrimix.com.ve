<?php require_once('../Connections/master.php'); ?><?php
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE usuario SET razon_social=%s, representante=%s, cedula=%s, email=%s, clave=%s, nivel=%s, direccion=%s, dir_despacho=%s, telefono=%s, telf_movil=%s, fax=%s, fecha=%s WHERE id=%s",
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
                       GetSQLValueString($_POST['fecha'], "date"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($updateSQL, $master) or die(mysql_error());

  $updateGoTo = "registro_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_DetailRS1 = "-1";
if (isset($_GET['editar'])) {
  $colname_DetailRS1 = $_GET['editar'];
}
mysql_select_db($database_master, $master);
$query_DetailRS1 = sprintf("SELECT * FROM usuario WHERE id = %s", GetSQLValueString($colname_DetailRS1, "int"));
$DetailRS1 = mysql_query($query_DetailRS1, $master) or die(mysql_error());
$row_DetailRS1 = mysql_fetch_assoc($DetailRS1);
$totalRows_DetailRS1 = mysql_num_rows($DetailRS1);

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
<h1>Editar Usuario</h1><hr><br>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td width="192" align="right" valign="middle" nowrap><strong>NOMBRE / RAZON SOCIAL: &nbsp;</strong></td>
      <td width="370" height="40" valign="middle"><input type="text" name="razon_social" value="<?php echo htmlentities($row_DetailRS1['razon_social'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>REPRESENTATE: &nbsp;</strong></td>
      <td height="40" valign="middle"><input type="text" name="representante" value="<?php echo htmlentities($row_DetailRS1['representante'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>CEDULA / RIF: &nbsp;</strong></td>
      <td height="40" valign="middle"><input type="text" name="cedula" value="<?php echo htmlentities($row_DetailRS1['cedula'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>EMAIL: &nbsp;</strong></td>
      <td height="40" valign="middle"><input type="text" name="email" value="<?php echo htmlentities($row_DetailRS1['email'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>CLAVE: &nbsp;</strong></td>
      <td height="40" valign="middle"><input type="text" name="clave" value="<?php echo htmlentities($row_DetailRS1['clave'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>DIRECCIÓN FISCAL: &nbsp;</strong></td>
      <td height="57" valign="middle"><textarea type="text" name="direccion" value="<?php echo htmlentities($row_DetailRS1['direccion'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>DIRECCIÓN DE DESPACHO: &nbsp;</strong></td>
      <td height="60" valign="middle"><textarea type="text" name="dir_despacho" value="<?php echo htmlentities($row_DetailRS1['dir_despacho'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"></textarea></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>TELÉFONO FIJO: &nbsp;</strong></td>
      <td height="40" valign="middle"><input type="text" name="telefono" value="<?php echo htmlentities($row_DetailRS1['telefono'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>TELÉFONO MOVIL: &nbsp;</strong></td>
      <td height="40" valign="middle"><input type="text" name="telf_movil" value="<?php echo htmlentities($row_DetailRS1['telf_movil'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>FAX: &nbsp;</strong></td>
      <td height="40" valign="middle"><input type="text" name="fax" value="<?php echo htmlentities($row_DetailRS1['fax'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"></td>
    </tr>
    <tr valign="baseline">
      <td align="right" valign="middle" nowrap><strong>NIVEL DE ACCESO: &nbsp;</strong></td>
      <td height="40" valign="middle"><input type="text" name="nivel" value="<?php echo htmlentities($row_DetailRS1['nivel'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control"></td>
    </tr>

    <tr valign="baseline">
      <td align="right" valign="middle" nowrap>&nbsp;</td>
      <td height="40" valign="middle"><input type="submit" value="Actualizar registro" class="btn btn-success"></td>
    </tr>
  </table>
  <input type="hidden" name="fecha" value="<?php echo htmlentities($row_DetailRS1['fecha'], ENT_COMPAT, 'utf-8'); ?>" size="32" class="form-control">
  <input type="hidden" name="id" value="<?php echo $row_DetailRS1['id']; ?>">
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id" value="<?php echo $row_DetailRS1['id']; ?>">
</form>
<p>&nbsp;</p>
<p><strong>NOTA:</strong> Para Usuario REGULAR usar Nivel Acceso  # 2 / Para Usuario ADMINISTRADOR usar Nivel Acceso  # 1 </p> 
<br><br><br><br><br><br>
<hr>





   





    

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
</html><?php
mysql_free_result($DetailRS1);
?>