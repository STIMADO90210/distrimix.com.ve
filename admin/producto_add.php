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
  $insertSQL = sprintf("INSERT INTO producto (producto, categoria,subcategoria, imagen, precio) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['producto'], "text"),
                       GetSQLValueString($_POST['categoria'], "int"),
					   GetSQLValueString($_POST['subcategoria'], "int"),
                       GetSQLValueString($_POST['imagen'], "text"),
                       GetSQLValueString($_POST['precio'], "text"));

  mysql_select_db($database_master, $master);
  $Result1 = mysql_query($insertSQL, $master) or die(mysql_error());

  $insertGoTo = "producto_list.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_master, $master);
$query_categoria = "SELECT * FROM categoria";
$categoria = mysql_query($query_categoria, $master) or die(mysql_error());
$row_categoria = mysql_fetch_assoc($categoria);
$totalRows_categoria = mysql_num_rows($categoria);

mysql_select_db($database_master, $master);
$query_subcat = "SELECT * FROM subcategoria";
$subcat = mysql_query($query_subcat, $master) or die(mysql_error());
$row_subcat = mysql_fetch_assoc($subcat);
$totalRows_categoria = mysql_num_rows($subcat);

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
   

	<h1>Agregar Producto</h1><hr><br>
    

           <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                    <div class="row form-group">
                        <div class="col-md-1 col-xs-offset-2 ">Producto:</div>
                        <div class="col-md-4"><input type="text" name="producto" value="" size="32" class="form-control"></div>
                    </div>
                    
                    
         <!--     -->      
            
            <div class="row form-group">
    			<div class="col-md-1 col-xs-offset-2 ">Categoria:</div>
    			<div class="col-md-4">
                <select name="categoria" class="form-control"  onChange="from(document.form1.categoria.value ,'subcat', 'subcategoria_release.php')">
                 	<option value="0" >Selecciones una Categoria</option>
                   	<?php do {  ?>
                   <option value="<?php echo $row_categoria['id']?>" ><?php echo $row_categoria['categoria']?></option>
                   	<?php } while ($row_categoria = mysql_fetch_assoc($categoria)); ?>
                  	</select>
              	</div>
    		</div>
            
            
            
            <div  class="row form-group" id="subcat" >
    			<div class="col-md-1 col-xs-offset-2 ">Subcategoria: </div>
    			<div class="col-md-4">
                            <select name="subcategoria" class="form-control">
                                <option value="0" >Selecciones una Subcategoria</option>
                                   <option value="" >
                            </select>
              	</div>
    		</div>

            
            
            
            <div class="row form-group">
    			<div class="col-md-1 col-xs-offset-2 ">Imagen:</div>
    			<div class="col-md-4">
                	<input type="text" name="imagen" value="" size="32" class="form-control">
                </div>
                	<div class="col-md-3">
                 		<input type="button" class="btn btn-primary" name="button" id="button" value="Subir imagen" onclick="javascript:subirimagen();"/>
                 	</div>
    		</div>
            
            <div class="row form-group">
    			<div class="col-md-1 col-xs-offset-2 ">Precio:</div>
    					<div class="col-md-4">
                        	<input type="text" name="precio" value="" size="32" class="form-control">
                        </div>
    		</div>
            
            
             <div class="row form-group">

    			<div class="col-md-4 col-xs-offset-3">
                	<input type="submit" value="Registrar" class="btn btn-success">
                </div>
    		</div>
            
            <input type="hidden" name="MM_insert" value="form1">
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
    <script language="javascript" src="js/jquery-1.2.6.min.js"></script>
    
  </body>
</html>

<?php
mysql_free_result($categoria);
?>