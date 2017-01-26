<?php
/* 
 * Configuración general: conexión a la base de datos y otro parámetros
 */

define('SERVIDOR_MYSQL','localhost'); //servidor de la base de datos
define('USUARIO_MYSQL','root'); //usuario de la base de datos
define('PASSWORD_MYSQL',''); //la clave para conectar
define('BASE_DATOS','j298279869_distrimix
'); // indica el nombre de la base de datos que contiene la tabla de los usuarios

define('TABLA_DATOS_LOGIN','usuario'); //nombre de la tabla usarios
define('CAMPO_USUARIO_LOGIN','email'); //campo que contiene los datos de los usuarios (se puede usar el email)
define('CAMPO_CLAVE_LOGIN','clave'); //campo que contiene la contraseña

define('METODO_ENCRIPTACION_CLAVE','texto'); //método utilizado para almacenar la contraseña encriptada. Opciones: sha1, md5, o texto


?>
