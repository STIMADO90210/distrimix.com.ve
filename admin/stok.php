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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
	/* var_dump($_POST); */
	$stok=$_POST['stokv']+$_POST['stok'];
  $updateSQL = sprintf("UPDATE producto SET stok=%s WHERE id=%s",
                       GetSQLValueString($stok, "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($updateSQL, $master) or die(mysql_error());

  $updateGoTo = "producto_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
   header(sprintf("Location: %s", $updateGoTo)); 
}

$var_stokpro = "0";
if (isset($_GET['idreg'])) {
  $var_stokpro = $_GET['idreg'];
}
mysql_select_db($database_master, $master);
$query_stokpro = sprintf("SELECT * FROM producto WHERE producto.id=%s", GetSQLValueString($var_stokpro, "int"));
$stokpro = mysql_query($query_stokpro, $master) or die(mysql_error());
$row_stokpro = mysql_fetch_assoc($stokpro);
$totalRows_stokpro = mysql_num_rows($stokpro);
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


         <h1>Stok Del Producto : <small>  <?php echo strtoupper($row_stokpro['producto']) ?> </small></h1><hr><br>
         
         <form method="post" name="form1" action="">
           <table width="552" align="center">
             <tr valign="baseline">
               <td width="172" height="40" align="right" valign="middle" nowrap><strong>CATEGORIA: </strong>&nbsp;</td>
               <td width="368" height="40" valign="middle">&nbsp; <?php cat($row_stokpro['categoria'])?></td>
             </tr>
             <tr valign="baseline">
               <td height="40" align="right" valign="middle" nowrap><strong>STOK ACTUAL: </strong>&nbsp;</td>
               <td height="40" valign="middle">&nbsp;  <?php echo $row_stokpro['stok']; $stokv=$row_stokpro['stok']; ?></td>
             </tr>
             <tr valign="baseline">
               <td height="40" align="right" valign="middle" nowrap><strong>STOK NUEVO: &nbsp;</strong></td>
               <td height="40" valign="middle"><input type="text" name="stok" value="" size="8" class="form-control"></td>
             </tr>
             <tr valign="baseline">
               <td height="40" align="right" valign="middle" nowrap>&nbsp;</td>
               <td height="40" valign="middle"><input type="submit" value="Actualizar stok" class="btn btn-success"></td>
             </tr>
           </table>
           <input type="hidden" name="MM_update" value="form1">
           <input type="hidden" name="id" value="<?php echo $row_stokpro['id']; ?>">
           <input type="hidden" name="stokv" value="<?php echo $stokv; ?>">
  </form>
         <p>&nbsp;</p>







   





    

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