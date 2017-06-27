<?php 
	$servidor = "localhost"; //el servidor que utilizaremos, en este caso será el localhost
	$usuario = "root"; //El usuario que acabamos de crear en la base de datos
	$contrasenha = "j6r3uwb9"; //La contraseña del usuario que utilizaremos
	$BD = "consejodb"; //El nombre de la base de datos

	$conexion = @mysql_connect($servidor, $usuario, $contrasenha);

	if (!$conexion) {
		header('Location: _error.php');
		die('<strong>No pudo conectarse:</strong> ' . mysql_error());
	}

	mysql_select_db($BD, $conexion) or die(mysql_error($conexion));

?>