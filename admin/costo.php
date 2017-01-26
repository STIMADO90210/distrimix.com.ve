<?php require_once('../Connections/master.php'); 

$id =$_GET['id'];				

mysql_select_db($database_master, $master);
$query_subcat = sprintf("SELECT * FROM envios WHERE envios.id=%s", $id);
$subcat = mysql_query($query_subcat, $master) or die(mysql_error());
$row_subcat = mysql_fetch_assoc($subcat);
$totalRows_categoria = mysql_num_rows($subcat);

?>


	<form action="" method="get">
    	<input type="text" name="costo" id="costo" class="form-control" value="<?php echo $row_subcat['costo']; ?>">
    </form>