
<?php require_once('../Connections/master.php'); 
include("funcion.php");



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
?>

<?php

$nrocli=0;
if(isset($_POST['cliente']))
{
	$nrocli=$_POST['cliente'];
}
if($nrocli>0){

			mysql_select_db($database_master, $master);
			
			$query_despachono = sprintf("SELECT * FROM clientepedido WHERE clientepedido.status=1 AND clientepedido.idcliente=%s",$_POST['cliente']);
			$despachono = mysql_query($query_despachono, $master) or die(mysql_error());
			$row_despachono = mysql_fetch_assoc($despachono);
			$totalRows_despachono = mysql_num_rows($despachono);

}else{
		mysql_select_db($database_master, $master);
		$query_despachono = "SELECT * FROM clientepedido WHERE clientepedido.status=1";
		$despachono = mysql_query($query_despachono, $master) or die(mysql_error());
		$row_despachono = mysql_fetch_assoc($despachono);
		$totalRows_despachono = mysql_num_rows($despachono);
}
?>

<?php
mysql_select_db($database_master, $master);
$query_user = "SELECT * FROM usuario";
$user = mysql_query($query_user, $master) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);
?>
<!DOCTYPE html>
<html lang="en"><head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Panel Administración</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css">

    
    

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


 <div class="container ">

<h1>Pedidos No Despachados <?php clie2($nrocli) ?></h1><hr>
<form action="despachadono.php" method="post">

<div class="form-group col-lg-6"> 
    <select class="form-control"  name="cliente" id="cliente">
      <option value="0">Escoja Un Cliente</option>
     <?php do { ?> 
      <option value="<?php echo $row_user['id']; ?>"><?php echo $row_user['razon_social']; ?></option>
     <?php } while ($row_user = mysql_fetch_assoc($user)); ?> 
    </select>
</div>
    <input class="btn btn-info" name="enviar" type="submit" id="enviar" value="Listar Por Cliente">

</form>
<br>
<table class="table table-bordered">

  <tr class="active">
    <td width="18%" align="center">Id</td>
    <td width="37%" align="center">Cliente</td>
    <td width="18%" align="center">Pedido;</td>
    <td width="12%" align="center">Fecha</td>
    <td width="15%" align="center">Accion</td>

  </tr>
  <?php 
		  if($totalRows_despachono>0)
			  {
  ?>
   <?php do {
	   $fechaP=date( "d-m-Y" , strtotime($row_despachono['fecha']));
	   $ceros=strlen($row_despachono['nroPedido']);
				  switch ($ceros)
				   {
						case 1:
							$cadena= "0000";
							break;
						case 2:
							$cadena= "000";
							break;    
						case 3:
							$cadena= "00";
							break;    
						case 4:
							$cadena= "0";
							break; 
						
					}
	    ?>
     <tr>
       <td align="center"><?php echo $row_despachono['id']; ?></td>
       <td align="center"><?php clie2($row_despachono['idcliente']); ?></td>
       
      
      
       <td align="center"><?php echo $cadena.$row_despachono['nroPedido']; ?></td>
       <td align="center"><?php echo $fechaP ?></td>
       <td align="center"><a href="despacho_detalle.php?reg=<?php echo $row_despachono['nroPedido']; ?>&codcli=<?php echo $row_despachono['idcliente']; ?>&st=<?php echo $row_despachono['status']; ?> " class="btn btn-info btn-xs">Detalle</a></td>
     </tr>
     <?php } while ($row_despachono = mysql_fetch_assoc($despachono)); ?>
     <?php }else{?>
     <tr>
       <td align="center" colspan="5">Cliente No Tiene Pedidos sin Despachar</td>
      </tr> 
      
     
     <?php }?>
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
mysql_free_result($despachono);

mysql_free_result($user);
?>
