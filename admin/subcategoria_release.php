<?php require_once('../Connections/master.php'); ?>
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

$colname_consulta_subcategoria = "-1";
if (isset($_GET['id'])) {
  $colname_consulta_subcategoria = $_GET['id'];
}
mysql_select_db($database_master, $master);
$query_consulta_subcategoria = sprintf("SELECT * FROM subcategoria WHERE categoria = %s", GetSQLValueString($colname_consulta_subcategoria, "int"));
$consulta_subcategoria = mysql_query($query_consulta_subcategoria, $master) or die(mysql_error());
$row_consulta_subcategoria = mysql_fetch_assoc($consulta_subcategoria);
$totalRows_consulta_subcategoria = mysql_num_rows($consulta_subcategoria);
?>


   <link href="css/bootstrap.min.css" rel="stylesheet">

<div class="container">
             <div  class="row form-group" id="subcat" >
                            <div class="col-md-1 col-xs-offset-2 ">Subcategoria: </div>
                            <div class="col-md-4">
                                    
                                    <select name="subcategoria" class="form-control">
                                     	<option value="0" selected="selected" >Selecciones una Subcategoria</option>
                                        <?php do { ?>
                                        <option value="<?php echo $row_consulta_subcategoria['id']; ?>" >
                                          <?php echo $row_consulta_subcategoria['subcategoria']; ?>		
                                        </option>
                                        <?php } while ($row_consulta_subcategoria = mysql_fetch_assoc($consulta_subcategoria)); ?>
                                     </select>
                                      
                                          	</div>
    		</div>
            </div>

<?php
mysql_free_result($consulta_subcategoria);
?>
