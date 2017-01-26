<?php
/**
 * Libreria para validar un usuario comprobando su usuario (o email) y contraseña
 * Forma parte del paquete de tutoriales en PHP disponible en http://www.emiliort.com
 * @author Emilio Rodríguez - http://www.emiliort.com
 */

/**
 * valida un usuario y contraseña
 * @param string $usuario
 * @param string $password
 * @return bool
 */
function login($email,$clave) {

    //usuario y password tienen datos?
    if (empty($email)) return false;
    if (empty ($clave)) return false;

    //1 - conectamos a la base de datos utilizando los parámetros globales
    $link =  mysql_connect(SERVIDOR_MYSQL, USUARIO_MYSQL, PASSWORD_MYSQL);

    if (!$link) {
        trigger_error('Error al conectar al servidor mysql: ' . mysql_error(),E_USER_ERROR);
    }
    // Seleccionar la base de datos activa
    $db_selected = mysql_select_db(BASE_DATOS, $link);
    if (!$db_selected) {
        trigger_error ('Error al conectar a la base de datos: ' . mysql_error(),E_USER_ERROR);
    }

    //2 - preparamos la consulta SQL a ejecutar utilizando sólo el usuario y evitando ataques de inyección SQL.
    $query='SELECT '.CAMPO_USUARIO_LOGIN.', '.CAMPO_CLAVE_LOGIN.' FROM '.TABLA_DATOS_LOGIN.' WHERE '.CAMPO_USUARIO_LOGIN.'="'.  mysql_real_escape_string($email).'" LIMIT 1 '; //la tabla y el campo se definen en los parametros globales
    $result = mysql_query($query);
    if (!$result) {
        trigger_error('Error al ejecutar la consulta SQL: ' . mysql_error(),E_USER_ERROR);
    }


    //3 - extraemos el registro de este usuario
    $row = mysql_fetch_assoc($result);

    
    
    if ($row) {
        //4 - Generamos el hash de la contraseña encriptada para comparar o lo dejamos como texto plano
        switch (METODO_ENCRIPTACION_CLAVE) {
            case 'sha1'|'SHA1':
                $hash=sha1($clave);
                break;
            case 'md5'|'MD5':
                $hash=md5($clave);
                break;
            case 'texto'|'TEXTO':
                $hash=$clave;
                break;
            default:
                trigger_error('El valor de la constante METODO_ENCRIPTACION_CLAVE no es válido. Utiliza MD5 o SHA1 o TEXTO',E_USER_ERROR);
        }


        //5 - comprobamos la contraseña
        if ($hash==$row[CAMPO_CLAVE_LOGIN]) {
            @session_start();
            $_SESSION['email']=array('user'=>$row[CAMPO_USUARIO_LOGIN]); //almacenamos en memoria el usuario
            // en este punto puede ser interesante guardar más datos en memoria para su posterior uso, como por ejemplo un array asociativo con el id, nombre, email, preferencias, ....
            return true; //usuario y contraseña validadas
        } else {
            @session_start();
            unset($_SESSION['email']); //destruimos la session activa al fallar el login por si existia
            return false; //no coincide la contraseña
        }
    } else {
        //El usuario no existe
        return false;
    }

}

/**
 * Veridica si el usuario está logeado
 * @return bool
 */
function estoy_logeado () {
    @session_start(); //inicia sesion (la @ evita los mensajes de error si la session ya está iniciada)
    
    if (!isset($_SESSION['email'])) return false; //no existe la variable $_SESSION['USUARIO']. No logeado.
    if (!is_array($_SESSION['email'])) return false; //la variable no es un array $_SESSION['USUARIO']. No logeado.
    if (empty($_SESSION['email']['user'])) return false; //no tiene almacenado el usuario en $_SESSION['USUARIO']. No logeado.

    //cumple las condiciones anteriores, entonces es un usuario validado
    return true;

}

/**
 * Vacia la sesion con los datos del usuario validado
 */
function logout() {
    @session_start(); //inicia sesion (la @ evita los mensajes de error si la session ya está iniciada)
    unset($_SESSION['email']); //eliminamos la variable con los datos de usuario;
    session_write_close(); //nos asegurmos que se guarda y cierra la sesion
    return true;
}


    
?>
