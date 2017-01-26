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

$colname_DetailRS1 = "-1";
if (isset($_GET['detalle'])) {
  $colname_DetailRS1 = $_GET['detalle'];
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
<h1>Detalle Usuario</h1><hr><br>


<table align="center" class="table table-hover table-responsive">
  
  <tr>
    <td width="28%" align="right" class="active"><strong>ID:</strong> &nbsp;</td>
    <td width="72%"><?php echo $row_DetailRS1['id']; ?> </td>
  </tr>
  <tr>
    <td align="right" class="active"><strong>NOMBRE O RAZON SOCIAL: &nbsp;</strong></td>
    <td><?php echo $row_DetailRS1['razon_social']; ?> </td>
  </tr>
  <tr>
    <td align="right" class="active"><strong>REPRESENTANTE: &nbsp;</strong></td>
    <td><?php echo $row_DetailRS1['representante']; ?> </td>
  </tr>
  <tr>
    <td align="right" class="active"><strong>CEDULA / RIF: &nbsp;</strong></td>
    <td><?php echo $row_DetailRS1['cedula']; ?> </td>
  </tr>
  <tr>
    <td align="right" class="active"><strong>EMAIL: &nbsp;</strong></td>
    <td><?php echo $row_DetailRS1['email']; ?> </td>
  </tr>
  <tr>
    <td align="right" class="active"><strong>CLAVE: &nbsp;</strong></td>
    <td><?php echo $row_DetailRS1['clave']; ?> </td>
  </tr>
  <tr>
    <td align="right" class="active"><strong>NIVEL DE ACCESO: &nbsp;</strong></td>
    <td><?php echo $row_DetailRS1['nivel']; ?> </td>
  </tr>
  <tr>
    <td align="right" class="active"><strong>DIRECCIÓN FISTAL: &nbsp;</strong></td>
    <td><?php echo $row_DetailRS1['direccion']; ?> </td>
  </tr>
  <tr>
    <td align="right" class="active"><strong>DIRECCIÓN DE DESPACHO: &nbsp;</strong></td>
    <td><?php echo $row_DetailRS1['dir_despacho']; ?> </td>
  </tr>
  <tr>
    <td align="right" class="active"><strong>TELÉFONO FIJO: &nbsp;</strong></td>
    <td><?php echo $row_DetailRS1['telefono']; ?> </td>
  </tr>
  <tr>
    <td align="right" class="active"><strong>TELÉFONO MOVIL: &nbsp;</strong></td>
    <td><?php echo $row_DetailRS1['telf_movil']; ?> </td>
  </tr>
  <tr>
    <td align="right" class="active"><strong>FAX: &nbsp;</strong></td>
    <td><?php echo $row_DetailRS1['fax']; ?> </td>
  </tr>
  <tr>
    <td align="right" class="active"><strong>FECHA DE REGISTRO: &nbsp;</strong></td>
    <td><?php echo $row_DetailRS1['fecha']; ?> </td>
  </tr>
    <tr>
    <td align="right" class="active"><strong>ACCIONES: &nbsp;</strong></td>
    <td>  <a href="registro_list.php" class="btn btn-info btn-xs">Volver</a>&nbsp;
     <a href="registro_edit.php?editar=<?php echo $row_DetailRS1['id']; ?>" class="btn btn-primary btn-xs">Editar</a>&nbsp;
      <a href="registro_delete.php?borrar=<?php echo $row_DetailRS1['id']; ?>" class="btn btn-danger btn-xs">Eliminar</a></td>
  </tr>

  
  
</table>

   

   





   <br><br><br><br><br> 

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