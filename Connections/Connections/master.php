<?php



if (!isset($_SESSION)) {
  @session_start();
   
 }
 GLOBAL $dato;
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_master = "localhost";
$database_master = "rddsiste_matrix";
$username_master = "rddsiste";
$password_master = "eureka4472";
$master = @mysql_pconnect($hostname_master, $username_master, $password_master) or trigger_error(mysql_error(),E_USER_ERROR); 
?>