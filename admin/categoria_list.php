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

mysql_select_db($database_master, $master);
$query_categoria = "SELECT * FROM categoria";
$categoria = mysql_query($query_categoria, $master) or die(mysql_error());
$row_categoria = mysql_fetch_assoc($categoria);
$totalRows_categoria = mysql_num_rows($categoria);
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


		  	<h4>Categoria</h4>
		  	  <p>Agrege una Categoria</p>
              
		  	  

              
              <table class="table table-responsive table-hover" >
  <tr class="active">
    <td width="10%" align="center" valign="middle" ><strong>ID</strong></td>
    <td width="43%" align="center" valign="middle" ><strong>CATEGORIA</strong></td>
    <td colspan="2" align="center" valign="middle" ><strong>ACCIONES</strong></td>
    </tr>
  <?php do { ?>
    <tr>
      <td align="center" valign="middle" ><?php echo $row_categoria['id']; ?></td>
      <td align="center" valign="middle" ><?php echo $row_categoria['categoria']; ?></td>
      <td width="10%" align="center" valign="middle" ><a href="categoria_edit.php?idreg=<?php echo $row_categoria['id']; ?>" class="btn btn-info btn-xs">editar</a></td>
      <td width="10%" align="center" valign="middle" > <a href="borrarcat.php?idreg=<?php echo $row_categoria['id']; ?>" class="btn btn-danger btn-xs">eliminar</a></td>
    </tr>
    <?php } while ($row_categoria = mysql_fetch_assoc($categoria)); ?>
           </table>







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
<?php
mysql_free_result($categoria);
?>
