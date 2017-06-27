<?php 
	if(!isset($_POST["folio"])){
		header('Location: seguimiento.php#myModal');
	}

	$folio = $_POST["folio"];

	include("_conexion.php");

	$sql = "CALL `ObtenerDatosSeguimiento`('".$folio."');";

	$result = mysql_query($sql,$conexion);
	
	if($result != null){
		$row = mysql_fetch_assoc($result);
		session_start();
		$_SESSION["folio"] = $row['id_peticion'];
		$_SESSION["ncontrol"] = $row['num_control'];
		$_SESSION["nombre"] = $row['nom_alumno'];
		$_SESSION["apP"] = $row['ape_paterno'];
		$_SESSION["apM"] = $row['ape_materno'];
		$_SESSION["carrera"] = $row['nom_carrera'];
		$_SESSION["semestre"] = $row['semestre'];
		$_SESSION["fechaSolicitud"] = $row['fechaSolicitud'];
		$_SESSION["peticion"] = $row['peticion'];
		$_SESSION["status"] = $row['status'];
		$_SESSION["dictamen"] = $row['dictamen'];
		$_SESSION["coment"] = $row['coment'];
		header('Location: infoSolicitud.php');
	}else{
		
		header('Location: seguimiento.php#myModal');
	}
?>
