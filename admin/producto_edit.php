
<?php require_once('../Connections/master.php'); 
include ("../funcion.php");
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
  $updateSQL = sprintf("UPDATE producto SET producto=%s, categoria=%s, imagen=%s, precio=%s WHERE id=%s",
                       GetSQLValueString($_POST['producto'], "text"),
                       GetSQLValueString($_POST['categoria'], "int"),
                       GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['precio'], "undefined"),
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

$var_prod = "0";
if (isset($_GET["idreg"])) {
  $var_prod = $_GET["idreg"];
}
mysql_select_db($database_master, $master);
$query_prod = sprintf("SELECT * FROM  producto WHERE producto.id=%s", GetSQLValueString($var_prod, "int"));
$prod = mysql_query($query_prod, $master) or die(mysql_error());
$row_prod = mysql_fetch_assoc($prod);
$totalRows_prod = mysql_num_rows($prod);

mysql_select_db($database_master, $master);
$query_cat = "SELECT * FROM categoria";
$cat = mysql_query($query_cat, $master) or die(mysql_error());
$row_cat = mysql_fetch_assoc($cat);
$totalRows_cat = mysql_num_rows($cat);

mysql_select_db($database_master, $master);
$query_subcat =sprintf("SELECT * FROM subcategoria WHERE subcategoria.categoria=%s",$row_prod['categoria']);
$subcat = mysql_query($query_subcat, $master) or die(mysql_error());
$row_subcat = mysql_fetch_assoc($subcat);
$totalRows_subcat = mysql_num_rows($subcat);
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
    <script type="text/javascript" language="javascript" src="js/ajax.js"></script>

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
    
    <h1>Editar Producto</h1><hr><br>
    
    		<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
            <div class="row form-group">
            <div class="col-md-4 col-xs-offset-3 "><img src="../images/catalogo/<?php echo htmlentities($row_prod['imagen']); ?>" width="30"> Imagen Actual  </div>
            </div>
    		<div class="row form-group">
    			<div class="col-md-1 col-xs-offset-2 ">Producto:</div>
    			<div class="col-md-4"><input type="text" name="producto" value="<?php echo htmlentities($row_prod['producto']); ?>" size="32" class="form-control"></div>
    		</div>
            <div class="row form-group">
    			<div class="col-md-1 col-xs-offset-2 ">Categoria:</div>
    			<div class="col-md-4"><select name="categoria" class="form-control" onChange="from(document.form1.categoria.value ,'subcat', 'subcategoria_release.php')">
                      <?php do {  ?>
                      <option value="<?php echo $row_cat['id']?>" <?php if (!(strcmp($row_cat['id'], htmlentities($row_prod['categoria'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_cat['categoria']?></option>
                      <?php } while ($row_cat = mysql_fetch_assoc($cat)); ?>
                    </select></div>
    		</div>
             <div  class="row form-group" id="subcat" >
    			<div class="col-md-1 col-xs-offset-2 ">Subcategoria: </div>
    			<div class="col-md-4">
                            
                            <select name="subcategoria" class="form-control">
                            <?php do { ?>
                                <option value="" <?php if (!(strcmp($row_subcat['id'], htmlentities($row_prod['subcategoria'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?> ><?php echo $row_subcat['subcategoria']; ?></option>
                               
                                <?php } while ($row_subcat = mysql_fetch_assoc($subcat)); ?>
                                </select>
                              
              	</div>
    		</div>
            <div class="row form-group">
    			<div class="col-md-1 col-xs-offset-2 ">Imagen:</div>
    			<div class="col-md-4"><input type="text" name="imagen" value="<?php echo htmlentities($row_prod['imagen']); ?>" size="32" class="form-control"></div>
                <div class="col-md-2"><input type="button" class="btn btn-primary" name="button" id="button" value="Sustituir imagen" onclick="javascript:subirimagen();"/></div>
    		</div>
            <div class="row form-group">
    			<div class="col-md-1 col-xs-offset-2 ">Precio:</div>
    			<div class="col-md-4"><input type="number" step="0.01" name="precio" value="<?php echo htmlentities($row_prod['precio']); ?>" size="32" min="0" max="1000000" required class="form-control" /></div>
    		</div>
            <div class="row form-group">
    			<div class="col-md-1 col-xs-offset-3 "><input type="submit" value="Guardar" class="btn btn-success"></div>
    		</div>
            <input type="hidden" name="MM_update" value="form1">
                <input type="hidden" name="id" value="<?php echo $row_prod['id']; ?>">
           </form>


                
           





    

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
 <script>  
  function subirimagen()
  {
	  self.name = 'opener';
	  remote = open('subirimagen/subirimg.php','remote','toolbar=yes, scrollbars=yes, resizable=yes, top=100, left=100, width=1150, height=500');
	  remote.focus();
	  
  }
  </script>
     <!-- Bootstrap core JavaScript-->
<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
  </body>
</html>
<?php
mysql_free_result($prod);

mysql_free_result($cat);

mysql_free_result($subcat);
?>
