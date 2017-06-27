<?php 
	echo "hola <br>";
	include("_conexion.php");
	

	if(isset($_POST['id'])){
		echo $_POST['id'];
		$sql = "CALL `validarNuevaPeticion`('".$_POST['id']."');";
		mysql_query($sql,$conexion);
	}
	header('Location: nuevasSolicitudes.php');
	
?>