<?php require_once('Connections/master.php');
include("funcion.php")

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
$query_categoria = "SELECT * FROM categoria";
$categoria = mysql_query($query_categoria, $master) or die(mysql_error());
$row_categoria = mysql_fetch_assoc($categoria);
$totalRows_categoria = mysql_num_rows($categoria);

mysql_select_db($database_master, $master);
$query_subcat = "SELECT * FROM subcategoria";
$subcat = mysql_query($query_subcat, $master) or die(mysql_error());
$row_subcat = mysql_fetch_assoc($subcat);
$totalRows_subcat = mysql_num_rows($subcat);

$var_prod = "0";
if (isset($_GET["idreg"])) {
  $var_prod = $_GET["idreg"];
}
mysql_select_db($database_master, $master);
$query_prod = sprintf("SELECT * FROM producto WHERE producto.id=%s", GetSQLValueString($var_prod, "int"));
$prod = mysql_query($query_prod, $master) or die(mysql_error());
$row_prod = mysql_fetch_assoc($prod);
$totalRows_prod = mysql_num_rows($prod);
?>
<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Distrimix | Detalle Producto</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Fashionpress Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!-- Custom Theme files -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Custom Theme files -->
<!--webfont-->
<link href='http://fonts.googleapis.com/css?family=Lato:100,200,300,400,500,600,700,800,900' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/hover_pack.js"></script>
<link rel="stylesheet" href="css/etalage.css">
<script src="js/jquery.etalage.min.js"></script>
<script>
			jQuery(document).ready(function($){

				$('#etalage').etalage({
					thumb_image_width: 260,
					thumb_image_height: 210,
					source_image_width: 1200,
					source_image_height: 1200,
					show_hint: true,
					click_callback: function(image_anchor, instance_id){
						alert('Callback example:\nYou clicked on an image with the anchor: "'+image_anchor+'"\n(in Etalage instance: "'+instance_id+'")');
					}
				});

			});
		</script>
<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
		    <script type="text/javascript">
			    $(document).ready(function () {
			        $('#horizontalTab').easyResponsiveTabs({
			            type: 'default', //Types: default, vertical, accordion           
			            width: 'auto', //auto or any width like 600px
			            fit: true   // 100% fit in a container
			        });
			    });
            </script>	

</head>
<body>
<div class="header">
	<div class="header_top">
		<div class="container">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt=""/></a>
			</div>
			<ul class="shopping_grid">
			  <?php if(isset($_SESSION['MM_Username']))
			  {
				  ?> 
				      <a><li><i class="fa fa-user"></i> Usuario : <?php echo strtoupper($_SESSION['MM_nombre']) ?></li></a>
                      <a href="logout.php"><li>Cerrar Session</li></a>
                      
                      <?php }else{?>
				  				    

		      <a href="login.php"><li><i class="fa fa-user"></i> Iniciar Sesi&oacute;n</li></a>
              <a href="registro.php"><li>Registrar</li></a>
              <?php }?>
              
<?php         if (isset($_SESSION['carro'])) { ?>
               <a href="#"><li><span class="m_1">Pedido</span>&nbsp;&nbsp;(<?php echo  count($_SESSION['carro']) ;?>) &nbsp; <i class="fa fa-shopping-cart"></i></li></a>
              <?php  }else{?>
			      <a href="#"><li><span class="m_1">Pedido</span>&nbsp;&nbsp;(0) &nbsp; <i class="fa fa-shopping-cart"></i></li></a>
			  <?php }	  ?>
              
             
                  <div class="clearfix"> </div>
			</ul>
		    <div class="clearfix"> </div>
		</div>
	</div>
	<div class="h_menu4"><!-- start h_menu4 -->
		<div class="container">
				<a class="toggleMenu" href="#">Menu</a>
				<ul class="nav">
					<li><a href="index.php" data-hover="Inicio">Inicio</a></li>
					<li><a href="nosotros.php" data-hover="Nosotros">Nosotros</a></li>
					<li><a href="contactanos.php" data-hover="Contactanos">Contactanos</a></li>
					<li  class="active"><a href="catalogo.php" data-hover="Catalogo de Producto">Catalogo de Producto</a></li>
                     <?php if(isset($_SESSION['MM_Username']))
			  {
				  ?> 
					
                    
                    <?php }?>
                    
                      <?php if(isset($_SESSION['MM_Username'])){ ?>
                    <li><a href="cotizacion.php" data-hover="Cotización">Cotización</a></li>
                    <li><a href="histo_pedidos.php" data-hover="Cotización">Historico Pedidos</a></li>
                    <?php }?>
                    
                     <?php if(isset($_SESSION['MM_Username'])&& $_SESSION['MM_nivel']==1)  {   ?> 
                     
                    <li><a href="admin.php" data-hover="Cotización">Administracion</a></li>
                    <?php }?>
                    
                    
				 </ul>
				 <script type="text/javascript" src="js/nav.js"></script>
	      </div><!-- end h_menu4 -->
     </div>
