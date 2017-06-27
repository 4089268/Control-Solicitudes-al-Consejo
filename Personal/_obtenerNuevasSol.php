<?php
	include("_conexion.php");
	$nuevas = 0;
	$sql = "select count(*)as nueva from peticion where status = 1";
	$result = mysql_query($sql,$conexion);
	if($result != null){
		$row = mysql_fetch_assoc($result);
		$nuevas = $row['nueva'];
	}
?>