<?php
date_default_timezone_set('America/caracas');

if(!session_start()){	
	session_start();
	}
	

# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_master = "localhost";
$database_master = "db_matrix";
$username_master = "root";
$password_master = "";
$master = @mysql_pconnect($hostname_master, $username_master, $password_master) or trigger_error(mysql_error(),E_USER_ERROR); 
?>