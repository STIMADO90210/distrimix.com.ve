
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

if(isset($_POST['buscar'])){
	mysql_select_db($database_master, $master);
$query_producto="SELECT * FROM producto WHERE producto.producto LIKE '%".$_POST['buscar']."%'";	
$producto = mysql_query($query_producto, $master) or die(mysql_error());
$row_producto = mysql_fetch_assoc($producto);
$totalRows_producto = mysql_num_rows($producto);
}else{
mysql_select_db($database_master, $master);
$query_producto = "SELECT * FROM producto";
$producto = mysql_query($query_producto, $master) or die(mysql_error());
$row_producto = mysql_fetch_assoc($producto);
$totalRows_producto = mysql_num_rows($producto);

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


    <div class="container ">
    
    <h1>Productos Registrados</h1><hr><br>



<table class="table table-hover table-responsive">
  <tr class="active">
    <td><strong>ID</strong></td>
    <td><strong>PRODUCTO</strong></td>
    <td><strong>CATEGORIA</strong></td>
    <td><strong>IMAGEN</strong></td>
    <td><strong>PRECIO</strong></td>
    <td><strong>STOK</strong></td>
    <td colspan="3"><strong>ACCIONES</strong></td>
    </tr>
    
  <?php
   if (isset($row_producto['producto'])){
   do { ?>
    <tr>
      <td><?php echo $row_producto['id']; ?></td>
      <td><?php echo $row_producto['producto']; ?></td>
      <td><?php cat($row_producto['categoria']); ?></td>
      <td><img src="../images/catalogo/<?php echo $row_producto['imagen']; ?>" width="50" ></td>
      <td><?php echo $row_producto['precio']; ?></td>
      <td><?php echo $row_producto['stok']; ?></td>
      <td width="10%"><a href="producto_edit.php?idreg=<?php echo $row_producto['id']; ?>" class="btn btn-primary  btn-xs">Editar</a></td>
      <td width="10%"><a  href="borrarprod.php?idreg=<?php echo $row_producto['id']; ?>" class="btn btn-danger btn-xs">Eliminar</a></td>
      <td width="10%"><a href="stok.php?idreg=<?php echo $row_producto['id']; ?>" class="btn btn-info btn-xs">Incluir Stok</a></td>
    
    <?php } while ($row_producto = mysql_fetch_assoc($producto)); 
   }else{ ?>
   <td>no hay productos</td>
   <td>no hay productos</td>
   <td>no hay productos</td>
   <td>no hay productos</td>
   <td>no hay productos</td>
   <td>no hay productos</td>
	   <td>no hay productos</td>
   <?php }?>
   
	
    </tr>
           </table>





 <br><br>
   <div class="clearfix"></div>
 <br><br>
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

<?php
mysql_free_result($producto);

/*mysql_free_result($prod);*/
?>
