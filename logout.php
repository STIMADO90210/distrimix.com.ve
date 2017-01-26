<?php require_once('Connections/master.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
</head>

<body>
<?php

  $_SESSION['MM_Username'] = "";
    $_SESSION['MM_UserGroup'] =  "";
	$_SESSION['MM_nombre']= "";
	$_SESSION['MM_cedula']= "";
    $_SESSION['MM_nivel']= "";
 session_destroy();
 
 ?>
 <script>
 

 window.setTimeout('window.location="index.php";',".$ss."); 
 
 </script>"; 
</body>
</html>