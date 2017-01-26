
<?php require_once('../Connections/master.php'); 
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
$query_consulta_subcategoria = "SELECT * FROM subcategoria";
$consulta_subcategoria = mysql_query($query_consulta_subcategoria, $master) or die(mysql_error());
$row_consulta_subcategoria = mysql_fetch_assoc($consulta_subcategoria);
$totalRows_consulta_subcategoria = mysql_num_rows($consulta_subcategoria);
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








    <div class="container ">
    <h1>Lista de Subcategorias Registradas</h1><hr><br>
    
    
      <table class="table table-hover table-responsive" align="center">
        <tr class="active">
          <td><strong>ID</strong></td>
          <td><strong>SUBCATEGORIA</strong></td>
          <td><strong>CATEGORIA</strong></td>
          <td colspan="2"><strong>ACCIONES</strong></td>
        </tr>
        <?php do { ?>
          <tr>
            <td> <?php echo $row_consulta_subcategoria['id']; ?>&nbsp; </td>
            <td><?php echo $row_consulta_subcategoria['subcategoria']; ?>&nbsp; </td>
            <td><?php cat($row_consulta_subcategoria['categoria']); ?>&nbsp;</td>
            <td><a href="subcategoria_edit.php?reg=<?php echo $row_consulta_subcategoria['id']; ?>" class="btn btn-info btn-xs">Editar</a></td>
            <td><a href="subcategoria_delete.php?reg=<?php echo $row_consulta_subcategoria['id']; ?>" class="btn btn-danger btn-xs">Eliminar </a></td>
        </tr>
          <?php } while ($row_consulta_subcategoria = mysql_fetch_assoc($consulta_subcategoria)); ?>
      </table>
      <br>
      <?php echo $totalRows_consulta_subcategoria ?> Registros Total <br><br><br><br><br><br>     
      </div>
    <!-- /.container -->
    
    
 

 
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
<?php
mysql_free_result($consulta_subcategoria);
?>
