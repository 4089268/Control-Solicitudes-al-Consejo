<?php 
	echo "hola <br>";
	include("_conexion.php");


	if(isset($_POST['id'])){
		echo $_POST['id'];
		$sql = "CALL `cancelarPeticion`('".$_POST['id']."');";
		mysql_query($sql,$conexion);
		header('Location: solActivas.php');
	}

	if(isset($_POST['id2'])){
		echo $_POST['id2'];
		$sql = "CALL `cancelarPeticion`('".$_POST['id2']."');";
		mysql_query($sql,$conexion);
		header('Location: nuevasSolicitudes.php');
	}
	


	
	
?>	