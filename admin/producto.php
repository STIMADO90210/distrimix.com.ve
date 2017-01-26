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
$query_producto = "SELECT * FROM producto";
$producto = mysql_query($query_producto, $master) or die(mysql_error());
$row_producto = mysql_fetch_assoc($producto);
$totalRows_producto = mysql_num_rows($producto);
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


<nav class=" navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#inverseNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand active" href="#">ADMINISTRAR</a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="inverseNavbar1">
      <ul class="nav navbar-nav">
        <li class="active"></li>
        <li></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        	Usuario <?php  echo $_SESSION['MM_nombre']?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="registro_add.php">Registrar Usuario</a></li>
            <li><a href="registro_list.php">Editar Usuario</a></li>
            <li><a href="#">Cerrar Sesión</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> 		
        	Categoria<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="categoria_add.php">Agregar Categoria</a></li>
            <li><a href="categoria_list.php">Editar Categoria</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
         	Subcategoria<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="subcategoria_add.php">Agregar Subcategoria</a></li>
            <li><a href="subcategoria_list.php">Editar Subcategoria</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
         	Productos<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="producto_add.php">Agregar Producto</a></li>
            <li><a href="producto_list.php">Editar Producto</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> 	
         Envios<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="envios_add.php">Agregar Envio</a></li>
            <li><a href="envios_list.php">Editar Envio</a></li>
          </ul>
        </li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> 	
         Pedidos<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="despachadono.php">Pedidos por Despachar</a></li>
            <li><a href="despachadosi.php">Pedidos Despachados</a></li>
          </ul>
        </li>

      </ul>

    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>


    
    <!--MENU DE NAVEGACION-->


<div class="container">
<table width="1062" border="1" bordercolor="#FFFFFF">
  <tr>
    <td width="100" align="center" bgcolor="#CCCCCCC"><strong>id</strong></td>
    <td width="211" align="center"  bgcolor="#CCCCCCC"><strong>Producto</strong></td>
    <td width="174" align="center"  bgcolor="#CCCCCCC"><strong>Categoria</strong></td>
    <td width="258" align="center"  bgcolor="#CCCCCCC"><strong>Imagen</strong></td>
    <td width="137" align="center"  bgcolor="#CCCCCCC">Precio</td>
    <td width="137" align="center"  bgcolor="#CCCCCCC"><strong>stok</strong></td>
    <td colspan="3" align="center"  bgcolor="#CCCCCCC"><strong>Acciones</strong></td>
    </tr>
  <?php do { ?>
    <tr>
      <td align="center" bgcolor="#EEEEEEEE"><?php echo $row_producto['id']; ?></td>
      <td align="center" bgcolor="#EEEEEEEE"><?php echo $row_producto['producto']; ?></td>
      <td align="center" bgcolor="#EEEEEEEE"><?php cat($row_producto['categoria']); ?></td>
      <td align="center" bgcolor="#EEEEEEEE"><img src="../images/catalogo/<?php echo $row_producto['imagen']; ?>" width="26" height="21"></td>
      <td align="center" bgcolor="#EEEEEEEE"><?php echo $row_producto['precio']; ?></td>
      <td align="center" bgcolor="#EEEEEEEE"><?php echo $row_producto['stok']; ?></td>
      <td width="60" align="center" bgcolor="#EEEEEEEE" class="btn-boton btn-xs"><a href="producto_edit.php?idreg=<?php echo $row_producto['id']; ?>">Editar</a></td>
      <td width="76" align="center" bgcolor="#EEEEEEEE" class="btn-boton btn-xs"><a href="borrarProd.php?idreg=<?php echo $row_producto['id']; ?>">Eliminar</a></td>
      <td width="76" align="center" bgcolor="#EEEEEEEE" class="btn-boton btn-xs"><a href="stok.php?idreg=<?php echo $row_producto['id']; ?>">Stok</a></td>
    </tr>
    <?php } while ($row_producto = mysql_fetch_assoc($producto)); ?>
  </table>





   





    

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
?>
