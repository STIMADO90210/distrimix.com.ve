
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
$varreg_detped = "0";
if (isset($_GET['reg'])) {
  $varreg_detped = $_GET['reg'];
}

mysql_select_db($database_master, $master);
$query_detped = sprintf("SELECT * FROM pedido WHERE pedido.nroPedido=%s",$varreg_detped);
$detped = mysql_query($query_detped, $master) or die(mysql_error());
$row_detped = mysql_fetch_assoc($detped);
$totalRows_detped = mysql_num_rows($detped);

$varreg_detped = "0";
if (isset($_GET['reg'])) {
  $varreg_clidetped = $_GET['reg'];
}

 mysql_select_db($database_master, $master);
$query_clidetped = sprintf("SELECT * FROM clientepedido WHERE clientepedido.nroPedido=%s", $varreg_clidetped);
$clidetped = mysql_query($query_clidetped, $master) or die(mysql_error());
$row_clidetped = mysql_fetch_assoc($clidetped);
$totalRows_clidetped = mysql_num_rows($clidetped);

mysql_select_db($database_master, $master);
$query_envios = "SELECT * FROM envios";
$envios = mysql_query($query_envios, $master) or die(mysql_error());
$row_envios = mysql_fetch_assoc($envios);
$totalRows_envios = mysql_num_rows($envios);
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
    
    <script type="text/javascript" language="javascript" src="js/ajax2.js"></script>

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
<?php if(isset($_GET['st'])==1){ ?>

<h2>Pedidos Sin Despachar</h2><hr><br>

<?php }else{ ?>

<h2>Pedidos Despachados</h2><hr><br>

 <?php } ?>

<?php


 $codcli=isset($_GET['codcli']);  
 $nroped=$_GET['reg'];
mysql_select_db($database_master, $master);
$query_user = sprintf("SELECT * FROM usuario WHERE usuario.id=%s", $codcli );
$user = mysql_query($query_user, $master) or die(mysql_error());
$row_user = mysql_fetch_assoc($user);
$totalRows_user = mysql_num_rows($user);

$ceros=strlen($nroped);
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



 	<table class="table" >
     	<tr>
			<td  colspan="2"><h2><strong> PEDIDO # <?php echo $cadena.$nroped; ?></strong></h2></td>
		</tr>
		<tr>
			<td width="62%"><strong> NOMBRE O RAZON SOCIAL: <?php echo $row_user['razon_social'] ?></strong></td>
			<td width="38%"><strong>CEDULA / RIF: <?php echo $row_user['cedula'] ?></strong></td>
		</tr>
		<tr>
			<td width="62%">  <strong>REPRESENTANTE: <?php echo $row_user['representante'] ?></strong></td>
      <?php $fechaP=date( "d-m-Y" , strtotime($row_clidetped['fecha']));?>
			<td width="38%"><strong>FECHA: <?php echo $fechaP  ?></strong></td>
		</tr>
        <tr>
			<td width="100%" colspan="2" ><strong>DIRECCNIÓN FISCAL: <?php echo $row_user['direccion'] ?></strong></td>
		</tr>
        <tr>
			<td width="100%" colspan="2" ><strong>DIRECCNIÓN DE ENVIO: <?php echo $row_user['dir_despacho'] ?></strong></td>
		</tr>

	</table>





     
      <table class="table table-responsive" >
        <tr class="active table-bordered">
          <td width="8%" align="center"><strong>ID</strong></td>
          <td width="49%" align="left"><strong>PRODUCTOS</strong></td>
          <td width="14%" align="right"><strong>PRECIO</strong></td>
          <td width="12%" align="right"><strong>CANTIDAD</strong></td>
          <td width="17%" align="right"><strong>SUBTOTAL</strong></td>
        </tr>
        <?php $suma=0; ?>
         <?php do { ?>
        <tr>
          <td align="center"><?php echo $row_detped['idpro']; ?></td>
          <td align="left"><?php echo $row_detped['produ']; ?></td>
          <td align="right"><?php echo $row_detped['precio']; ?></td>
          <td align="right"><?php echo $row_detped['cant']; ?></td>
          <td align="right"><?php echo $row_detped['subtotal']; ?></td>
		 <?php  $suma=$suma+$row_detped['subtotal'];?>
        </tr>
          <?php } while ($row_detped = mysql_fetch_assoc($detped)); ?>
         <tr class="active">
         <td align="center"></td>
         <td align="left"></td>
         <td align="right"></td>
         <td align="right"><strong>TOTAL</strong></td>
         <td align="right"><strong><?php echo  $suma;  ?></strong></td>
         </tr>
         
          <tr>
			<td align="right" colspan="6">
            
   <?php  if (isset ($_GET['st'])) {  $status= $_GET['st'];  }
 			   if ($status==1){ ?>
      					<a href="camb_status.php?reg=<?php echo $nroped ?>" class="btn btn-primary btn-lg">DESPACHAR</a>
  			<?php  } else {?>
    					<a>PRODUCTO DESPACHADO</a>
            <?php } ?>
            </td>
	 </tr>
    
     
		
		
  </table>
   


      <?php /*?>  <form action="" method="post" name="form1" id="form1" class="form-control">
              <select name="envio" id="envio" class="form-control" onchange="OnSelectionChange (this)">
 						      <option class="form-control" value="0">Elija Tipo De Envio</option>       
                  <?php do { ?>
                  	<option class="form-control" value="<?php echo $row_envios['id']; ?>"><?php echo $row_envios['tipo_envio']; ?></option>
                  <?php } while ($row_envios = mysql_fetch_assoc($envios)); ?>  
                </select>
               </form><?php */?>


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



 <script type="text/javascript">
        function OnSelectionChange (select) {
            var selectedOption = select.options[select.selectedIndex];
           
document.getElementById("subcat2").innerHTML= selectedOption.value+"000"; 
        }
    </script>
     <!-- Bootstrap core JavaScript-->
<script src="js/jquery-1.11.2.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js" type="text/javascript"></script>
  </body>
</html>
<?php
mysql_free_result($detped);

mysql_free_result($envios);
?>
