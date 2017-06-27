<?php
	include("_conexion.php");

	if(!isset($_POST['folio'])){
		header('Location: index.php');
	}	

	$carrera = 1;
	switch ($_POST["carrera"]) {
	    case 'Ing. en Gestión Empresarial':
	        $carrera = 1;
	        break;
	    case 'Ing. en Sistemas Computacionales':
	        $carrera = 2;
	        break;
	    case 'Ing. en Energías Renovables':
	        $carrera = 3;
	        break;
	    case 'Ing. Electrónica':
	        $carrera = 4;
	        break;
	    case 'Ing. Civil':
	        $carrera = 5;
	        break;
	    case'Ing. Industrial':
	        $carrera = 6;
	        break;
	    case 'Lic. en Informatica':
	        $carrera = 7;
	        break;
	}

	$folio = $_POST["folio"];
	$nombre =  $_POST["nombre"];
	$apP =  $_POST["apP"];
	$apM =  $_POST["apM"];
	$ncontrol = $_POST["ncontrol"];
	$prom = $_POST["prom"];
	$semestre = $_POST["semestre"];
	$soli = $_POST["soli"];

	$dict = $_POST["dict"];
	$coment = $_POST["coment"];
	$status = 4;

	switch ($_POST["res"]) {
	    case 'Aprobado':
	        $status = 5;
	        break;
	    case 'Rechazado':
	        $status = 4;
	        break;
	}
		
	$sql = "CALL `ActualizarDatosFinalizado`('".$folio."','".$nombre."', '".$apP."', '".$apM."', ".$ncontrol.", ".$prom.", ".$semestre.", '".$soli."', ".$carrera.",'".$dict."','".$coment."',".$status.");"; 

	echo ($folio ."<br>". $nombre ."<br>".$apP."<br>".$apM."<br>".$ncontrol."<br>".$prom."<br>".$semestre."<br>".$carrera."<br>".$soli."<br>".$dict."<br>".$coment."<br>".$status."<br>");

	echo ($sql."<br><br>");

	$result = mysql_query($sql,$conexion);

	if($result != null){
		while($row = mysql_fetch_assoc($result)):
			echo "Folio actualizado: "+$row["folio"];
			header('Location: Solicitudes.php');

		endwhile;
	}else{
		echo "Sin datos, No se pudo agregar la peticion";
		header('Location: _error.php');
	}

?>