</div>
<div class="column_center">
  <div class=" container">
	<div class="search">
	  <div class="stay">Buscar Productos</div>
	  <div class="stay_right">
		  <input type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
		  <input type="submit" value="">
	  </div>
	  <div class="clearfix"> </div>
	</div>
    <div class="clearfix"> </div>
  </div>
</div>
<div class="main">
  <div class="content_top">
  	<div class="container-fluid">
	   <div class="col-md-3 sidebar_box">
              <div class="sidebar">
			<div class="menu_box">
		    <h3 class="menu_head">Categorias y SubCategorias</h3>
			  <ul class="menu">
				<li><a href="#"><img class="arrow-img" src="images/f_menu.png" alt=""/> Todas</a>
                <ul class="cute">
                <li class="subitem1"><a href="catalogo.php?idreg=0">Todas Las Subcategorias </a></li>

                </ul>
                </li>
              
              <?php do{?>
				<li class="item3"><a href="#"><img class="arrow-img" src="images/f_menu.png" alt=""/> 
                
				<?php echo $row_categoria['categoria']; ?></a>
					<ul class="cute">

						<?php 
                        
                        $query_sub = sprintf("SELECT * FROM subcategoria WHERE subcategoria.categoria=%s",$row_categoria['id']);
                        $sub = mysql_query($query_sub, $master) or die(mysql_error());
                        $row_sub = mysql_fetch_assoc($sub);
                        $totalRows_sub = mysql_num_rows($sub);
                        
                        ?>                    

				<?php do{ ?>
<li class="subitem1"><a href="catalogo.php?idreg=<?php echo $row_sub['id']; ?>"><?php echo $row_sub['subcategoria'] ?> </a></li>
               <?php } while ($row_sub = mysql_fetch_assoc($sub)); ?>  

					</ul>
				</li>
				  <?php } while ($row_categoria = mysql_fetch_assoc($categoria)); ?>
			</ul>
		</div>
       
       
       
				<!--initiate accordion-->
		<script type="text/javascript">
			$(function() {
			    var menu_ul = $('.menu > li > ul'),
			           menu_a  = $('.menu > li > a');
			    menu_ul.hide();
			    menu_a.click(function(e) {
			        e.preventDefault();
			        if(!$(this).hasClass('active')) {
			            menu_a.removeClass('active');
			            menu_ul.filter(':visible').slideUp('normal');
			            $(this).addClass('active').next().stop(true,true).slideDown('normal');
			        } else {
			            $(this).removeClass('active');
			            $(this).next().stop(true,true).slideUp('normal');
			        }
			    });
			
			});
		</script>
       </div>

		  <div class="delivery">
				<img src="images/delivery.jpg" class="img-responsive" alt=""/>
				<h3>Despachos</h3>
				<h4>Nacionales y Regionales</h4>
			</div>

			
			
	   </div> 
	   <div class="col-md-9 single_right">
	   	<div class="single_top">
	       <div class="single_grid">
				<div class="grid images_3_of_2">
						<ul id="etalage">
							<li>
								<a href="">
								<img class="etalage_thumb_image" src="images/catalogo/<?php echo $row_prod['imagen']; ?>" class="img-responsive" />	
					<img src="images/catalogo/<?php echo $row_prod['imagen']; ?>" class=" etalage_source_image"  class="img-responsive" title="" />
                    
								</a>
							</li>
                            <li>
                            </li>

							
						</ul>
						 <div class="clearfix"></div>		
				  </div> 
                  
				  <div class="desc1 span_3_of_2">
				  	<h1><?php echo $row_prod['producto']; ?></h1>
                    <p><a href="#"><?php echo cat ($row_prod['categoria']); ?></a> / <a href="#"><?php echo subcat($row_prod['subcategoria']); ?></a></p><br>
                    <p class="availability"><strong>DISPONIBILIDAD EN STOCK:</strong> <span class="color"> <?php echo $row_prod['stok']; ?></span></p>
				
			    <div class="price_single">
				  <!--<span class="reducedfrom">Bs. 140.00</span>-->
				  <?php /*?><span class="actual">Bs. <?php echo number_format($row_prod['precio'], 2, ',', '.'); ?></span><?php */?><!--<a href="#">click for offer</a>-->
				</div>
				<h2 class="quick">Descripción Corta:</h2>
				<p class="quick_desc"><?php echo $row_prod['producto']; ?></p>
                
                
			    
				<div class="quantity_box">
					<ul class="product-qty">
					   <span>Cantidad:</span>
                       <form action="carro.php" method="post" name="form1">
					   <select name="cant" id="cant" >
						 <option value="1">1</option>
						 <option value="2">2</option>
						 <option value="3">3</option>
						 <option value="4">4</option>
						 <option value="5">5</option>
						 <option value="6">6</option>
					   </select>
				    </ul>
				    <ul class="single_social">
						<li><a href="#"><i class="fb1"> </i> </a></li>
						<li><a href="#"><i class="tw1"> </i> </a></li>
						<li><a href="#"><i class="g1"> </i> </a></li>
						<li><a href="#"><i class="linked"> </i> </a></li>
		   		    </ul>
		   		    <div class="clearfix"></div>
	   		    </div>
			    
                <input name="prodid" type="hidden" value="<?php echo $row_prod['id']; ?>">
                <input name="prod" type="hidden" value="<?php echo $row_prod['producto']; ?>">
                <input name="precio" type="hidden" value="<?php echo $row_prod['precio']; ?>">
               <div class="contact-form">
                <input name="agregar" type="submit" value="Agregar"  ></div>
                </form>
			</div>
		    <div class="clearfix"> </div>
				</div>
                
                
          	    <div class="clearfix"></div>
          </div>
          <div class="sap_tabs">	
				     <div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
						  <ul class="resp-tabs-list">
						  	  <li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Descripción de Producto</span></li>
							  <li class="resp-tab-item" aria-controls="tab_item-1" role="tab"><span>Información Adicinal</span></li>
							  <li class="resp-tab-item" aria-controls="tab_item-2" role="tab"><span>Observaciones</span></li>
							  <div class="clear"></div>
						  </ul>				  	 
							<div class="resp-tabs-container">
							    <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
									<div class="facts">
									  <ul class="tab_list">
									  	<li><a href="#"><?php echo $row_prod['producto']; ?></a></li>
									  	
									  </ul>           
							        </div>
							     </div>	
							      <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-1">
									<div class="facts">
									  <ul class="tab_list">
									    <li><a href="#"></a></li>
									 
									  </ul>           
							        </div>
							     </div>	
							      <div class="tab-1 resp-tab-content" aria-labelledby="tab_item-2">
									<ul class="tab_list">
									  	<li><a href="#"></a></li>

									  </ul>      
							     </div>	
							 </div>
					      </div>
			  </div>
		<!--<h3 class="single_head">Productos Relacionados</h3>	-->
	     
	    <!--<div class="top_grid2">
	      <div class="col-md-4 top_grid1-box1"><a href="detalle.php">
	     	<div class="grid_1">
	     	  <div class="b-link-stroke b-animate-go  thickbox">
		        <img src="images/p3.jpg" class="img-responsive" alt=""/> </div>
	     	  <div class="grid_2">
	     	  	<p>Cinta Plastica</p>
	     	  	<ul class="grid_2-bottom">
	     	  		<li class="grid_2-left"><p>Bs. 55<small>.33</small></p></li>
	     	  		<li class="grid_2-right"><div class="btn btn-primary btn-normal btn-inline " target="_self" title="Get It">Detalle</div></li>
	     	  		<div class="clearfix"> </div>
	     	  	</ul>
	     	  </div>
	     	</div>
	     </a></div>
	     <div class="col-md-4 top_grid1-box1"><a href="detalle.php">
	     	<div class="grid_1">
	     	  <div class="b-link-stroke b-animate-go  thickbox">
		        <img src="images/p3.jpg" class="img-responsive" alt=""/> </div>
	     	  <div class="grid_2">
	     	  	<p>Cinta Plastica</p>
	     	  	<ul class="grid_2-bottom">
	     	  		<li class="grid_2-left"><p>Bs. 55<small>.33</small></p></li>
	     	  		<li class="grid_2-right"><div class="btn btn-primary btn-normal btn-inline " target="_self" title="Get It">Detalle</div></li>
	     	  		<div class="clearfix"> </div>
	     	  	</ul>
	     	  </div>
	     	</div>
	     </a></div>
	     <div class="col-md-4 top_grid1-box1"><a href="detalle.php">
	     	<div class="grid_1">
	     	  <div class="b-link-stroke b-animate-go  thickbox">
		        <img src="images/p3.jpg" class="img-responsive" alt=""/> </div>
	     	  <div class="grid_2">
	     	  	<p>Cinta Plastica</p>
	     	  	<ul class="grid_2-bottom">
	     	  		<li class="grid_2-left"><p>Bs. 55<small>.33</small></p></li>
	     	  		<li class="grid_2-right"><div class="btn btn-primary btn-normal btn-inline " target="_self" title="Get It">Detalle</div></li>
	     	  		<div class="clearfix"> </div>
	     	  	</ul>
	     	  </div>
	     	</div>
	     </a></div>
	     <div class="clearfix"> </div>
	    </div>--> 
        </div>
      </div> 
	</div>
