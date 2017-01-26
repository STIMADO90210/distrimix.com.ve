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

if(isset($_POST['buscar'])){
$query_prod="SELECT * FROM producto WHERE producto.producto LIKE '%".$_POST['buscar']."%'";
$prod=mysql_query($query_prod, $master) or die(mysql_error());
$row_prod = mysql_fetch_assoc($prod);
$totalRows_prod = mysql_num_rows($prod);
$varid_cat=0;



}else{


$varid_cat = 0;
if (isset($_GET["idreg"])) {
  $varid_cat = $_GET["idreg"];
}

if($varid_cat==0){


mysql_select_db($database_master, $master);
$query_prod = "SELECT * FROM producto";
$prod = mysql_query($query_prod, $master) or die(mysql_error());
$row_prod = mysql_fetch_assoc($prod);
$totalRows_prod = mysql_num_rows($prod);
	
}else{


mysql_select_db($database_master, $master);



$query_prod = sprintf("SELECT * FROM producto WHERE subcategoria=%s", GetSQLValueString($varid_cat, "int"));
$prod = mysql_query($query_prod, $master) or die(mysql_error());
$row_prod = mysql_fetch_assoc($prod);
$totalRows_prod = mysql_num_rows($prod);





/*$query_prod = sprintf("SELECT * FROM producto WHERE producto.categoria=%s", GetSQLValueString($varid_cat, "int"));
$prod = mysql_query($query_prod, $master) or die(mysql_error());
$row_prod = mysql_fetch_assoc($prod);
$totalRows_prod = mysql_num_rows($prod);*/


}
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>Distrimix</title>
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
<script src="js/responsiveslides.min.js"></script>
<script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
</script>
<script type="text/javascript" src="js/hover_pack.js"></script>
</head>
<body>
<?php  include('menubar.php'); ?>

<div class="column_center">
  <div class="container">
	<div class="search">
	  <div class="stay">Buscar Productos</div>
	  <div class="stay_right">
   <form action="catalogo.php" method="post" name="form1" id="form1">
   <input type="text" name="buscar" id="buscar"  value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '';}">
		  <input type="submit" name="enviar" id="enviar" value="">
   </form>
	  </div>
	  <div class="clearfix"> </div>
	</div>
    <div class="clearfix"> </div>
  </div>
</div>
<div class="main">
  <div class="content_top">
  	<div class=" container-fluid ">
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
       
       
	   <div class="col-md-9 content_right">
	    <?php if($varid_cat==0){?>
        <h4 class="head"><span class="m_2">Categoria: </span>Todas Las SubCategorias</h4>
        <?php }else{?>
        <h4 class="head"> <span class="m_2">Subcategoria: </span> <?php  subcat($varid_cat); ?></h4>
        <?php }?>	 
        
        
        
        
        
        
        
         
         
         

        
        
        
        
        
        
        
          	 
	    
        
        
          <div class="top_grid2">
          
          
         <?php 
		
		 if($totalRows_prod<>0){
			   do { 
		 ?> 
       	<div class="col-md-4 top_grid1-box1">
 			<div class="grid_1">
                <div class="b-link-stroke b-animate-go  thickbox">
                  	<a href="detalle.php?idreg=<?php echo $row_prod['id']; ?>">
                   		<img src="images/catalogo/<?php echo $row_prod['imagen']; ?>" class="img-responsive" alt=""/> 
            		</a>
          		</div>
       			<div class="grid_2">
                  <p><a href="detalle.php?idreg=<?php echo $row_prod['id']; ?>"><?php echo strtoupper($row_prod['producto']); ?></a></p>
                  <p class="text-muted"><small><?php  echo cat2($row_prod['categoria']); ?> / <?php  subcat($row_prod['subcategoria']);  ?> </small></p>
                  <ul class="grid_2-bottom">
                    <li class="grid_2-left"><p><?php /*?><a href="detalle.php?idreg=<?php echo $row_prod['id']; ?>">Bs. <?php 
					$cifra=explode(',',number_format($row_prod['precio'], 2, ',', '.'));
					echo $cifra[0]; ?><small><?php echo $cifra[1]?></small></a><?php */?></p>
                    </li>
                    <li class="grid_2-right">
                    <div class="  " target="_self" title="Get It">
                    	<a href="detalle.php?idreg=<?php echo $row_prod['id']; ?>" class="btn btn-primary btn-normal btn-inline " >Detalle</a>
                 	</div>
                    
                    
                    </li>
                <div class="clearfix"> </div>
                  </ul>
                </div>
              </div>
              <div class="col-lg-12">&nbsp;</div>
          
            </div>
            
          
            
               <?php
			    } while ($row_prod = mysql_fetch_assoc($prod));
				 }else{ 
				 ?>
             	<strong>No Hay Productos Registrados En esta Categoria</strong>
 				<br><h3><a href="catalogo.php?idreg=0" class="btn"> Volver </a></h3>
 				
				
				<?php }	 ?>
            <div class="clearfix"> </div>
            </div>
            
             
             
            
 
          
                  
<!-- siguiente lidea-->       
         
	    
	    
	     
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
</html>
<?php
mysql_free_result($categoria);

mysql_free_result($prod);
?>
