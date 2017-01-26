<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Subir Imagen</title>
<style type="text/css">
.fondos {
	font: "Arial Black", Gadget, sans-serif;
	color: #FFF;
	padding: 50px;
	height: 300px;
	width: 300px;
}
</style>
</head>
 <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
<body>
<div class="fondos">
  <?php if ((isset($_POST["enviado"])) && ($_POST["enviado"]== "form1"))
{
$archifoto	= $_FILES['fotopro']['name'];
move_uploaded_file($_FILES['fotopro']['tmp_name'],"images/".$archifoto);?>


  <script>

opener.document.form1.imagen.value="<?php echo  $archifoto  ?>";
self.close();

</script>


  <?php

}else{

?>
  <form action="imagenpro.php" method="post" enctype="multipart/form-data" name="form1" id="form1" >
    <p><input name="fotopro" class="btn btn-success btn-md " type="file" size="50" /></p>
    <p><input name="botton" type="submit" class="btn btn-success btn-md " id="botton" value="Subir Imagen"  /></p>
    <input name="enviado" type="hidden" value="form1" />
    
    
  </form>
  <?php }?>
</div>
</body>
</html>