</div>
<div class="footer_bg">
</div>
<div class="footer">
	<div class="container">
		<div class="col-md-3 f_grid1">
			<h3>Nosotros</h3>
			<a href="#"><img src="images/logo.png" alt=""/></a>
			<p>Somos una empresa especializada en la distribuci&oacute;n y suministro de art&iacute;culos de papeler&iacute;a y de oficina, ubicada en la Ciudad de Maracaibo.</p>
		</div>
		<!--<div class="col-md-3 f_grid1 f_grid2">
			<h3>Siganos</h3>
			<ul class="social">
				<li><a href=""> <i class="fb"> </i><p class="m_3">Facebook</p><div class="clearfix"> </div></a></li>
			    <li><a href=""><i class="tw"> </i><p class="m_3">Twittter</p><div class="clearfix"> </div></a></li>
				<li><a href=""><i class="google"> </i><p class="m_3">Google</p><div class="clearfix"> </div></a></li>
				<li><a href=""><i class="instagram"> </i><p class="m_3">Instagram</p><div class="clearfix"> </div></a></li>
			</ul>
		</div>-->
		<div class="col-md-6 f_grid3">
			<h3>Informaci&oacute;n de Contactos</h3>
			<ul class="list">
				<li><p>Telefono : +58 (0261) 5114007</p></li>
				<li><p>+58 (0261) 4180985</p></li>
                <li><p>+58 (0416) 6158364 - 6158354</p></li>
				<li><p>Email : <a href="mailto:info(at)dismitrix.com"> info@dismitrix.com</a></p></li>
			</ul>
			<ul class="list1">
				<li><p>Venezuela - Estado Zulia.</p></li>
			</ul>
			<div class="clearfix"> </div>
		</div>
	</div>
</div>
<div class="footer_bottom">
       	<div class="container">
       		<div class="cssmenu">
				<ul>
					<li class="active"><a href="">Politicas</a></li> .
					<li><a href="">Registrarse</a></li> .
					<li><a href="">Contactanos</a></li> .
					<li><a href="">Soporte</a></li>
				</ul>
			</div>
			<div class="copy">
			    <p>&copy;  2015 Distrimix, C.A. | Diseño <a href="http://rddsistemas.com" target="_blank">RdD Sistemas</a></p>
		    </div>
		    <div class="clearfix"> </div>
       	</div>
</div>
</body>
</h>
<?php
mysql_free_result($prod);

mysql_free_result($cat);
?>
tml>		