<?php require_once('../../Connections/master.php'); ?>
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
  $insertSQL = sprintf("INSERT INTO programacion (imagen) VALUES (%s)",
                       GetSQLValueString($_POST['imagen'], "text"));

  mysql_select_db($database_conex, $conex);
  $Result1 = mysql_query($insertSQL, $conex) or die(mysql_error());
}
?>
<?php require_once('funcionsubirimg.php');?>

<!DOCTYPE html PUBLIC "">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<meta name="generator" content="WebMotionUK" />
        <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
	<title>Subir Imagen</title>
	<script type="text/javascript" src="js/jquery-pack.js"></script>
	<script type="text/javascript" src="js/jquery.imgareaselect.min.js"></script>
</head>
<body>

<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#">Subir imagen</a></li>
</ul>

<div class=" container">
  <div class="col-lg-6">
    <div class="input-group">


<?php
//Only display the javacript if an image has been uploaded
if(strlen($large_photo_exists)>0){
	$current_large_image_width = getWidth($large_image_location);
	$current_large_image_height = getHeight($large_image_location);?>
<script type="text/javascript">
function preview(img, selection) { 
	var scaleX = <?php echo $thumb_width;?> / selection.width; 
	var scaleY = <?php echo $thumb_height;?> / selection.height; 
	
	$('#thumbnail + div > img').css({ 
		width: Math.round(scaleX * <?php echo $current_large_image_width;?>) + 'px', 
		height: Math.round(scaleY * <?php echo $current_large_image_height;?>) + 'px',
		marginLeft: '-' + Math.round(scaleX * selection.x1) + 'px', 
		marginTop: '-' + Math.round(scaleY * selection.y1) + 'px' 
	});
	$('#x1').val(selection.x1);
	$('#y1').val(selection.y1);
	$('#x2').val(selection.x2);
	$('#y2').val(selection.y2);
	$('#w').val(selection.width);
	$('#h').val(selection.height);
} 

$(document).ready(function () { 
	$('#save_thumb').click(function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("Usted debe hacer una selección primero");
			return false;
		}else{
			return true;
		}
	});
}); 

$(window).load(function () { 
	$('#thumbnail').imgAreaSelect({ aspectRatio: '1:<?php echo $thumb_height/$thumb_width;?>', onSelectChange: preview }); 
});

</script>



<?php }?>



<?php

//Display error message if there are any
if(strlen($error)>0){ echo "<ul><li><strong>Error!</strong></li><li>".$error."</li></ul>";} ?>


<?php if(strlen($large_photo_exists)>0 && strlen($thumb_photo_exists)>0){ ?> 
	<?php echo $thumb_photo_exists;?><br />
    <small>
		<?php echo "nombre de imagen ".$thumb_image_name = $thumb_image_prefix.$_SESSION['random_key'].$_SESSION['user_file_ext']; ?>
  	</small><br /><br />
	<a href="<?php echo $_SERVER["PHP_SELF"]."?a=delete&t=".$_SESSION['random_key'].$_SESSION['user_file_ext']?>" class="btn btn-danger">
    	Eliminar imagen y seleccionar otra
  	</a>
    
      <!--ENVIA VARIABLE A FORMULARIO form1-->   
	  	<script>
 		opener.document.form1.imagen.value="<?php echo $thumb_image_name = $thumb_image_prefix.$_SESSION['random_key'].$_SESSION['user_file_ext']; ?>";
		</script>
    
    
    <?php	//Borrar sesion de nombre y extencion de archivo
	$_SESSION['random_key']= "";
	$_SESSION['user_file_ext']= ""; ?>
    
       


    
 &nbsp;<input name="button" type="button" onclick="window.close();" value="Usar Imagen"  class="btn btn-success"/> 

                        	
<?php }else{
		if(strlen($large_photo_exists)>0){?>
        
<h2>Recortar imagen</h2>
		<div align="center">
			<img src="<?php echo $upload_path.$large_image_name.$_SESSION['user_file_ext'];?>" style="float: left; margin-right: 10px;" id="thumbnail" alt="Create Thumbnail" />
			<div style="border:1px #e5e5e5 solid; float:left; position:relative; overflow:hidden; width:<?php echo $thumb_width;?>px; height:<?php echo $thumb_height;?>px;">
				<img src="<?php echo $upload_path.$large_image_name.$_SESSION['user_file_ext'];?>" style="position: relative;" alt="Thumbnail Preview" />
		  </div>
          
          
			<br style="clear:both;"/>
			<form name="thumbnail" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
				<input type="hidden" name="x1" value="" id="x1" />
				<input type="hidden" name="y1" value="" id="y1" />
				<input type="hidden" name="x2" value="" id="x2" />
				<input type="hidden" name="y2" value="" id="y2" />
				<input type="hidden" name="w" value="" id="w" />
				<input type="hidden" name="h" value="" id="h" />
				<input type="submit" name="upload_thumbnail" value="Guardar imagen" id="save_thumb" class="btn btn-success" />
			</form>
            <br />
            
            
</div>

    
	<?php 	} ?>
   <?php if(strlen($large_photo_exists)==0 && strlen($thumb_photo_exists)==0){ ?>  

    <h5>Imagen </h5>
	<form name="photo" enctype="multipart/form-data" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" >
	<input type="file" name="image" size="50" class="form-control form-group-lg "  /> <br /><br /><br />
    <input type="submit" name="upload" value="Subir" class="btn btn-success" />
	</form>
    <?php } ?>
 
<?php } ?>
</div>
</div>

</div>

    
  </body>
</html>