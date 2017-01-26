<?php require_once('../Connections/master.php'); 

$id =$_GET['id'];				

mysql_select_db($database_master, $master);
$query_subcat = sprintf("SELECT * FROM subcategoria WHERE subcategoria.categoria=%s", $id);
$subcat = mysql_query($query_subcat, $master) or die(mysql_error());
$row_subcat = mysql_fetch_assoc($subcat);
$totalRows_categoria = mysql_num_rows($subcat);

?>


				<div  class="row form-group" id="subcat" >
    			<div class="col-md-1 col-xs-offset-2 ">Subcategoria :</div>
    			<div class="col-md-4">
                            <select name="subcategoria" class="form-control">
                               
                                <?php do {  ?>
                                   <option value="<?php echo $row_subcat['id']; ?>" >
                                   				<?php echo $row_subcat['subcategoria']; ?>
                                   </option>
                                <?php } while ($row_subcat = mysql_fetch_assoc($subcat)); ?>
                            </select>
              	</div>
    		</div>