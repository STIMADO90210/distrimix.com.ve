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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
  $updateSQL = sprintf("UPDATE subcategoria SET subcategoria=%s, categoria=%s WHERE id=%s",
                       GetSQLValueString($_POST['subcategoria'], "text"),
                       GetSQLValueString($_POST['categoria'], "int"),
                       GetSQLValueString($_POST['id'], "int"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($updateSQL, $master) or die(mysql_error());

  $updateGoTo = "subcategoria_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_master, $master);
$query_consulta_categoria = "SELECT * FROM categoria";
$consulta_categoria = mysql_query($query_consulta_categoria, $master) or die(mysql_error());
$row_consulta_categoria = mysql_fetch_assoc($consulta_categoria);
$totalRows_consulta_categoria = mysql_num_rows($consulta_categoria);

$colname_consulta_subcategoria = "-1";
if (isset($_GET['reg'])) {
  $colname_consulta_subcategoria = $_GET['reg'];
}
mysql_select_db($database_master, $master);
$query_consulta_subcategoria = sprintf("SELECT * FROM subcategoria WHERE id = %s", GetSQLValueString($colname_consulta_subcategoria, "int"));
$consulta_subcategoria = mysql_query($query_consulta_subcategoria, $master) or die(mysql_error());
$row_consulta_subcategoria = mysql_fetch_assoc($consulta_subcategoria);
$totalRows_consulta_subcategoria = mysql_num_rows($consulta_subcategoria);
?>
<?php require_once('../Connections/master.php');
include("funcion.php"); ?>




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

<h1>Editar Subcategoria  </h1><hr><br> 
    
      <form method="POST" name="form2"  role="form" action="<?php echo $editFormAction; ?>">
      
     		<div class="row form-group">
   				<div class="col-md-1 col-xs-offset-2 ">Subcategoria:</div>
           	 	<div class="col-md-4"><input type="text"  value="<?php echo htmlentities($row_consulta_subcategoria['subcategoria'], ENT_COMPAT, 'utf-8'); ?>" class="form-control" name="subcategoria" size="32" ></div>
            </div>
          	<div class="row form-group">
   				<div class="col-md-1 col-xs-offset-2 ">Categoria:</div>
           		<div class="col-md-4">
           		 
       		    
   		          <select name="categoria" class="form-control">
                 	<?php do {  ?>
   		             	<option value="<?php echo $row_consulta_categoria['id']?>" <?php if (!(strcmp($row_consulta_categoria['id'], htmlentities($row_consulta_subcategoria['categoria'], ENT_COMPAT, 'utf-8')))) {echo "SELECTED";} ?>><?php echo $row_consulta_categoria['categoria']?></option>
       		    	<?php } while ($row_consulta_categoria = mysql_fetch_assoc($consulta_categoria));?>
	              </select>

           		    
           		</div>
        	</div>
        <div class="row form-group">
   			 	<div class="col-md-2 col-xs-offset-3 "><input type="submit" class="btn btn-success"  value="Actualizar" ></div>
       	</div>
         	<input type="hidden" name="id" value="<?php echo $row_consulta_subcategoria['id']; ?>">
           <input type="hidden" name="id" value="<?php echo $row_consulta_subcategoria['id']; ?>">
           <input type="hidden" name="MM_update" value="form2">
      </form>
      <p>&nbsp;</p>
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
mysql_free_result($consulta_categoria);

mysql_free_result($consulta_subcategoria);
?>
