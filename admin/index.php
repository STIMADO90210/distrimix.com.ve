
<?php require_once('../Connections/master.php'); ?>

<?php mysql_select_db($database_master, $master);
		$query_despachono = "SELECT * FROM clientepedido WHERE clientepedido.status=1";
		$despachono = mysql_query($query_despachono, $master) or die(mysql_error());
		$row_despachono = mysql_fetch_assoc($despachono);
		$totalRows_despachono = mysql_num_rows($despachono);
		
		
		$query_despachosi = "SELECT * FROM clientepedido WHERE clientepedido.status=2";
		$despachosi = mysql_query($query_despachosi, $master) or die(mysql_error());
		$row_despachono = mysql_fetch_assoc($despachosi);
		$totalRows_despachosi = mysql_num_rows($despachosi);
		
		$query_despacho = "SELECT * FROM clientepedido";
		$despacho = mysql_query($query_despacho, $master) or die(mysql_error());
		$row_despachono = mysql_fetch_assoc($despacho);
		$totalRows_despacho = mysql_num_rows($despacho);
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
 <br>
 
<div class="container">
<h3 class="text-primary" >Bienvenido al Panel de Administración</h3><hr><br>

			<div class="row">
         	<div class="col-xs-6 col-md-4">
                    <div class="panel status panel-primary">
                        <div class="panel-heading h0">
                        
                            <i class="fa fa-shopping-cart fa-lg"></i>
                            <span class="pull-right">
                                <span class="label  pull-right"><?php echo $totalRows_despachono ?></span>
                            </span>
                       
                        </div>
                        <div class="panel-body text-center">                        
                           <h3> <strong>PEDIDOS POR DESPACHAR</strong></h3>
                        </div>
                       <div class="panel-body text-center">                        
                             <a href="despachadono.php"> <small><i class="fa fa-eye"></i> DETALLE</small></a>     
                        </div>
                    </div>
                </div>
                
                         <div class="col-xs-6 col-md-4">
                    <div class="panel status panel-verde ">
                        <div class="panel-heading h0 ">
                            <i class="fa fa-credit-card fa-lg"></i>
                            <span class="pull-right">
                                <span class="label  pull-right"><?php echo $totalRows_despachosi ?></span>
                            </span>
                        </div>
                        <div class="panel-body text-center">                        
                            <h3><strong>PEDIDOS  DESPACHADOS</strong></h3>
                        </div>
                       <div class="panel-body text-center">                        
                            <a href="despachadosi.php"><small><i class="fa fa-eye"></i> DETALLE</small></a>     
                        </div>
                    </div>
                </div>
               
              
				   <div class="col-xs-6 col-md-4">
                    <div class="panel status panel-fugcia ">
                        <div class="panel-heading h0 ">
                            <i class="fa fa-tags fa-lg"></i>
                            <span class="pull-right">
                                <span class="label  pull-right"><?php echo $totalRows_despacho ?></span>
                            </span>
                        </div>
                        <div class="panel-body text-center">                        
                            <h3><strong>PEDIDOS TOTALES</strong></h3>
                        </div>
                        <div class="panel-body text-center">                        
                             &nbsp;   
                        </div>
                    </div>
                </div>
                
			</div>



 
	
  
</div> 
<!--MENU DE NAVEGACION-->

    
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